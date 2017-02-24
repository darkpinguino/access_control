var question =0;

function addQuestions() {
	question +=1;
	$("#dyn-form").append(pregunta(question));
		
};


function pregunta(count) {
	return '\
		<div class="input-group">'+
			'<input type="text" class="form-control col-md-9" name="questions['+count+'][question_text]" id="question'+count+'-id" >'+
			'<span class="input-group-addon"></span>'+
			'<select id="question_type"  name="questions['+count+'][type]" class="form-control col-md-3">'+
        		'<option selected value="1">Respuesta Corta</option>'+
        		'<option value="2">Párrafo</option>'+
        		'<option value="3">Selección Múltiple</option>'+
    		'</select>'+
		'</div>'+
		'<br>'
};

function showAnswers(e, c){
	if (e.id =="2"){
		return '<div id="answer'+c+'">'+
			'<input type="textArea" class="form-control">'+
			'</div>'
	}
};