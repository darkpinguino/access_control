$(document).ready(function () {
	$("#number-plate").on('change', function () {
		console.log("Entree!!!");
		$.ajax({
			url: "viewByNumberPlate/" + $(this).val(),
			type: "GET",
			dataType: "json",
			success: function (result, seccess, hrx) {
				if (result['vehicle'] != null) {
					console.log(result);
					$("#vehicle-type-id").val(result["vehicle"]["vehicle_type_id"]);
				}
			},
			error: function (xhr, status, error) {
					console.log(xhr);
					console.log(status);
					console.log(error);
				}
			
		});
	});
});