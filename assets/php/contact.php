<?php

/*
	The Send Mail php Script for Contact Form
	Server-side data validation is also added for good data validation.
*/

header('Content-Type: application/json');

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if( empty($name) ){
	echo json_encode(array('type' => 'warning', 'message' => 'Please Enter Your Name!'));
}
else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
	echo json_encode(array('type' => 'warning', 'message' => 'Please Enter A Valid Email Address!'));
}
else if( empty($message) ){
	echo json_encode(array('type' => 'warning', 'message' => 'Please Type Your Messege'));
}
else{

	$formcontent="name: $name\nemail: $email\nsubject: $subject\nmessage: $message";

	//Place your Email Here
	$recipient = "rashvandmohammad1300@gmail.com";

	$mailheader = "From:$email\r\n";

	if( mail($recipient, 'New Message', $formcontent, $mailheader) ){
		echo json_encode(array('type' => 'success', 'message' => 'Sent!'));
	}
	else{
		echo json_encode(array('type' => 'danger', 'message' => 'Error!'));
	}
}

?>