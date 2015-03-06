<?php

$endpoint = 'sandbox';
require_once './mturk.php';

// Calculate the request authentication parameters 
$operation = "CreateHIT"; 
$title = "How's the weather?";
$description = 'Write a paragraph about the weather in your area.';
$keywords = "weather, fun, writing, vtcs5774";

$url = 'http://contextslices.kurtluther.com/weather.php';
$frame_height = 400;  // height of window, in pixels

$timestamp = generate_timestamp(time()); 
$signature = generate_signature($SERVICE_NAME, $operation, $timestamp, $AWS_SECRET_ACCESS_KEY); 


// Construct the request 
$url2 = $SERVICE_ENDPOINT
  . "?Service=" . urlencode($SERVICE_NAME) 
  . "&Operation=" . urlencode($operation) 
  . "&Title=" . urlencode($title) 
  . "&Description=". urlencode($description) 
  . "&Keywords=" . urlencode($keywords)
  . "&Reward.1.Amount=0.25" // payment per HIT
  . "&Reward.1.CurrencyCode=USD" // currency
  . "&Question=" . urlencode(constructQuestion($url, $frame_height)) 
  . "&AssignmentDurationInSeconds=3600" // time allocated per HIT (secs)
  . "&LifetimeInSeconds=3600" // how long HITs are available (secs)
  . "&AutoApprovalDelayInSeconds=86400" // how long until HIT is auto-approved
  . "&MaxAssignments=10" // how many workers needed for this HIT
  . "&Version=" . urlencode($SERVICE_VERSION) 
  . "&Timestamp=" . urlencode($timestamp) 
  . "&AWSAccessKeyId=" . urlencode($AWS_ACCESS_KEY_ID) 
  . "&ResponseGroup.0=Minimal"
  . "&ResponseGroup.1=HITDetail"
  . "&QualificationRequirement.1.QualificationTypeId=00000000000000000071" 
  . "&QualificationRequirement.1.Comparator=EqualTo" 
  . "&QualificationRequirement.1.LocaleValue.Country=US" 
  . "&QualificationRequirement.2.QualificationTypeId=000000000000000000L0" // min approval rate
  . "&QualificationRequirement.2.Comparator=GreaterThan" 
  . "&QualificationRequirement.2.IntegerValue=90"
  . "&QualificationRequirement.3.QualificationTypeId=00000000000000000040" // min approved HITs
  . "&QualificationRequirement.3.Comparator=GreaterThan" 
  . "&QualificationRequirement.3.IntegerValue=50" 
  . "&Signature=" . urlencode($signature);

// Make the request 
$xml = simplexml_load_file($url2); 

// Print any errors
if ($xml->OperationRequest->Errors) {
  print_errors($xml->OperationRequest->Errors->Error);
}

$hitID = strval($xml->HIT->HITId); 

if ($hitID != '') { 
	print "Created HIT ".$hitID." on Amazon Mechanical Turk (".$endpoint.")...<br/>\n"; 
}


print "====================<br/>\n";
