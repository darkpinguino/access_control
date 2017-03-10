$(document).ready(function(){
	$('#myModalDelete2').on('show.bs.modal', function(e) {
	    var action = $(this).find('#hidden-delete-action').attr('href');
	    var id = $(e.relatedTarget).data('action');
	    var df = $(e.relatedTarget).data('displayfield');
	    $(this).find('form').attr('action', action + "/" +id);
	    $(this).find('#displayFieldText').html(df);
	});

});
