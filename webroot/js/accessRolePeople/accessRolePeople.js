$(document).ready(function () {
	$("#expiration").datepicker({
		language: "es",
		autoclose: true
	});

	$("#expiration").attr('name', 'expiration');

	$("#notexpire").change(function () {
		if ($(this).is(":checked")) {
			$("#expiration").prop('disabled', true);
		} else {
			$("#expiration").prop('disabled', false);
		}
	})
});