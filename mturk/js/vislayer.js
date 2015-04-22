// control for doc view (hide the view)
$("#vislayer_icon").click(function(e){
	// cancel default browser event
	// e.preventDefault();
	if ($("#vislayer").is(":hidden") == true) {
		$("#vislayer").slideToggle("slow");
		// change the control icon
		$("#vislayer_icon").removeClass('glyphicon-new-window');
		$("#vislayer_icon").addClass('glyphicon-remove-sign');
	}
	else {
		$("#vislayer").slideToggle("hide");
		// change the control icon
		$("#vislayer_icon").removeClass('glyphicon-remove-sign');
		$("#vislayer_icon").addClass('glyphicon-new-window');	
	}
});