var form_id;

$(document).ready(function () {

	form_id = $("#forms").val();
	getForm(form_id);


	$("#forms").on('change', function () {
		form_id = $(this).val();

		getForm(form_id);
	});

	$(document).on('click', '#submit-form', function () {
		$("#form").submit();
	})
})

function getForm(form_id) {
	$.ajax({
			url: "getForm/"+form_id+'/forms/vehicleRespondForm',
			type: "GET",
			success: function (result, status, xhr) {
				$("#form-container").empty();
				$("#form-container").html(result);
				}
		});
}