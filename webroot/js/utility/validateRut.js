function validateRut() {
	var rut = $("#rut").val();

	rut = rut.replace(/\s+/g, '');

	var valid_rut = $.validateRut(rut);

	if (valid_rut) {
		$("#rut").parent('.form-group').removeClass('has-error');
    $("#rut").nextAll('span').remove();
    $("#rut").val($.formatRut(rut, false));
	} else {
		$("#rut").parent('.form-group').addClass('has-error');
    $("#rut").nextAll('span').remove();
		$("#rut").after('<span class="help-block">Rut invalido</span>');
	}

	return valid_rut;
}