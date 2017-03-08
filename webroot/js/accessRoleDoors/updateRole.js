$(document).ready(function function_name() {
	$("#role-id").multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllText: 'Todos',
		filterPlaceholder: 'Nombre rol',
		nonSelectedText: 'Ningun rol seleccionado',
		allSelectedText: 'Todos',
		nSelectedText: ' - Roles'
	});
	$("#role-id").multiselect('updateButtonText');

	var access_role_doors = [];

	$("#access_role_doors > li").each(function () {
		access_role_doors.push($(this).text());
	});

	$("#role-id").multiselect('select', access_role_doors);

})