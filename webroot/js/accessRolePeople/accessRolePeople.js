$(document).ready(function () {

	$("#expiration").prop('name', 'expiration');

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

	$("#people-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Nombre persona',
		nonSelectedText: 'Ninguna persona seleccionada',
		allSelectedText: 'Todos',
		nSelectedText: ' - personas'
	});

	$("#access-role-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Rol de acceso',
		nonSelectedText: 'Ningun Rol seleccionado',
		allSelectedText: 'Todos',
		nSelectedText: ' - roles'
	});

	$("#people-id").multiselect('updateButtonText');
	$("#access-role-id").multiselect('updateButtonText');

});