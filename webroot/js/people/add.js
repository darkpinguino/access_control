$(document).ready(function () {
	$("#rut").on('change', function () {
		$.ajax({
			url: "viewByRut/" + $(this).val(),
			type: "GET",
			dataType: "json",
			success: function (result, seccess, hrx) {
				if (result["person"] != null) {
					$("#name").val(result["person"]["name"]);
					$("#lastname").val(result["person"]["lastname"]);
					$("#phone").val(result["person"]["phone"]);
				} else {
					$("#name").val("");
					$("#lastname").val("");
					$("#phone").val("");
				}
			}
		});
	});

	$("#profile-id").on('change', function () {
		if ($(this).val() == 3) {
			var contractor_company_id = $("#person_contractor_company").val();
			$("#contractor-company-id-label").attr('style', '');
			$("#contractor-company-id").attr('style', '');
			$("#new-contractor-company").attr('style', '');
			$("#contractor-company-id").val(contractor_company_id);
		} else {
			$("#contractor-company-id-label").attr('style', 'display:none;');
			$("#contractor-company-id").attr('style', 'display:none;');
			$("#new-contractor-company").attr('style', 'display:none');
			
		}
	});
});