<?php

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$to      = 'contact@rileyboyd.com';
	$subject = 'Contact Form Message';
	$headers = 'From: '.$name.' <'.$email.'>'."\r\n".'Reply-to: '.$email;
	//rom: '.$name.' <'.$email.'>'
	mail($to, $subject, $message, $headers);

?>
