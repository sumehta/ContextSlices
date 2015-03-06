<!doctype html>
<html lang="en"> 
<head> 
<title>Weather task</title>

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
    
<p>Look at the image presented and tell us where you think the image takes place (ie: MGM Grand, Las Vegas) be as specific as possible <p>



<?php

$pictures = Array('images/nyc.jpg','images/PebbleBeach8.jpg','images/vt.jpg','images/DC.jpg','images/miami.jpg','images/uva.jpg','images/baltimore.jpg');
#$pictures = scandir('images/');
shuffle($pictures);
$picture = $pictures[0];
$disPlaypic = $picture
?>

	
<form method="POST" action="processApp.php">

	<img src="<?= $picture ?>" style="width: 600px;" />
    
    <textarea name="data"></textarea>

    <input type="hidden" name="assignmentId" value="<?= $_GET['assignmentId'] ?>" />
    <input type="hidden" name="workerId" value="<?= $_GET['workerId'] ?>" />
	<input type="hidden" name="img" value="<?= $picture ?>" />
    <input type="hidden" name="endpoint" value="sandbox" />
    <input type="submit" value="Submit HIT" />

</form>

</div>

</body>
</html>