<?php

//Connect to database
$USERNAME = 'root';   //database username
$PASSWORD = '';    //database password
$DATABASE = 'turk';   //database name
$URL = 'localhost';        //database location

$link = mysql_connect($URL, $USERNAME, $PASSWORD);
if (!$link) 
{
	error_log('Could not connect: ' . mysql_error());
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db($DATABASE, $link);
if (!$db_selected) 
{
	error_log('Could not connect: ' . mysql_error());
	die ('Could not connect: ' . mysql_error());
}