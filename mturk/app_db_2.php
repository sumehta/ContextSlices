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

//Get an description array. Get the number of rows in the table.


//ORDER by confidence
$q = sprintf(" SELECT * FROM app_db
    WHERE img_id = '%s'
    AND assignment_id != '%s' 
    ORDER BY confidence DESC
    LIMIT 5 ",
    $img_id,
    $assignment_Id
    );

$sth1 = mysql_query($q);

//ORDER by RAND
//$sth1 = mysql_query("SELECT assignment_id, description, location, img_id FROM app_db ORDER BY RAND()");

$i = 0;

while($r = mysql_fetch_assoc($sth1)) {
    
  $assId = $r['assignment_id'];
  $describeInfo = $r['description'];
  $locInfo = $r['location'];
  $confInfo = $r['why'];
  $imgInfo = $r['img_id'];
      
      echo '<tr>';
      echo '<td>' . $describeInfo . '</td>';
      echo '<td>' . $locInfo . '</td>';
      echo '<td>' . $confInfo .'</td>';
      echo '<td>
            <div><input type="radio" name="radio' . $i . '" value="1 ' . $assId . '">Definitely wrong</div>
            <div><input type="radio" name="radio' . $i . '" value="2 ' . $assId . '">Probably wrong</div>
            <div><input type="radio" name="radio' . $i . '" value="3 ' . $assId . '">Probably right</div>
            <div><input type="radio" name="radio' . $i . '" value="4 ' . $assId . '">Definitely right</div>
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