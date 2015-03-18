<?php
$img_id=$_GET['img_id']
?>


<!doctype html>
<html lang="en"> 
<head> 
<title>Evaluate Work</title>
</head> 
<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

// $(document).ready(function(){
//    if(getParameterByName('assignmentId') == 'ASSIGNMENT_ID_NOT_AVAILABLE') {
//         $('#notAccepted').show();
//         $('#accepted').hide();
//    } else {
//         $('#accepted').show();
//         $('#notAccepted').hide();
//    }
// });
// 
// function getParameterByName(name) {
//     name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
//     var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
//         results = regex.exec(location.search);
//     return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
// }

// $(document).ready(function() {
//     var data = [["City 1", "City 2", "City 3"], //headers
//                 ["New York", "LA", "Seattle"], 
//                 ["Paris", "Milan", "Rome"], 
//                 ["Pittsburg", "Wichita", "Boise"]]
//     var cityTable = makeTable($(document.body), data);
// });
// 
// function makeTable(container, data) {
//     var table = $("<table/>").addClass('CSSTableGenerator');
//     $.each(data, function(rowIndex, r) {
//         var row = $("<tr/>");
//         $.each(r, function(colIndex, c) { 
//             row.append($("<t"+(rowIndex == 0 ?  "h" : "d")+"/>").text(c));
//         });
//         table.append(row);
//     });
//     return container.append(table);
// }
    
</script>

<?php
// Include database connection
include_once './mysql.php';
// SQL query to interact with info from our database
$sql = mysql_query("SELECT description FROM app_db"); 
$i = 0;
// Establish the output variable
$des_table = '<table border="1" cellpadding="10">';
while($row = mysql_fetch_array($sql)){ 
    
    //$id = $row["img_id"];
    $member_name = $row["description"];
    
    $des_table .= '<tr><td>' . $member_name . '</td>';
    // if ($i % 3 == 0) { // if $i is divisible by our target number (in this case "3")
//         $dyn_table .= '<tr><td>' . $member_name . '</td>';
//     } else {
//         $dyn_table .= '<td>' . $member_name . '</td>';
//     }
    $i++;
}
$des_table .= '</tr></table>';
?>

<h2>Thank you! Your submission has been saved.</h2>
<BR>
<h4>Now, please take the time to evaluate the other answers we have for the image you just saw.</h4>


<h3>Results for 'Description'</h3>
<?php 

echo $des_table; 


// Include database connection
include_once './mysql.php';
// SQL query to interact with info from our database
$sql = mysql_query("SELECT location FROM app_db"); 
$i = 0;
// Establish the output variable
$loc_table = '<table border="1" cellpadding="10">';
while($row = mysql_fetch_array($sql)){ 
    
    //$id = $row["img_id"];
    $member_name = $row["location"];
    
    $loc_table .= '<tr><td>' . $member_name . '</td>';
    // if ($i % 3 == 0) { // if $i is divisible by our target number (in this case "3")
//         $dyn_table .= '<tr><td>' . $member_name . '</td>';
//     } else {
//         $dyn_table .= '<td>' . $member_name . '</td>';
//     }
    $i++;
}
$loc_table .= '</tr></table>';

?>

<h3>Results for 'Location'</h3>
<?php 

echo $loc_table; ?>

</body>
</html>