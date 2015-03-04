<!doctype html>
<html lang="en"> 
<head> 
<title>Weather task</title>
</head> 
<body>

<h3>Submit your work</h3>
    
<p>Thanks for completing the task. Click the button below to submit your work.</p>
    
<form method="POST" action="https://workersandbox.mturk.com/mturk/externalSubmit">
    
    <input type="hidden" id="assignmentId" name="assignmentId" value="<?= $_GET['assignmentId'] ?>" />
    
    <input type="submit" value="Submit HIT" />

</form>
    
</body>
</html>