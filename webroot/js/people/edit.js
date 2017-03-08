$(document).ready(function () {
	var option = $("#profile-id option:selected").text();
	var controller = parseController(option);

	getForm(controller);

	$("#profile-id").change(function () {
		option = $("option:selected", this).text();
		controller = parseController(option);
		getForm(controller);
	});

	if ($("#profile-id").val() == 3) {
		var contractor_company_id = $("#person_contractor_company").val();
		var work_area_id = $("#person_work_area").val();
		$("#contractor-company-id-label").attr('style', '');
		$(".contractor-companies-select").attr('style', '');
		$(".work-areas-select").attr('style', '');
		$("#contractor-company-id").val(contractor_company_id);
		$("#work-area-id").val(work_area_id);
	} else if ($("#profile-id").val() == 2){
		var work_area_id = $("#person_work_area").val();
		$("#work-area-id-label").attr('style', '');
		$(".work-areas-select").attr('style', '');
		$("#work-area-id").val(work_area_id);
	}

	$("#profile-id").on('change', function () {
		if ($(this).val() == 3) {
			var contractor_company_id = $("#person_contractor_company").val();
			$("#contractor-company-id-label").attr('style', '');
			$("#work-area-id-label").attr('style', '');

		
			$(".contractor-companies-select").attr('style', '');
			$(".work-areas-select").attr('style', '');
		} else if ($(this).val() == 2) {
			$("#contractor-company-id-label").attr('style', 'display:none;');
			$(".contractor-companies-select").attr('style', 'display:none;');
			$("#new-contractor-company").val('');

			$("#work-area-id-label").attr('style', '');
			$(".work-areas-select").attr('style', '');
		} else {
			$("#contractor-company-id-label").attr('style', 'display:none;');
			$("#work-area-id-label").attr('style', 'display:none;');
			$("#new-contractor-company").val('');

			$(".contractor-companies-select").attr('style', 'display:none;');
			$(".work-areas-select").attr('style', 'display:none;');
			$("#new-work-area").val('');
		}
	});
});

function getForm(controller) {
	if (controller) {
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
	} else {
		$("#form-container").empty();
	}
}

function parseController(option) {
	switch(option){
		case "Visita":
			return "visitProfiles";
			break;
		default:
			return null;
	}
}