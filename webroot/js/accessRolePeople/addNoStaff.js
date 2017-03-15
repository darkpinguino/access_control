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

	var access_role_people = [];

	$("#access_role_people > li").each(function () {
		access_role_people.push($(this).text());
	});

	$("#role-id").multiselect('select', access_role_people);


	$("#expiration").datepicker({
		format: 'dd/mm/yyyy',
		language: "es",
		autoclose: true
	});

	var date = new Date($("#expiration_date").val());

	console.log(date);

	$("#expiration").datepicker('setUTCDate', date);

	$("#expiration").attr('name', 'expiration');

	$("#notexpire").change(function () {
		if ($(this).is(":checked")) {
			$("#expiration").prop('disabled', true);
		} else {
			$("#expiration").prop('disabled', false);
		}
	})

});