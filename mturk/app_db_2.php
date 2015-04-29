<?php

$assignment_Id=$_GET['assignmentId'];

// get info for this assignment
require_once 'mysql.php';

$q = sprintf(" SELECT * FROM app_db WHERE assignment_id = '%s' ",
    $assignment_Id
            );
$results = mysql_query($q);
while($row = mysql_fetch_assoc($results)) {
    $img_id = $row['img_id'];
    $workerId = $row['worker_id'];
    $endpoint = $row['endpoint'];
}

?>
<!doctype html>
<html lang="en"> 
<head> 
<meta charset="utf-8">
<title>Review work</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
    

$(document).ready(function(){
   
    // validate each answer is reviewed
    
    $('#submitButton').click(function(){
        // count how many radio buttons are filled
        var checkedRadioButtons = $("input[type=radio]:checked");
        // make sure this equals number of rows total
        if(checkedRadioButtons.length != $('#numRows').val()) {
            alert("You must review every answer.");
            return false;
        }
    });
});
    
</script>
</head> 
        
<body>
    
<h1>Instructions (part 2/2)</h1>

<p>For the last part of this task, please evaluate the answers from other workers.</p>


<div style="width: 50%; margin-bottom: 15px;"><img src="<?= $img_id ?>" style="width: 100%;"></div>

            
<form method="POST" id="form" action="processApp2.php">
            
<table id="reviews-table">
    <tr>
        <th>Description</th>
        <th>Specific names</th>
        <th>Explanation</th>
        <th>Your review</th>
    </tr>

<?php
//Select all assigmentIds in the app_db and count how many times they have been reviewed in the appreview_db.
$q2 = sprintf(" SELECT * FROM app_db
    WHERE img_id = '%s'
    AND assignment_id != '%s'
	AND endpoint = '%s'	",
    $img_id,
    $assignment_Id,
    $endpoint
    );
	$sth2 = mysql_query($q2);
	
	$count=array();
	$countAssId = array();
	$countDescribeInfo = array();
	$countLocInfo = array();
	$countConfInfo = array();
	$countImgInfo = array();
	//Use array to store all the information
	while($r2 = mysql_fetch_assoc($sth2)) {
    
	$countAssId[] = $r2['assignment_id'];
	$countDescribeInfo[] = $r2['description'];
	$countLocInfo[] = $r2['location'];
	$countConfInfo[] = $r2['why'];
	$countImgInfo[] = $r2['img_id'];
	
	$results = mysql_query("SELECT * FROM appreview_db WHERE beReviewer_id='{$r2['assignment_id']}'");
	//$count is an array store the number of times the 'assignment_id' been reviewed in appreview_db.
	
	$count[]= mysql_num_rows($results);
	
	}
	
	//$list5 is an array to sort the index in $count by the value of $count. 
	$list5=array();
	asort($count);
	foreach ($count as $key => $val) 
	{
    $list5[]=$key; 
	}
	
	$i = 0;

	while($i<5) {
    
	$assId = $countAssId[$list5[$i]];
	$describeInfo = $countDescribeInfo[$list5[$i]];
	$locInfo = $countLocInfo[$list5[$i]];
	$confInfo = $countConfInfo[$list5[$i]];
	$imgInfo = $countImgInfo[$list5[$i]];
      
      echo '<tr>';
      echo '<td>' . $describeInfo . '</td>';
      echo '<td>' . $locInfo . '</td>';
      echo '<td>' . $confInfo .'</td>';
      echo '<td>
            <label><input type="radio" name="radio' . $i . '" value="4 ' . $assId . '"> Definitely right</label>
			<label><input type="radio" name="radio' . $i . '" value="3 ' . $assId . '"> Probably right</label>
			<label><input type="radio" name="radio' . $i . '" value="2 ' . $assId . '"> Probably wrong</label>
			<label><input type="radio" name="radio' . $i . '" value="1 ' . $assId . '"> Definitely wrong</label>
             
            </td>';
      echo '</tr>';
      $i++;      
}

?>

</table>
  
<input type="hidden" name="assignmentId" value="<?= $assignment_Id ?>" />
<input type="hidden" id="numRows" name="numRows" value="<?= $i ?>" />

<input id="submitButton" type="submit" value="Submit" />

</form>


</body>
</html>