$(document).ready(function () {
	$("#forms").on('change', function () {
		var form_id = $(this).val();

		console.log(form_id);

		$.ajax({
			url: "../getForm/"+form_id+'/forms/vehicleRespondForm',
			type: "GET",
			success: function (result, status, xhr) {
				$("#form-container").empty();
				$("#form-container").html(result);
				}
		});
	})
})