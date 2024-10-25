

<!-- ======================================================== -->
<!--                  form validation					      -->
<!-- ======================================================== -->


<?php

$mysqli = new mysqli("localhost", "root", "", "freedomonline");
 

// Check connection

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
 global $name,$email,$subject,$message;

// Escape user inputs for security
if (isset($_REQUEST['name'])) {
	$name = $mysqli->real_escape_string($_REQUEST['name']);
}
if (isset($_REQUEST['email'])) {
	$email = $mysqli->real_escape_string($_REQUEST['email']);
}

if (isset($_REQUEST['name'])) {
	$subject = $mysqli->real_escape_string($_REQUEST['subject']);
}

if (isset($_REQUEST['message'])) {
	$message = $mysqli->real_escape_string($_REQUEST['message']);
}
 


// Attempt insert query execution


$sql = "INSERT INTO contact_forms (NAME,EMAIL,SUBJECT,MESSAGE) VALUES ('$name','$email','$subject','$message')";


$mysqli->query($sql);


header("Location:home");

 
// Close connection

?>