<?php
// Randomly genrate and worker id as well as assignment id

$workers = Array('joe', 'andy', 'kurt', 'vijay', 'chris', 'worker1', 'worker2', 'worker3');

shuffle($workers);

$asgnID = (string)rand(0, 9999);
$wrkrID = (string)$workers[0];

// used for local host
// header('Location: http://localhost/mturk/app_db.php?assignment_Id='.$asgnID.'&workerId='.$wrkrID);

//used for server side testing
header('Location: https://crowd.cs.vt.edu/slices/mturk/app_db.php?assignmentId='.$asgnID.'&workerId='.$wrkrID.'&endpoint=sandbox');


?>