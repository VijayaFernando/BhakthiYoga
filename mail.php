<?php
    if(isset($_POST['submit']))
    {
        $to = "vijayafernando@hotmail.com";
        $from = $_POST['email'];
        $firstname = $_POST['filename'];
        $subject = $_POST['phone'];
        $message = $firstname . " " . " wrote the following:" . "\n\n" . $_POST['message'];

        $headers = "From:" . $from;

        if(mail($to,$subject,$message,$headers))
            echo "Mail Sent. Thank you " . $firstname . ", we will contact you shortly.";
        else
            echo"Mail Sent Failed";
    }