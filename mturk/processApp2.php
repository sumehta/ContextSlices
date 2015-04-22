<?php

// get POST data from form
$assignmentID = $_POST['assignmentId'];
$numRows = $_POST['numRows'];

// get other data for this task
require_once 'mysql.php';

$q = sprintf(" SELECT * FROM app_db WHERE assignment_id = '%s' ",
    $assignmentID
    );
$results = mysql_query($q);
while($row = mysql_fetch_assoc($results)) {
    $workerID = $row['worker_id'];
    $imgID = $row['img_id'];
    $endpoint = $row['endpoint'];
}

// go through each row (review)
for($i=0; $i<$numRows; $i++) {
    
    // get the raw review
    $rawReview = $_POST['radio'.$i];
    $reviewArr = explode(" ", $rawReview); // split by blank space
    $reviewScore = $reviewArr[0]; // the worker's review
    $reviewAssignmentID = $reviewArr[1]; // the assignmend ID being reviewed
    
    // insert review into database
    $q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, buttonValue, img_id, endpoint)
        VALUES ('%s', '%s', '%s', '%d','%s','%s')",
        mysql_real_escape_string($workerID),
        mysql_real_escape_string($reviewAssignmentID),
        mysql_real_escape_string($assignmentID),
        mysql_real_escape_string($reviewScore),
        mysql_real_escape_string($imgID),
        mysql_real_escape_string($endpoint)
        );
    mysql_query($q);
//    echo $q;
}

// redirect to Completed page
header('Location: completed.php?assignmentId='.$assignmentID);