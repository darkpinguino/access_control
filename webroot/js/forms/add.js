var question =0;

function addQuestions() {
	question +=1;
	$("#dyn-form").append(pregunta(question));
		
};



function pregunta(count) {
	return '\
		<div class="input-group">'+
			'<input type="text" class="form-control" name="question['+count+']" id="question'+count+'-id" >'+
			'<div class="input-group-btn" id="question">' +
			'<button type="button" id="typeQ'+count+'-id" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tipo de Respuesta\
			<span class="fa fa-caret-down"></span></button>' +
			'<ul class="dropdown-menu"  >' +
				'<li><a id="1" onclick="showAnswers(this, '+count+');" href= "#">Respuesta Corta</a></li>' +
				'<li><a id="2" onclick="showAnswers(this, '+count+');" href="#">Párrafo</a></li>' +
				'<li class="divider"></li>' +
				'<li><a onclick="showAnswers(this);" href="#">Selección Múltiple</a></li>' +
			'</div>'+
		'</div>'+
		'<br>'+
		'<div id="answer'+count+'">'+
			'<input type="text" class="form-control" id="answer'+count+'-id">'+
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