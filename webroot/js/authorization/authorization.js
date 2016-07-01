$(document).ready(function () {
	$(document).on("click", ".authorization", function () {
		var rut = $(this).attr("person-rut");
		var door_id = $(this).attr("door-id");
		var acction = $(this).attr("acction");

		$.ajax({
			url: "authorization/authorization",
			// contentType: "application/json",
			type: "POST",
			// dataType: "json",
			data: {
				rut: rut,
				door_id: door_id,
				acction: acction
			},
			success: function (result, status, xhr) {
				$("#status-location").html(result);
			}
		});
	});

	// $(".out-button").click(function () {
	// 	var rut = $(this).attr("person-rut");
	// 	var door_id = $(this).attr("door-id");

	// 	$.ajax({
	// 		url: "authorization/authorization",
	// 		// contentType: "application/json",
	// 		type: "POST",
	// 		// dataType: "json",
	// 		data: {
	// 			rut: rut,
	// 			door_id: door_id
	// 		},
	// 		success: function (result, status, xhr) {
	// 			$("#status-location").html(result);
	// 		}
	// 	});
	// });
});