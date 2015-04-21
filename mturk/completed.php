<!doctype html>
<html lang="en"> 
<head> 
<title>Completed</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
</head> 
<body>

<h1>Submit your work</h1>
    
<p>Any feedback on this task? (optional)</p>
    
<?php

// connect to database
require_once './mysql.php';

// get endpoint for this assignmentID

$assignmentID = $_GET['assignmentId'];

$q = sprintf("SELECT endpoint FROM app_db WHERE assignment_id = '%s'",
        $assignmentID
        );
$results = mysql_query($q);
//if(mysql_num_rows($results) == 0) {
//    die("Error: could not find this assignment.");   
//}
while($row = mysql_fetch_assoc($results)) {
    $endpoint = $row['endpoint'];
}

if($endpoint == "production")
    $endpointURL = 'https://www.mturk.com/mturk/externalSubmit';
else
    $endpointURL = 'https://workersandbox.mturk.com/mturk/externalSubmit';

?>
    
<form method="POST" action="<?= $endpointURL ?>">
    
    <textarea name="feedback"></textarea>
    
    <input type="hidden" id="assignmentId" name="assignmentId" value="<?= $assignmentID ?>" />
    <br />
    <input type="submit" name="submit" value="Submit HIT" />

</form>
    
</body>
</html>