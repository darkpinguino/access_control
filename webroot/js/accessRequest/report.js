$(document).ready(function function_name() {
	moment.locale("es");
	$("#range-report").daterangepicker({
		"autoApply": true,
	});

	$("#fullrange").change(function () {
		if ($(this).is(":checked")) {
			$("#range-report").prop('disabled', true);
		} else {
			$("#range-report").prop('disabled', false);
		}
	})

	$("#enclosures-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Nombre recinto',
		nonSelectedText: 'Ningun recinto seleccionado',
		allSelectedText: 'Todos',
		nSelectedText: ' - Recintos'
	});
	$("#enclosures-id").multiselect('selectAll', false);
	$("#enclosures-id").multiselect('updateButtonText');

	$("#profile-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Nombre perfil',
		nonSelectedText: 'Ningun perfil seleccionado',
		allSelectedText: 'Todos',
		nSelectedText: ' - Perfiles'
	});
	$("#profile-id").multiselect('selectAll', false);
	$("#profile-id").multiselect('updateButtonText');

	$("#person-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Nombre persona',
		nonSelectedText: 'Ninguna persona seleccionado',
		allSelectedText: 'Todos',
		nSelectedText: ' - Personas'
	});
	$("#person-id").multiselect('selectAll', false);
	$("#person-id").multiselect('updateButtonText');
})