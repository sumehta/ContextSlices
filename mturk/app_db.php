<!doctype html>
<html lang="en"> 
<head> 
<title>Describe.</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
   if(getParameterByName('assignmentId') == 'ASSIGNMENT_ID_NOT_AVAILABLE') {
        $('#notAccepted').show();
        $('#accepted').hide();
   } else {
        $('#accepted').show();
        $('#notAccepted').hide();
   }
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
    
</script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#slider-range-max" ).slider({
      range: "max",
      min: 0,
      max: 100,
      value: 0,
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.value );
        var element = document.getElementById("confidence");
        element.value = ui.value;
      }
    });
    $( "#amount" ).val( $( "#slider-range-max" ).slider( "value" ) );
  });
  </script>


<style type="text/css">

textarea {
    width: 400px;
    height: 80px;
    display: block;
}
   
#notAccepted {
    color: red;
    font-weight: bold;
}
    
</style>
</head> 
<body>
    
<div id="notAccepted">

<p>You must accept the HIT before you can see the details.</p>
    
</div>
<div id="accepted">

<h3>Instructions</h3>
    
<p>Look at the image presented and tell us where you think the image takes place (ie: MGM Grand, Las Vegas) be as specific as possible and do not guess!<p>



<?php
// $pictures = Array(
// 'images/alanturing.jpg',
// 'images/alanturing2.jpg',
// 'images/baltimore.jpg',
// 'images/boston_marathon.jpg',
// 'images/civil-war-004.jpg',
// 'images/civilwar.jpg',
// 'images/civilwar2.jpg',
// 'images/DanceParade2013-PassionBolivia.jpg',
// 'images/DC.jpg',
// 'images/Ginger_Pride_in_rome.jpg',
// 'images/miami.jpg',
// 'images/nyc.jpg',
// 'images/PebbleBeach8.jpg',
// 'images/Turing-demonstration.jpg',
// 'images/Turing-with-colleagues-Mark-1.jpg',
// 'images/uva.jpg',
// 'images/virginia_tech_football.jpg',
// 'images/vt_football_old.jpg',
// 'images/vt_vs_gt.jpg',
// 'images/vt.jpg',
// 'images/vtshooting1.jpg',
// 'images/vtshooting2.jpg',
// 'images/vtshooting3.jpg',
// 'images/vtshooting4.jpg');

#$pictures = scandir('images/');

$pictures = Array('images/1.jpg', 'images/2.jpg', 'images/3.jpg', 'images/4.jpg');

shuffle($pictures);
$picture = $pictures[0];
$disPlaypic = $picture

?>

	
<form method="POST" id="form" action="processApp.php">

	<img src="<?= $picture ?>" style="width: 600px;" />
    
    <p><b>Please describe what you see.</b></p>
    <textarea name="description"></textarea>
    
    <p><b>Please name the location, name, area, etc. Be as specific as possible and try not guess.</b></p>
    <textarea name="location"></textarea>
    
    <p><b>Please rate your confidence level in the following slider<br />(0 = not confident at all, 100 = I am completely sure).</b></p>
    
	<p>
  		<label for="amount">Confidence Percentage:</label>
  		<input type="text" id="amount" readonly style="border:0; font-size:14px; width: 25px;">%
	</p>
	<div id="slider-range-max"></div>
	
	<p><b>Please explain why you have that level of confidence about your answer.</b></p>
    <textarea name="why"></textarea>

	<BR>
	<BR>
    <input type="hidden" name="assignmentId" value="<?= $_GET['assignmentId'] ?>" />
    <input type="hidden" name="workerId" value="<?= $_GET['workerId'] ?>" />
    <input type="hidden" name="confidence" id="confidence" value="" />
	<input type="hidden" name="img" value="<?= $picture ?>" />
    <input type="hidden" name="endpoint" value="sandbox" />
    <input type="submit" value="Submit Answers" style="font-size:25px;"/>

</form>

</div>

</body>
</html>