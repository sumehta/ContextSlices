<?php
?>
<!doctype html>
<html lang="en"> 
<head> 
<meta charset="utf-8">
<title>Results</title>

</head> 
<body>

<form method="POST" id="form" action="processAppResults.php">
<?php //Created reviewDescribe[] and reviewLocation[] arrays

include 'mysql.php';

//Get an description array. Get the number of rows in the table.
$sth1 = mysql_query("SELECT assignment_id, buttonValue, img_id FROM appreview_db ORDER BY RAND()");
// $rowCounter = mysql_num_rows();
$i = 0;
//$describeInfo = array();

  $table = '<table border="1" cellpadding="10">';
  $table .= '<tr><td><b>' . "Assignment ID" . '</b></td>';
  $table .= '<td><b>' . "Buuton Value" . '</b></td>';
  $table .= '<td><b>' . "Image" . '</b></td></tr>';

$aggregateValue;
$assId;
	$buttonInfo;
	$imgInfo;

while($r = mysql_fetch_assoc($sth1)) {
		
	$assId = $r['assignment_id'];
	$buttonInfo = $r['buttonValue'];
	$imgInfo = $r['img_id'];
	
	      
      $table .= '<tr><td>' . $assId. '</td>';
      $table .= '<td>' . $buttonInfo . '</td>';
      $table .= '<td>' . $imgInfo . '</td></tr>';

      $i = $i + 1;      
	
}
  $table .= '</tr></table>';

?>

<?php echo $table ?>

</form>

</body>
</html>