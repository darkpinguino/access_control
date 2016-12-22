$(document).ready(function () {
	$("#rut").on('change', function () {
		$.ajax({
			url: "viewByRut/" + $(this).val(),
			type: "GET",
			dataType: "json",
			success: function (result, seccess, hrx) {
				if (result["person"] != null) {
					$("#name").val(result["person"]["name"]);
					$("#lastname").val(result["person"]["lastname"]);
					$("#phone").val(result["person"]["phone"]);
				} else {
					$("#name").val("");
					$("#lastname").val("");
					$("#phone").val("");
				}
			}
		});
	});
});