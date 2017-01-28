$(document).ready(function () {
	var option = $("#profile-id option:selected").text();
	var controller = parseController(option);

	getForm(controller);

	$("#profile-id").change(function () {
		option = $("option:selected", this).text();
		controller = parseController(option);
	});

	if ($("#profile-id").val() == 3) {
		var contractor_company_id = $("#person_contractor_company").val();
		$("#contractor-company-id-label").attr('style', '');
		$("#contractor-company-id").attr('style', '');
		$("#new-contractor-company").attr('style', '');
		$("#contractor-company-id").val(contractor_company_id);
	}

	$("#profile-id").on('change', function () {
		if ($(this).val() == 3) {
			$("#contractor-company-id-label").attr('style', '');
			$("#contractor-company-id").attr('style', '');
			$("#new-contractor-company").attr('style', '');

		} else {
			$("#contractor-company-id-label").attr('style', 'display:none;');
			$("#contractor-company-id").attr('style', 'display:none;');
			$("#new-contractor-company").attr('style', 'display:none');

		}
	});
});

function getForm(controller) {
	var url = "../../" + controller + "/add";
	$.ajax({
			url: url,
			type: "GET",
			success: function (result, status, xhr) {
				$("#form-container").empty();
				$("#form-container").html(result);
			},
			error: function (xhr,status,error){
				console.log(status);
				$("#form-container").empty();
				$("#form-container").html(error);
			}
		});
}

function parseController(option) {
	switch(option){
		case "Visita":
			return "visitProfiles";
			break;
		default:
			return "visitProfiles";
	}
}