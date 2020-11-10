<?php

    function IsInjected($str) {
        $injections = array('(\n+)',
            '(\r+)',
            '(\t+)',
            '(%0A+)',
            '(%0D+)',
            '(%08+)',
            '(%09+)'
            );
                
        $inject = join('|', $injections);
        $inject = "/$inject/i";
        
        if(preg_match($inject,$str)) {
            return true;
        } else {
            return false;
        }
    }


    $errors = "";
    $file = fopen("C:\\Users\\melis\\git\\MelissaChowWebsite\\email.txt", "r");
    $myemail = fgets($file);
    fclose($file);

    // check if any of the fields are empty; all are required
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

    // check if email is not spam
    if(isInjected($email_address)) {
        $errors .= "\n Error: Bad email value";
    }

    if(empty($errors)) {
        $to = $myemail;
        $email_subject = "New contact submission: $name";
        $email_body = "You have received a new message from $name. \r\n".
        "Email: $email_address \r\n".
        "Message: \r\n $message \r\n".
        "#mcwebsite \r\n";
        $headers = "From: $myemail \r\n";
        $headers .= "Reply-To: $email_address \r\n";
        $success = mail($to,$email_subject,$email_body,$headers);
        if(!$success) {
            echo $errors;
        }
        //redirect to the ‘thank you’ page
        //header('Location: thanks_sub.html');
    }
?>