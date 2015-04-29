<?php
    $action = $_POST['action'];
    $selImgID = $_POST['selImgID'];

    require_once 'mysql.php';

    $query = "select confidence, count(confidence) as freq from app_db where img_id = '" 
        . $selImgID . "' GROUP BY confidence ORDER BY confidence DESC";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {
        $jsonArray[] = array('confidence'=>$row['confidence'], 'freq'=>$row['freq']);
    }

    // encode the array in json style
    echo json_encode($jsonArray);
?>