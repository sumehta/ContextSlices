<?php

// get POST data from form
$user_data = $_POST['data'];
$assignmentID = $_POST['assignmentId'];
$workerID = $_POST['workerId'];
$img_id=$_POST['img'];
$endpoint = $_POST['endpoint'];



// connect to database
require_once './mysql.php';

// insert into database
$q = sprintf(" INSERT INTO app_db (worker_id, assignment_id, user_data, img_id, endpoint) VALUES ('%s', '%s', '%s', '%s', '%s') ",
    $workerID,
    $assignmentID,
    $user_data,
	$img_id,
    $endpoint
    );
mysql_query($q);

// redirect us to submit to MTurk
header('Location: completed.php?assignmentId='.$assignmentID);

