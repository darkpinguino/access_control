var passengerCount = 0;

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
				$("#actual-state-modal").modal();
			}
		});
	});

	$("#vehicle-actual-state").on('click', function () {
		$.ajax({
			url: "vehicleActualState",
			type: "GET",
			success: function (result, status, xhr) {
				$(".modal-body").html(result);
				$("#vehicle-actual-state-modal").modal();
			}
		});
	});

	$("#passenger").on('click', function () {
		if ($(this).is(':checked')) {
			passengerCount = 0;
			$("#passenger-form").empty();
			$("#passenger-form").html(
				'<label for="rut">Rut Pasajeros</label>\
				<div id="passenger-rut-wrapper">' +
					passengerRut(passengerCount) +
				'</div>\
				<div class="btn-group pull-right">\
					<button id=plus-passenger type="button" class="btn btn-default">\
						<i class="fa fa-plus"></i>\
					</button>\
					<button id=less-passenger type="button" class="btn btn-default">\
						<i class="fa fa-minus"></i>\
					</button>\
				</div>'
				);
		} else {
			$("#passenger-form").empty();
		}
	});

	$(document).on('click', '#plus-passenger', function () {
		passengerCount++;
		$("#passenger-rut-wrapper").append(passengerRut(passengerCount));
	});

	$(document).on('click', '#less-passenger', function () {
		if (passengerCount > 0){
			passengerCount--;
			$("#passenger-rut-wrapper div:last").remove();
		}
	});

	$(document).on('click', '#notifications-menu', function () {
		insideAlertCount();
	});

	$(document).on('click', "#notification-people", function () {
		insideAlert();
	});

	insideAlert();
	insideAlertCount();

	setInterval(insideAlert, 1000*60);
	setInterval(insideAlertCount, 1000*60);
});

function passengerRut(count) {
	return '\
		<div class="form-group" text="">\
			<input class="form-control" name="passanger-rut[' + count +
				']" id="passanger' + count + '-rut" type="text">\
		</div>';
}

function insideAlert() {
	$.ajax({
		url: "insideAlert",
		type: "GET",
		success: function (result, status, xhr) {
			if (result) {
				$(".modal-body").html(result);
				if (!($("#inside-alert-modal").data('bs.modal') || {}).isShown) {
					$("#inside-alert-modal").modal();
				}
			} else {
				$("#inside-alert-modal").modal('hide');
			}
		}
	});
}

function insideAlertCount() {
	$.ajax({
		url: "insideAlertCount",
		type: "GET",
		dataType: "json", 
		success: function (result, status, xhr) {
			populeteNotification(result['countPeople'])
		}
	});
}

function populeteNotification(countPeople) {
	$("#notifications-count").remove();
	$("#notifications-dropdown").empty();
	if (countPeople > 0) {
		var message = '';
		$("#notifications-menu").append(
			'<span id="notifications-count" class="label label-danger">' + countPeople + '</span>'
		);

		if (countPeople == 1) {
			message = ' Persona excedida ';
		} else {
			message = ' Personas excedidas ';
		}

		$("#notifications-dropdown").html(
							'<li>\
	              <ul class="menu">\
	                <li>\
	                  <a id="notification-people" href="#">\
	                    <i class="fa fa-users text-red"></i> <span>' + countPeople + message + 'en tiempo</span>\
	                  </a>\
	                </li>\
	              </ul>\
	            </li>');
	}
}