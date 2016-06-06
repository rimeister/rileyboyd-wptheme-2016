<?php

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$to      = 'contact@rileyboyd.com';
	$subject = 'Contact Form Message';
	$headers = "From: $name\r\nReply-to: $email";
	$message = 'From: '.$name.' <'.$email.'>'.\r\n.$message;
	mail($to, $subject, $message, $headers);

?>
