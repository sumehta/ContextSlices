<!doctype html>
<html lang="en"> 
<head> 
<meta charset="utf-8">
<title>Dashboard</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    

<h1>Dashboard</h1>
    
<?php

// make sure an image is already selected
if(isset($_GET['img']))
    $selectedImg = urldecode($_GET['img']);
else
    $selectedImg = null;

require_once 'mysql.php';

// show navigation menu

$q = sprintf("SELECT DISTINCT img_id FROM app_db ORDER BY img_id ASC");
$results = mysql_query($q);
while($row = mysql_fetch_assoc($results)) {
    $img = $row['img_id'];
    if(is_null($selectedImg)) {
        // no image is selected, so now that we know what images are available, let's select the first one
        header('Location: dashboard.php?img='.urlencode($img));
        exit();
    } else {
        // if we've gotten this far, we've already selected an image
        $selected = ($img == $selectedImg) ? ' selected' : '';
        echo '<a href="dashboard.php?img='.urlencode($img).'" class="nav-image'.$selected.'" title="'.$img.'" alt="'.$img.'"><img src="'.$img.'" /></a>';
    }
}

?>

    
<table id="agg-reviews">
    <tr>
        <th style="width: 20%;">Description</th>
        <th style="width: 20%;">Name(s)</th>
        <th style="width: 5%;">Conf %</th>
        <th style="width: 20%;">Explanation</th>
        <th style="width: 5%;"># Reviews</th>        
        <th style="width: 5%;">Avg Score</th>
        <th style="width: 25%;">Feedback</th>
    </tr>
    
<?php

// show info for the selected image

$q = sprintf("SELECT assignment_id FROM app_db WHERE img_id = '%s' ORDER BY id ASC",
    $selectedImg
            );
$results = mysql_query($q);

// this array holds Answer objects with each answer's assignment ID, score summary, # reviews, and avg score
$scoresArr = array();

while($row = mysql_fetch_assoc($results)) {
    $assignmentID = $row['assignment_id'];
    
    $q2 = sprintf("SELECT * FROM appreview_db WHERE beReviewer_id = '%s'",
        $assignmentID
        );
    $results2 = mysql_query($q2);

    $scores = 0;
    $numReviews = mysql_num_rows($results2);
    if($numReviews > 0) {
        while($row2 = mysql_fetch_assoc($results2)) {
            // add up all the review scores so we can get the avg
            $scores += convertReview($row2['buttonValue']);
        }
    }
    
    $answer = array(
        'assignment_id' => $assignmentID,
        'scores' => $scores,
        'num_reviews' => $numReviews,
        'avg_score' => getAvg($scores, $numReviews)
        );
    
    $scoresArr[] = $answer; // push to array
}

// (reverse) sort answers by average review score
usort($scoresArr, 'sortByAvgScore');

foreach($scoresArr as $s) {
    $q = sprintf("SELECT * FROM app_db WHERE assignment_id = '%s'",
        $s['assignment_id']
                );
    $results = mysql_query($q);
    while($row = mysql_fetch_assoc($results)) {
        echo '<tr>';
        echo '<td>'.truncateString($row['description']).'</td>';
        echo '<td>'.truncateString($row['location']).'</td>';
        echo '<td class="centered">'.$row['confidence'].'</td>';
        echo '<td>'.truncateString($row['why']).'</td>';
        echo '<td class="centered">'.$s['num_reviews'].'</td>';
        echo '<td class="centered">'.number_format($s['avg_score'],1).'</td>';
        echo '<td> </td>';
        echo '</tr>';
    }
}

function sortByAvgScore($a, $b) {
    $aAvg = $a['avg_score'];
    $bAvg = $b['avg_score'];
    if($aAvg == $bAvg)
        return 0;
    elseif($aAvg > $bAvg)
        return -1; // reverse sort
    else
        return 1;
}

function getAvg($total, $numItems) {
    if($numItems == 0)
        return 0;
    elseif($total == 0) // avoid division by zero
        return 0;
    else
        return ($total/$numItems);
}

function convertReview($review) {

    switch($review) {
        case 1: // definitely wrong
            $converted = 0;
            break;
        case 2: // probably wrong
            $converted = 25;
            break;
        case 3: // probably right
            $converted = 75;
            break;
        case 4: // definitely right
            $converted = 100;
            break;
        default:
            $converted = 0;
    }
    return ($converted);
}

function truncateString($string, $maxChars=300) {
    if(strlen($string) > $maxChars) {
        $truncated = substr($string, 0, $maxChars);
        $truncated .= " &hellip;";
        return $truncated;
    } else {
        return $string;
    }
}

?>
    
    </table>
    
</body>
</html>