$(document).ready(function () {
	$("#search-button").on('click', function () {
		window.location.replace('index?search=' + $("#search-input").val())
	})

	var search = getURLParameters('search');
	$("#search-input").val(search);
})