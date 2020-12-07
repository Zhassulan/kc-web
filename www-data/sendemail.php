<?php
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Thank you for contact us. As early as possible  we will contact you '
	);

    $name       = @trim(stripslashes($_POST['name'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $subject    = @trim(stripslashes($_POST['subject'])); 
    $message    = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = $mail['kc_operator1'];
    $email_to1 = $mail['kc_operator'];//replace with your email

    $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

    $success = @mail('temen@ets.kz;yugay@ets.kz', $subject, $body, 'From: <'.$site['from_email'].'>');

    echo json_encode($status);
    die;