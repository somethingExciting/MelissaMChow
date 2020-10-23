<?php
    $errors = "";
    $myemail = 'melissachowmq@gmail.com';

    // all fields are required
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject'])) {
        $errors .= "\n Error: all fields are required";
    }

    // get all fields
    $name = $_POST['name'];
    $email_address = $_POST['email'];
    $message = $_POST['message'];

    // use regex to check if valid email address
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address)) {
        $errors .= "\n Error: Invalid email address";
    }

    if( empty($errors)) {
        $to = $myemail;
        $email_subject = "Contact form submission: $name";
        $email_body = "You have received a new message.\n"."Name: $name \n"."Email: $email_address\n Message \n $message";
        $headers = "From: $myemail\n";
        $headers .= "Reply-To: $email_address";
        mail($to,$email_subject,$email_body,$headers);
        //redirect to the ‘thank you’ page
        header('Location: thanks_sub.html');
    }
?>