<?php
$img_id=$_GET['img_id'];

?>
<!doctype html>
<html lang="en"> 
<head> 
<meta charset="utf-8">
<title>Evaluate Work</title>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
#eq > span {
  height:120px; float:left; margin:15px
}
</style>
<script>
$(function() {
  // setup master volume
  $( "#master" ).slider({
    value: 60,
    orientation: "horizontal",
    range: "min",
    animate: true
  });
  // setup graphic EQ
  $( "#eq > span" ).each(function() {
    // read initial values from markup and remove that
    var value = parseInt( $( this ).text(), 10 );
    $( this ).empty().slider({
      value: value,
      range: "min",
      animate: true,
      orientation: "vertical"
    });
  });
});
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

</head> 
<body>


<?php //Created reviewDescribe[] and reviewLocation[] arrays

//Connect to database
$USERNAME = 'root';   //database username
$PASSWORD = '';    //database password
$DATABASE = 'turk';   //database name
$URL = 'localhost';        //database location

//Just check correctly connect
$link = mysql_connect($URL, $USERNAME, $PASSWORD);
if (!$link) 
{
	error_log('Could not connect: ' . mysql_error());
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db($DATABASE, $link);
if (!$db_selected) 
{
	error_log('Could not connect: ' . mysql_error());
	die ('Could not connect: ' . mysql_error());
}

//Get an description array. Get the number of rows in the table.
$sth1 = mysql_query("SELECT description FROM app_db");
$rowCounter = 0;
$describeInfo = array();
while($r = mysql_fetch_assoc($sth1)) {
   $describeInfo[] = $r;
   $rowCounter++;
}

//Get an image array.
$sth2 = mysql_query("SELECT img_id FROM app_db");
$imgInfo = array();
while($r = mysql_fetch_assoc($sth2)) {
   $imgInfo[] = $r;
}

//Get an location array.
$sth3 = mysql_query("SELECT location FROM app_db");
$locInfo = array();
while($r = mysql_fetch_assoc($sth3)) {
   $locInfo[] = $r;
}

$reviewDescribe = array();
$reviewLocation = array();

//Store Id Array

for($i=0;$i<$rowCounter;$i++)
{
	if($imgInfo[$i]["img_id"]==$img_id)
	{
		$reviewDescribe[]=$describeInfo[$i]["description"];
		$reviewLocation[]=$locInfo[$i]["location"];
	}
	
}

if(count($reviewDescribe) == 0) {
	echo "<h3>There are no previous submissions for this image.</h3>";
}
else {

$table = '<table border="1" cellpadding="10">';
$table .= '<tr><td><b>' . "Results for 'Description'" . '</b></td>';
$table .= '<td><b>' . "Results for 'Location'" . '</b></td>';
$table .= '<td><b>' . "Rate it" . '</b></td></tr>';

for($i=0;$i<count($reviewDescribe)-1;$i++) {
     
    $review = $reviewDescribe[$i];  
    $loc = $reviewLocation[$i];   
    $table .= '<tr><td>' . $review . '</td>';
    $table .= '<td>' . $loc . '</td>';
    $table .= '<td><div id="eq"><span>88</span></div></td></tr>';
    // $table .= '<td><p>
//   	<label for="amount">Confidence Percentage:</label><input type="text" id="amount" readonly style="border:0; font-size:14px; width: 25px;">%</p><div id="slider-range-max"></div></td></tr>';
    $i++;
}

$table .= '</tr></table>';
}
?>

<h2>Thank you! Your submission has been saved.</h2>
<h4>Now, please take the time to evaluate the other answers we have for the image you just saw (replicated below).</h4>

<img src="<?= $img_id ?>" style="width: 600px;" />

<?php
echo $table
?>

<!-- <p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
  <span class="ui-icon ui-icon-volume-on" style="float:left; margin:-2px 5px 0 0;"></span>
  Master volume
</p> -->
 
<!-- <div id="master" style="width:260px; margin:15px;"></div> -->
 
<!-- <p class="ui-state-default ui-corner-all" style="padding:4px;margin-top:4em;">
  <span class="ui-icon ui-icon-signal" style="float:left; margin:-2px 5px 0 0;"></span>
  Graphic EQ
</p>
  -->
<!-- <div id="eq"><span>88</span></div> -->



<!-- <p>
    <label for="amount">Confidence Percentage:</label>
    <input type="text" id="amount" readonly style="border:0; font-size:14px; width: 25px;">%
</p>
<div id="slider-range-max"></div> -->


</body>
</html>