
$(document).ready(function(){

	var imgID = $('.nav-image.selected').attr('title');

	var initRequest = "action=initTable&selImgID=" + imgID;

	$.post("./server/dash.php", initRequest, function(response) {
		console.log(response);

		var data = eval(response);
		console.log(data.length);
		
		var canvasID = "#hist"
		drawHist(canvasID, data);
	});
});