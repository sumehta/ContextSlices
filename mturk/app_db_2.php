<?php
$img_id=$_GET['img_id'];
$assignment_Id=$_GET['assignment_Id'];
?>
<!doctype html>
<html lang="en"> 
<head> 
<meta charset="utf-8">
<title>Evaluate Work</title>

</head> 
<body>

<form method="POST" id="form" action="processApp2.php">
<?php //Created reviewDescribe[] and reviewLocation[] arrays

include 'mysql.php';

//Get an description array. Get the number of rows in the table.
//ORDER by confidence
$sth1 = mysql_query("SELECT assignment_id, description, location, img_id FROM app_db ORDER BY confidence DESC");
//ORDER by RAND
//$sth1 = mysql_query("SELECT assignment_id, description, location, img_id FROM app_db ORDER BY RAND()");
// $rowCounter = mysql_num_rows();
$i = 0;
//$describeInfo = array();

  $table = '<table border="1" cellpadding="10">';
  $table .= '<tr><td><b>' . "Results for 'Description'" . '</b></td>';
  $table .= '<td><b>' . "Results for 'Location'" . '</b></td>';
  $table .= '<td><b>' . "Review the Location" . '</b></td></tr>';

while($r = mysql_fetch_assoc($sth1)) {
		
	$assId = $r['assignment_id'];
	$describeInfo = $r['description'];
	$locInfo = $r['location'];
	$imgInfo = $r['img_id'];
	
	if($imgInfo == $img_id && $assId!=$assignment_Id && $i < 5)
	{       
      $table .= '<tr><td>' . $describeInfo . '</td>';
      $table .= '<td>' . $locInfo . '</td>';
      $table .= '<td>
            <div><input type="radio" name="radio' . $i . '" value="1 ' . $assId . '">Definitely wrong</div>
            <div><input type="radio" name="radio' . $i . '" value="2 ' . $assId . '">Probably wrong</div>
            <div><input type="radio" name="radio' . $i . '" value="3 ' . $assId . '">Probably right</div>
            <div><input type="radio" name="radio' . $i . '" value="4 ' . $assId . '">Definitely right</div>
            </td></tr>';
      $i = $i + 1;      
	}
}
  $table .= '</tr></table>';

?>

<h2>Thank you! Your submission has been saved.</h2>
<h4>Now, please take the time to evaluate the other answers we have for the image you just saw (replicated below).</h4>

<img src="<?= $img_id ?>" style="width: 600px;" />

<?php echo $table ?>

<BR>
<BR>


	<input type="hidden" name="rowNumber" value="<?= $i ?>" />
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
    <input type="submit" value="Submit Answers" style="font-size:25px;"/>

</form>

</body>
</html>