<?php

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$to      = 'contact@rileyboyd.com';
	$subject = 'Contact Form Message';
	$headers = "From: $name\r\nReply-to: $email";
	mail($to, $subject, $message, $headers);

?>
