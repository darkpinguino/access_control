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