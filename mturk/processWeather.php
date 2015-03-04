<?php

// get POST data from form
$weatherData = $_POST['weather'];
$assignmentID = $_POST['assignmentId'];
$workerID = $_POST['workerId'];
$image = $_POST['img'];
$endpoint = $_POST['endpoint'];


// connect to database
require_once './mysql.php';

// insert into database
$q = sprintf(" INSERT INTO where_img (worker_id, assignment_id, weather_data, img, endpoint) VALUES ('%s', '%s', '%s', '%s', '%s') ",
    $workerID,
    $assignmentID,
    $weatherData,
    $image,
    $endpoint
    );
mysql_query($q);


$q = sprintf(" INSERT INTO where_img2 (worker_id, assignment_id, weather_data, img, endpoint) VALUES ('%s', '%s', '%s', '%s', '%s') ",
    $workerID,
    $assignmentID,
    $weatherData,
    $image,
    $endpoint
    );
mysql_query($q);

// redirect us to submit to MTurk
header('Location: completed.php?assignmentId='.$assignmentID);

