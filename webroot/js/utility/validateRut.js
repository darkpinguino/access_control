function validateRut(input) {
	var rut = $("#"+input).val();

	console.log(rut);
	
	rut = rut.replace(/\s+/g, '');

	var valid_rut = $.validateRut(rut);

	if (valid_rut) {
		$("#"+input).parent('.form-group').removeClass('has-error');
    $("#"+input).nextAll('span').remove();
    $("#"+input).val($.formatRut(rut, false));
	} else {
		$("#"+input).parent('.form-group').addClass('has-error');
    $("#"+input).nextAll('span').remove();
		$("#"+input).after('<span class="help-block">Rut invalido</span>');
	}

	return valid_rut;
}