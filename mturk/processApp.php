<?php

// get POST data from form
$description = $_POST['description'];
$location = $_POST['location'];
$confidence = $_POST['confidence'];
$why = $_POST['why'];
$assignmentID = $_POST['assignmentId'];
$workerID = $_POST['workerId'];
$img_id=$_POST['img'];
$endpoint = $_POST['endpoint'];



// connect to database
require_once './mysql.php';

// insert into database
$q = sprintf(" INSERT INTO app_db (worker_id, assignment_id, description, location, confidence, why, img_id, endpoint) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s') ",
    $workerID,
    $assignmentID,
    $description,
    $location,
    $confidence,
    $why,
	$img_id,
    $endpoint
    );
mysql_query($q);

// redirect us to second page for additional information
header('Location: app_db_2.php?img_id='.$img_id);

// redirect us to submit to MTurk
// header('Location: completed.php?assignmentId='.$assignmentID);

