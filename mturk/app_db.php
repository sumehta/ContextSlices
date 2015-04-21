<!doctype html>
<html lang="en"> 
<head> 
<title>Identify image</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    
    // disable Submit button until HIT is accepted
   if(getParameterByName('assignmentId') == 'ASSIGNMENT_ID_NOT_AVAILABLE') {
        $('#submitButton').attr('disabled','disabled');
        $('#submitButton').val("Please accept HIT to submit");
        $('#image-cell').text("Please accept HIT to view image");
        $('#image-cell').css('background-size','0 0');
   }
    
    $( "#slider-range-max" ).slider({
      range: "max",
      min: 0,
      max: 100,
      value: 50,
      slide: function( event, ui ) {
        $( "#confidence" ).val( ui.value );
      }
    });
    
    $( "#submitButton" ).click(function(){
        // validate data was provided
       if($("#description").val() == '') {
           alert("You must provide a description (item #1).");
           return false;
       }
        if($("#location").val() == '') {
            alert("You must provide a name (item #2).");
            return false;
        }
        if($("#confidence").val() == '') {
            alert("You must rate your confidence by moving the slider (item #3)."); 
            return false;
        }
        if($("#why").val() == '') {
            alert("You must explain your confidence level (item #4).");
            return false;
        }
        
    });
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
    
</script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="styles.css" type="text/css" />
    
</head> 
<body>


<h1>Instructions (part 1/2)</h1>
    
<p>Look at the image below and (1) describe what you see, (2) give the specific name of what you see, (3) rate your confidence in your answer, and (4) explain your confidence level.<p>
    
<p>Note: You are not required to get the correct answer to be paid, as long as you put in a serious effort.</p>
    
<?php

// worker ID may not be available yet
if(isset($_GET['workerId']))
    $workerID = $_GET['workerId'];
else
    $workerID = '';

// choose picture for this task
$pictures = Array('images/1.jpg', 'images/2.jpg', 'images/3.jpg', 'images/4.jpg');

shuffle($pictures);
$picture = $pictures[0];

?>

	
<form method="POST" id="form" action="processApp.php">

    <table id="layout">
        <tr>
            <td id="image-cell" style="background-image: url(<?= $picture ?>);">
            </td>
            <td>
    <p>1. Describe what you see, using as much detail as possible.</p>
    <textarea id="description" name="description"></textarea>
    
    <p>2. Give the name(s) of what you see (name the person, town, object, etc.), being as specific as possible. If you don't know, use your best guess.</p>
    <textarea id="location" name="location"></textarea>
    
    <p>3. Rate your confidence in the above answer (#2) by moving the following slider left or right:</p>
    
    <table id="slider-table">
        <tr>
            <td colspan="3" style="text-align: center;">
                <label>Your confidence: <input type="text" id="confidence" name="confidence" readonly="readonly" style="width: 2em; font-size: medium; " />%</label>
            </td>
        </tr>
        <tr>
            <td class="slider-label" style="text-align: right;">Not at all confident</td>
            <td><div id="slider-range-max"> </div></td>
            <td class="slider-label" style="text-align: left;">Completely confident</td>
        </tr>
    </table>
	
	
	<p>4. Explain why you have that level of confidence about your answer. For example, if you knew a name, how did you know?</p>
    <textarea id="why" name="why"></textarea>

    <input type="hidden" name="assignmentId" value="<?= $_GET['assignmentId'] ?>" />
    <input type="hidden" name="workerId" value="<?= $workerID ?>" />
	<input type="hidden" name="img" value="<?= $picture ?>" />
    <input type="hidden" name="endpoint" value="<?= $_GET['endpoint'] ?>" />
    
    <br />
    <input id="submitButton" type="submit" value="Submit" />
                
                </td>
        </tr>
    </table>

</form>


</body>
</html>