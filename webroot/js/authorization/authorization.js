var passengerRut = '\
		<div class="form-group" text="">\
			<input class="form-control" name="rut" id="rut" type="text">\
		</div>';

$(document).ready(function () {
	$(document).on("click", ".authorization", function () {
		var rut = $(this).attr("person-rut");
		var door_id = $(this).attr("door-id");
		var acction = $(this).attr("acction");


		$.ajax({
			url: "authorization",
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

	$("#actual-state").on('click', function () {
		$.ajax({
			url: "actualstate",
			type: "GET",
			success: function (result, status, xhr) {
				$(".modal-body").html(result);
			}
		});

		$("#actual-state-modal").modal();
	});

	$("#passenger").on('click', function () {
		if ($(this).is(':checked')) {
			$("#passenger-form").empty();
			$("#passenger-form").html(
				'<label for="rut">Rut Pasajeros</label>\
				<div id="passenger-rut-wrapper">' +
					passengerRut +
				'</div>\
				<div class="btn-group pull-right">\
					<button id=plus-passenger type="button" class="btn btn-success">\
						<i class="fa fa-plus"></i>\
					</button>\
					<button id=less-passenger type="button" class="btn btn-danger">\
						<i class="fa fa-minus"></i>\
					</button>\
				</div>'
				);
		} else {
			$("#passenger-form").empty();
		}
	});

	$(document).on('click', '#plus-passenger', function () {
		$("#passenger-rut-wrapper").append(passengerRut);
	});

	$(document).on('click', '#less-passenger', function () {
		$("#passenger-rut-wrapper div:last").remove();
	})
});