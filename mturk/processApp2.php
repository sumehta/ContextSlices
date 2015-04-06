<?php

// get POST data from form
$assignmentID = $_POST['assignmentId'];

$workerID = $_POST['workerId'];

$img_id=$_POST['img'];
$endpoint = $_POST['endpoint'];


if (!empty($_POST['radio0'])) 
{
    $data = $_POST['radio0'];
    $radio0 = (int)$data[0];
    $beReviewer_id1 = substr($data, 2);

} 

if (!empty($_POST['radio1'])) 
{
    $data = $_POST['radio0'];
    $radio1 = (int)$data[0];
    $beReviewer_id2 = substr($data, 2);
} 

if (!empty($_POST['radio2'])) 
{
    $data = $_POST['radio0'];
    $radio2 = (int)$data[0];
    $beReviewer_id3 = substr($data, 2);
} 

if (!empty($_POST['radio3'])) 
{
    $data = $_POST['radio0'];
    $radio3 = (int)$data[0];
    $beReviewer_id4 = substr($data, 2);
}

if (!empty($_POST['radio4'])) 
{
    $data = $_POST['radio0'];
    $radio4 = (int)$data[0];
    $beReviewer_id5 = substr($data, 2);
} 

$rowNumber=$_POST['rowNumber'];

switch($rowNumber){
	case 1:
	//$buttonValue=$radio1;

	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);
	break;
	
	
	case 2:
	
	//$buttonValue=$radio1;
	
	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);

	//$buttonValue=$radio2;

	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
	break;
	
	
	case 3:
		//$buttonValue=$radio1;
	
	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio2;

	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio3;

	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id3,
    $assignmentID,
    $radio2,
	$img_id,
    $endpoint
    );
mysql_query($q);
	break;
	
	
	case 4:
		//$buttonValue=$radio1;

	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);

	//$buttonValue=$radio2;
	
	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio3;
	
	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id3,
    $assignmentID,
    $radio2,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio4;
	
	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id4,
    $assignmentID,
    $radio3,
	$img_id,
    $endpoint
    );
	break;
mysql_query($q);
	
	case 5:
		//$buttonValue=$radio1;

	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);
require_once './mysql.php';
	//$buttonValue=$radio2;


$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
require_once './mysql.php';
	//$buttonValue=$radio3;

	
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id3,
    $assignmentID,
    $radio2,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio4;
	
	
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id4,
    $assignmentID,
    $radio3,
	$img_id,
    $endpoint
    );
mysql_query($q);

	//$buttonValue=$radio5;
	
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio, img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id5,
    $assignmentID,
    $radio4,
	$img_id,
    $endpoint
    );
mysql_query($q);
	break;
	
}




// redirect us to second page for additional information
//header('Location: app_db_2.php?img_id='.$img_id);

// redirect us to submit to MTurk


header('Location: completed.php?assignmentId='.$assignmentID);

