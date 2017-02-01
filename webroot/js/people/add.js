var valid_rut = false;

$(document).ready(function () {

	$("#person-form").submit(function (event) {
		if (!valid_rut) {
			valid_rut = validateRut();
			if (valid_rut) {
				$("#person-form").submit();
			} else {
				event.preventDefault();
			}
		} else {
			$("#person-form").submit();
		}
	});

	$("#rut").on('change', function () {
		var rut  = $(this).val()
		$.validateRut(rut, function(r, dv) {
		$("#rut").parent('.form-group').removeClass('has-error');
    $("#rut").nextAll('span').remove();
    
		$.ajax({
			url: "viewByRut/" + r,
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

function validateRut() {
	var rut = $("#rut").val();

	valid_rut = $.validateRut(rut, function(r, dv) {
		$("#rut").parent('.form-group').removeClass('has-error');
    $("#rut").nextAll('span').remove();
    $("#rut").val(r);
	});

	if (!valid_rut) {
		$("#rut").parent('.form-group').addClass('has-error');
    $("#rut").nextAll('span').remove();
		$("#rut").after('<span class="help-block">Rut invalido</span>');
	}

	return valid_rut;
}