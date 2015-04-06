<?php

// get POST data from form
$assignmentID = $_POST['assignmentId'];

$beReviewer_id1=$_POST['reviewId1'];
$beReviewer_id2=$_POST['reviewId2'];
$beReviewer_id3=$_POST['reviewId3'];
$beReviewer_id4=$_POST['reviewId4'];
$beReviewer_id5=$_POST['reviewId5'];

$workerID = $_POST['workerId'];

$img_id=$_POST['img'];
$endpoint = $_POST['endpoint'];


if (!empty($_POST['radio0'])) 
{
    $radio0 = $_POST['radio0'];
} 

if (!empty($_POST['radio1'])) 
{
    $radio1 = $_POST['radio1'];
} 

if (!empty($_POST['radio2'])) 
{
    $radio2 = $_POST['radio2'];
} 

if (!empty($_POST['radio3'])) 
{
    $radio3 = $_POST['radio3'];
}

if (!empty($_POST['radio4'])) 
{
    $radio4 = $_POST['radio4'];
} 

if (!empty($_POST['radio5'])) 
{
    $radio5 = $_POST['radio5'];
}  

$rowNumber=$_POST['rowNumber'];

switch($rowNumber){
	case 1:
	//$buttonValue=$radio1;

	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID ,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);
	break;
	
	
	case 2:
	
	//$buttonValue=$radio1;
	
	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID ,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);

	//$buttonValue=$radio2;

	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID ,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
	break;
	
	
	case 3:
		//$buttonValue=$radio1;
	
	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID ,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio2;

	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID ,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio3;

	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id3,
    $assignmentID ,
    $radio2,
	$img_id,
    $endpoint
    );
mysql_query($q);
	break;
	
	
	case 4:
		//$buttonValue=$radio1;

	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID ,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);

	//$buttonValue=$radio2;
	
	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID ,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio3;
	
	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id3,
    $assignmentID ,
    $radio2,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio4;
	
	//require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id4,
    $assignmentID ,
    $radio3,
	$img_id,
    $endpoint
    );
	break;
mysql_query($q);
	
	case 5:
		//$buttonValue=$radio1;

	require_once './mysql.php';
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id1,
    $assignmentID ,
    $radio0,
	$img_id,
    $endpoint
    );
mysql_query($q);
require_once './mysql.php';
	//$buttonValue=$radio2;


$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id2,
    $assignmentID ,
    $radio1,
	$img_id,
    $endpoint
    );
mysql_query($q);
require_once './mysql.php';
	//$buttonValue=$radio3;

	
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id3,
    $assignmentID ,
    $radio2,
	$img_id,
    $endpoint
    );
mysql_query($q);
	//$buttonValue=$radio4;
	
	
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id4,
    $assignmentID ,
    $radio3,
	$img_id,
    $endpoint
    );
mysql_query($q);

	//$buttonValue=$radio5;
	
$q = sprintf(" INSERT INTO appreview_db (worker_id, beReviewer_id, assignment_id, radio,img_id, endpoint) VALUES ('%s', '%s', '%s', '%d','%s','%s')",
    $workerID,
    $beReviewer_id5,
    $assignmentID ,
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

