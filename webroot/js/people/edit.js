$(document).ready(function () {
	var option = $("#profile-id option:selected").text();
	var controller = parseController(option);

	getForm(controller);

	$("#profile-id").change(function () {
		option = $("option:selected", this).text();
		controller = parseController(option);
	})
});

function getForm(controller) {
	var url = "../../" + controller + "/add";
	$.ajax({
			url: url,
			type: "GET",
			success: function (result, status, xhr) {
				$("#form-container").empty();
				$("#form-container").html(result);
			},
			error: function (xhr,status,error){
			}
		});
}

function parseController(option) {
	switch(option){
		case "Visita":
			return "visitProfiles";
			break;
		default:
			return "visitProfiles";
	}
}