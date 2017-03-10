$(document).ready(function () {
	$(".answer-date").datepicker({
		language: "es",
		autoclose: true,
		todayHighlight: true,
		weekStart: 1
	});
	rename();
});

var answer=0;

function rename(){
	var answer_index;
	$(".answer-date").each(function() {
		answer_index = $(this).attr('answer-index');
		$(this).attr('name', 'answers[' + answer_index + '][answer_text]');
	});

}