<?php
$img_id=$_GET['img_id'];

?>
<!doctype html>
<html lang="en"> 
<head> 
<title>Evaluate Work</title>
<meta charset="utf-8">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#slider" ).slider();
  });
  </script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#radio" ).buttonset();
  });
  </script>
</head> 
<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
</script>


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
$table .= '<td><b>' . "Results for 'Location'" . '</b></td></tr>';

for($i=0;$i<count($reviewDescribe)-1;$i++) {
     
    $review = $reviewDescribe[$i];  
    $loc = $reviewLocation[$i];   
    $table .= '<tr><td>' . $review . '</td>';
    $table .= '<td>' . $loc . '</td></tr>';
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

<div id="slider"></div>


</body>
</html>