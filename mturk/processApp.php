<?php

// get POST data from form
$description = $_POST['description'];
$location = $_POST['location'];
$assignmentID = $_POST['assignmentId'];
$workerID = $_POST['workerId'];
$img_id=$_POST['img'];
$endpoint = $_POST['endpoint'];



// connect to database
require_once './mysql.php';

// insert into database
$q = sprintf(" INSERT INTO app_db (worker_id, assignment_id, description, location, img_id, endpoint) VALUES ('%s', '%s', '%s', '%s', '%s', '%s') ",
    $workerID,
    $assignmentID,
    $description,
    $location,
	$img_id,
    $endpoint
    );
mysql_query($q);

// redirect us to submit to MTurk
header('Location: completed.php?assignmentId='.$assignmentID);

