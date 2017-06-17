$(document).ready(function () {
	var table = $('#report').DataTable( {
		"order": [[ 6, "desc" ]],
		buttons: [
			'excel', 'pdf'
		],
		language: {
        url: '../js/plugins/datatables/localisation/spanish.json'
    },
    initComplete: function () {
      setTimeout( function () {
        table.buttons().container().appendTo( '.col-sm-6:eq(0)' );
      }, 10 );
    }
 	});
});