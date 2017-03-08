$(document).ready(function function_name() {
	$("#doors-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Nombre puerta',
		nonSelectedText: 'Ninguna puerta seleccionada',
		allSelectedText: 'Todos',
		nSelectedText: ' - Roles'
	});
	$("#doors-id").multiselect('updateButtonText');

	var doors = [];

	$("#enclosure_doors > li").each(function () {
		doors.push($(this).text());
	});

	$("#doors-id").multiselect('select', doors);

})