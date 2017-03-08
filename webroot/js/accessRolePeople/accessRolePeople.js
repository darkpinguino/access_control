$(document).ready(function () {
	$("#expiration").datepicker({
		format: 'dd/mm/yyyy',
		language: "es",
		autoclose: true
	});

	console.log($("#expiration_date").val());

	var date = new Date($("#expiration_date").val());

	$("#expiration").datepicker('setUTCDate', date);

	$("#expiration").attr('name', 'expiration');

	$("#notexpire").change(function () {
		if ($(this).is(":checked")) {
			$("#expiration").prop('disabled', true);
		} else {
			$("#expiration").prop('disabled', false);
		}
	})
});