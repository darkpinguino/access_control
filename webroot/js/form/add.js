var question_count =0;

$(document).ready(function() {
	$(document).on('change', '.question_type', function () {
		var option= $(this).val();
		var id_group =$(this).attr('question-group-id');
		modifyQuestion(option, id_group);
		$("#select-question-"+id_group).val(option);
	});	

	$(document).on('click', '#delete_button', function () {
		$("#input-container"+question_count).remove();
		question_count -=1;
	})
});

function addQuestions() {
	question_count +=1;
	$("#dyn-form").append(pregunta(question_count));
	$("#question-group-"+question_count).append(fill(question_count));
		
};

function modifyQuestion(option, id_group) {
	var question = '';
	if (option == 3) {
		//question = question + fill(id_group);
		paint(id_group);
	} else {
		question = question + fill(id_group);
		$("#question-group-"+id_group).empty();
		$("#question-group-"+id_group).append(question);
	}

}

function pregunta(question_count) {
	return '\
		<div id="input-container-'+question_count+'">' +
		'<label>Escriba su pregunta aquí</label>'+
		'<div class="input-group" id="question-group-'+question_count+'">'+
		'</div>'+
		'<br>' +
		'</div>'+
		'<div class="form-group">'+
		'<input type="text" class="form-control col-md-12" name="questions['+question_count+'][placeholder]" '+
		'placeholder="Escriba un ejemplo de respuesta a la pregunta anterior">'+
		'</div>'+
		'<hr>' 
		;
}

function fill(question_count){
	return'\
		<input type="text" class="form-control col-md-9" name="questions['+question_count+'][question_text]">'+
			'<span class="input-group-addon"></span>'+
			'<select id="select-question-'+question_count+'" name="questions['+question_count+'][type]" class="question_type form-control col-md-3" question-group-id="'+question_count+'">'+
				'<option value="1">Respuesta Corta</option>'+
				'<option value="2">Párrafo</option>'+
				'<option value="3">Cantidad</option>'+
				'<option value="4">Fecha</option>'+
				'<option value="5">Binaria</option>'+
			'</select>';
}

function paint(question_count){
	$.ajax({
		url: "ajaxMeasures/"+question_count,
		type: "GET",
		success: function (result, status, xhr) {
			$("#question-group-"+question_count).append(result);
		}
	});
}

