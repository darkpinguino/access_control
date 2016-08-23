$(document).ready(function () {
	$("#expiration").datepicker({
		language: "es",
		autoclose: true
	});

	$("#notexpire").change(function () {
		if ($(this).is(":checked")) {
			$("#expiration").prop('disabled', true);
		} else {
			$("#expiration").prop('disabled', false);
		}
	})
});