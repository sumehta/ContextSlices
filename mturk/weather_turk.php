<!doctype html>
<html lang="en"> 
<head> 
<title>Weather task</title>
<style type="text/css">

textarea {
    width: 400px;
    height: 80px;
    display: block;
}
    
</style>
</head> 
<body>
       
<h3>Instructions</h3>
    
<p>Write a paragraph (a few sentences) describing the weather in your area. How does it look? How does it feel?</p>
    
<form method="POST" action="https://workersandbox.mturk.com/mturk/externalSubmit">
    
    <textarea name="weather"></textarea>
    
    <input type="hidden" name="assignmentId" value="<?= $_GET['assignmentId'] ?>" />
    
    <input type="submit" value="Submit HIT" />

</form>


</body>
</html>