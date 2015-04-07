<?php
$img_id=$_GET['img_id'];
$assignment_Id=$_GET['assignment_Id'];
?>
<!doctype html>
<html lang="en"> 
<head> 
<meta charset="utf-8">
<title>Results</title>

</head> 
<body>



<form method="POST" id="form" action="processApp2.php">
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
//Get an id array.
$sth4 = mysql_query("SELECT assignment_id FROM app_db");
$idInfo = array();
while($r = mysql_fetch_assoc($sth4)) {
   $idInfo[] = $r;
}
$reviewDescribe = array();
$reviewLocation = array();
$reviewID = array();
//Store Id Array
for($i=0;$i<$rowCounter;$i++)
{
	if($imgInfo[$i]["img_id"]==$img_id)
	{
		if($idInfo[$i]["assignment_id"]!=$assignment_Id)
		{
		$reviewDescribe[]=$describeInfo[$i]["description"];
		$reviewLocation[]=$locInfo[$i]["location"];
		$reviewID[]=$idInfo[$i]["assignment_id"];
		}
	}
	
}
if(count($reviewDescribe) == 0) {
	echo "<h3>There are no previous submissions for this image.</h3>";
}
else {
  $table = '<table border="1" cellpadding="10">';
  $table .= '<tr><td><b>' . "Results for 'Description'" . '</b></td>';
  $table .= '<td><b>' . "Results for 'Location'" . '</b></td>';
  $table .= '<td><b>' . "Rating" . '</b></td>';
  $table .= '<td><b>' . "Feedback" . '<b></td></tr>';

  //Let the row number of the table less than or equals to 5.
  $rowNum=0;
	if((count($reviewDescribe))<=5){
	$rowNum=count($reviewDescribe);
	}
	else{
	$rowNum=5;
	}
  
  for($i=0;$i<$rowNum;$i++) {
       
      $review = $reviewDescribe[$i];  
      $loc = $reviewLocation[$i];   
      $table .= '<tr><td>' . $review . '</td>';
      $table .= '<td>' . $loc . '</td>';
      $table .= '<td>
            <div><input type="radio" name="radio' . $i . '" value="1 ' . $reviewID[$i] . '" checked>Definitely not right</div>
            <div><input type="radio" name="radio' . $i . '" value="2 ' . $reviewID[$i] . '">Definitely right</div>
            </td></tr>';
  }
  $table .= '</tr></table>';
}
?>

<h2>Thank you! Your feedback has been saved.</h2>

<img src="<?= $img_id ?>" style="width: 600px;" />

<?php echo $table ?>

<BR>
<BR>


	<input type="hidden" name="rowNumber" value="<?= $rowNum ?>" />
	<!-- 
	<input type="hidden" name="reviewId1" value="<?= $reviewID[0] ?>" />
	<input type="hidden" name="reviewId2" value="<?= $reviewID[1] ?>" />
	<input type="hidden" name="reviewId3" value="<?= $reviewID[2] ?>" />
	<input type="hidden" name="reviewId4" value="<?= $reviewID[3] ?>" />
	<input type="hidden" name="reviewId5" value="<?= $reviewID[4] ?>" />
 -->
	
    <input type="hidden" name="assignmentId" value="<?= $_GET['assignment_Id'] ?>" />
    <input type="hidden" name="workerId" value="<?= $_GET['workerId'] ?>" />
    <input type="hidden" name="img" value="<?= $img_id ?>" />
    <input type="hidden" name="endpoint" value="sandbox" />
    <input type="submit" value="Submit" style="font-size:25px;"/>

</form>

</body>
</html>