var passengerCount = 0;

$(document).ready(function () {

	peopleCount();

	$("#search-button").on('click', function () {
		window.location.replace('authorization?search=' + $("#search-input").val())
	})

	var search = getURLParameters('search');
	$("#search-input").val(search);

	$(document).on("click", ".authorization", function () {
		var rut = $(this).attr("person-rut");
		var door_id = $(this).attr("door-id");
		var acction = $(this).attr("acction");

		$.ajax({
			url: "authorization",
			type: "POST",
			data: {
				rut: rut,
				door_id: door_id,
				acction: acction,
				check: 1
			},
			success: function (result, status, xhr) {
				result = result.split('----');
				$("#status-people-location").html(result[0]);
				if (result.length > 1) {
					if ($("#vehicle-alert-modal").length) {
						$("#vehicle-alert-modal").replaceWith(result[1]);
					} else {
						$(".nav-tabs-custom").after(result[1]);
					}
					$("#vehicle-alert-modal").modal();
				}
			}
		});
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  	console.log($(this.innerHTML)['selector']);
  	if ($(this.innerHTML)['selector'] == 'Personas') {
  		$("#rut").focus();
  	} else {
  		$("#vehicle-rut").focus();
  	}
	})

	$(document).on("click", "#vehicle_alert_submit", function () {
		$("#vehicle_alert_form").submit();
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

	$("#vehicle-rut").on('change', function () {
			$.ajax({
				url: "../VehicleAccessRequest/lastVehicle/" + $(this).val(),
				type: "GET",
				dataType: "json",
				success: function (result, success, hrx) {
					if (result['vehicleAccessRequest'] != null) {
						$("#number-plate").val(result['vehicleAccessRequest']['vehicle']['number_plate']);
						$("#vehicle-type").val(result['vehicleAccessRequest']['vehicle']['vehicle_type_id']);
					} else {
						$("#number-plate").val("");
						$("#vehicle-type").val("");
					}
				}
			})
	})

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

	$('#vehicle-rut').keypress(function(e){
    if ( e.which == 13 ) return false;
    // //or...
    // if ( e.which == 13 ) e.preventDefault();
	});

	$("#vehicle-alert-modal").modal();

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
				$("#inside-alert-modal .modal-body").html(result);
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

function peopleCount() {
	$.ajax({
		url: "../people/peopleCount",
		type: "GET",
		dataType: "json", 
		success: function (result, status, xhr) {
			populatePeopleCount(result);
		},
		error: function (xhr, status, error) {
			console.log(xhr);
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

function populatePeopleCount(countPeople) {
	$("#people-count").remove();
	$("#people-count-dropdown").empty();

	var total_people = countPeople['visit_count'] + countPeople['employees_count'] + countPeople['contractors_count'];
	console.log(total_people);

	if (total_people > 0) {
		var visit_message = '';
		var employess_message = '';
		var contractors_message = '';

		$("#people-count-menu").append(
			'<span id="people-count" class="label label-danger">' + total_people + '</span>'
		);

		if (countPeople['visit_count'] == 1) {
			visit_message = ' Visita';
		} else {
			visit_message = ' Visitas';
		}

		if (countPeople['employees_count'] == 1) {
			employess_message = ' Empleado';
		} else {
			employees_message = ' Empleados';
		}

		if (countPeople['contractors_count'] == 1) {
			contractors_message = ' Contratista';
		} else {
			contractors_message = ' Contratistas';
		}

		$("#people-count-dropdown").html(
							'<li class="header">Personas ingresadas</li>\
	            <li>\
	              <ul class="menu">\
	                <li>\
	                  <a id="employees-count-people" href="#">\
	                    <i class="fa fa-users text-aqua"></i> <span>' + countPeople['employees_count'] + employess_message + '</span>\
	                  </a>\
	                </li>\
	              </ul>\
	            </li>\
	            <li>\
	              <ul class="menu">\
	                <li>\
	                  <a id="contractos-count-people" href="#">\
	                    <i class="fa fa-users text-light-blue"></i> <span>' + countPeople['contractors_count'] + contractors_message + '</span>\
	                  </a>\
	                </li>\
	              </ul>\
	            </li>\
	            <li>\
	              <ul class="menu">\
	                <li>\
	                  <a id="visit-count-people" href="#">\
	                    <i class="fa fa-users text-yellow"></i> <span>' + countPeople['visit_count'] + visit_message + '</span>\
	                  </a>\
	                </li>\
	              </ul>\
	            </li>'

	            );
	}
}