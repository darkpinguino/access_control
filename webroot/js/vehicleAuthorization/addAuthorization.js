$(document).ready(function function_name() {
	$("#person-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Nombre persona',
		nonSelectedText: 'Ninguna persona seleccionada',
		allSelectedText: 'Todos',
		nSelectedText: ' - Personas'
	});
	// $("#person-id").multiselect('selectAll', false);
	$("#person-id").multiselect('updateButtonText');

	var vehicle_authorizations = [];

	$("#vehicle_authorizations > li").each(function () {
		vehicle_authorizations.push($(this).text());
	});

	$("#person-id").multiselect('select', vehicle_authorizations);

})