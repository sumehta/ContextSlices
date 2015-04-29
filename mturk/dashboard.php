<!doctype html>
<html lang="en"> 
<head> 
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="css/lib/bootstrap.min.css">

    <script src="js/lib/jquery-2.1.3.min.js"></script>
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/lib/d3.min.js"></script>
</head>
<body id="dashboard_body">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ConctextSlice Dashboard</a>
        </div>
    </div>
</nav>
    

<!-- <h1>Dashboard</h1> -->
<div class="container-fluid" id="dashboard_container">

    <div class="col-md-3 col-md-offset-1">
        <div class="sidebar-nav-fixed affix" id="dash_left">

            <div class="row" id="dashboard_img_list">
                <div class="col-md-9">
                    <?php
                        // make sure we've picked an endpoint to filter by
                        if(!isset($_GET['endpoint'])) {
                            header('Location: dashboard.php?endpoint=production');
                            exit();
                        }
                        $endpoint = $_GET['endpoint'];
                        
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
                                header('Location: dashboard.php?endpoint='.urlencode($endpoint).'&img='.urlencode($img));
                                exit();
                            } else {
                                // if we've gotten this far, we've already selected an image
                                $selected = ($img == $selectedImg) ? ' selected' : '';
                                echo '<a href="dashboard.php?endpoint='.urlencode($endpoint).'&img='.urlencode($img).'" class="nav-image'.$selected.'" title="'.$img.'" alt="'.$img.'"><img src="'.$img.'" /></a>';
                            }
                        }
                    ?>              
                </div>
            </div>
            <div class="row">
                <div id="hist">
                </div>            
            </div>
            
        </div>
    </div>

    <div class="col-md-8">
        <div class="row" id="dashboard_content_table" class="shade-container">
            <table id="agg-reviews" class="table table-hover">
                <tr>
                    <th class="dash_table_width_22 dash_table_text_horizontal_center">Description</th>
                    <th class="dash_table_width_22 dash_table_text_horizontal_center">Name(s)</th>
                    <th class="dash_table_width_7 dash_table_text_horizontal_center">Conf %</th>
                    <th class="dash_table_width_22 dash_table_text_horizontal_center">Explanation</th>
                    <th class="dash_table_width_7 dash_table_text_horizontal_center"># Reviews</th>
                    <th class="dash_table_width_7 dash_table_text_horizontal_center">Avg Score</th>
                    <th class="dash_table_width_13 dash_table_text_horizontal_center">Feedback</th>
                </tr>
                <?php
                    // show info for the selected image
                    
                    $q = sprintf("SELECT assignment_id FROM app_db WHERE img_id = '%s' AND endpoint = '%s' ORDER BY id ASC",
                        $selectedImg,
                        $endpoint
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
                            echo '<td class="dash_table_text_vertical_middle">'.truncateString($row['description']).'</td>';
                            echo '<td class="dash_table_text_vertical_middle">'.truncateString($row['location']).'</td>';
                            echo '<td class="dash_table_text_horizontal_center dash_table_text_vertical_middle">'.$row['confidence'].'</td>';
                            echo '<td class="dash_table_text_vertical_middle">'.truncateString($row['why']).'</td>';
                            echo '<td class="dash_table_text_horizontal_center dash_table_text_vertical_middle">'.$s['num_reviews'].'</td>';
                            echo '<td class="dash_table_text_horizontal_center dash_table_text_vertical_middle">'.number_format($s['avg_score'],1).'</td>';
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
        </div>
    </div>

    <!-- <div class="col-md-9 col-md-offset-1">
        <div class="row" id="dashboard_img_list">
            <div class="col-md-9">
                <?php
                    // make sure we've picked an endpoint to filter by
                    if(!isset($_GET['endpoint'])) {
                        header('Location: dashboard.php?endpoint=production');
                        exit();
                    }
                    $endpoint = $_GET['endpoint'];
                    
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
                            header('Location: dashboard.php?endpoint='.urlencode($endpoint).'&img='.urlencode($img));
                            exit();
                        } else {
                            // if we've gotten this far, we've already selected an image
                            $selected = ($img == $selectedImg) ? ' selected' : '';
                            echo '<a href="dashboard.php?endpoint='.urlencode($endpoint).'&img='.urlencode($img).'" class="nav-image'.$selected.'" title="'.$img.'" alt="'.$img.'"><img src="'.$img.'" /></a>';
                        }
                    }
                ?>              
            </div>
            <div class="col-md-3" id="hist">
            </div>
        </div>

 -->


        <div id="vislayer-container" class="shade-container-light">
            <span class="glyphicon glyphicon-new-window btn" id="vislayer_icon"></span>
            <div id="vislayer">
                <div class="col-md-5" id="biset_doc_relevent_info">
                    <div class="panel panel-default vislayer_panel" id="biset_doc_from_bic">
                        <div class="panel-heading vislayer_panelTitle" id="biset_checked_bicID">
                            <h3 class="panel-title">Histogram</h3>
                        </div>
                        <div class="panel-body vislayer_panel_body">
                        </div>
                    </div>                      
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info vislayer_panel">
                        <div class="panel-heading vislayer_panelTitle">
                            <h3 class="panel-title">Timeline</h3>
                        </div>
                        <div class="panel-body vislayer_panel_body"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>


  
</div>
    <script src="js/histogram.js"></script>
    <script src="js/dtable.js"></script>
    <script src="js/vislayer.js"></script>
</body>
</html>