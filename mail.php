<?php
    if(isset($_POST['email']))
    {
        $to = "info@bhakthiyogasrilanka.com";
        $subject = "Mail from the Website";

        function died($error) {
            // your error code can go here
            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
            echo "These errors appear below.<br /><br />";
            echo $error."<br /><br />";
            echo "Please go back and fix these errors.<br /><br />";
            die();
        }

        // validation expected data exists
        if(!isset($_POST['fullname']) ||
            !isset($_POST['email']) ||
            !isset($_POST['phone']) ||
            !isset($_POST['message'])) {
            died('We are sorry, but there appears to be a problem with the form you submitted.');
        }

        $fullname = $_POST['fullname']; // required
        $email = $_POST['email']; // required
        $phone = $_POST['phone']; // not required
        $message = $_POST['message']; // required

        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

        if(!preg_match($email_exp,$email)) {
            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
        }

        $string_exp = "/^[A-Za-z .'-]+$/";

        if(!preg_match($string_exp,$fullname)) {
            $error_message .= 'The Name you entered does not appear to be valid.<br />';
        }

        if(strlen($message) < 2) {
            $error_message .= 'The Message you entered do not appear to be valid.<br />';
        }

        if(strlen($error_message) > 0) {
            died($error_message);
        }

        $from = $_POST['email'];
        $firstname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $emailbody = $firstname . " " . " wrote the following:" . "\n\n" . $_POST['message'];

        $headers = "From:" . $fullname;

        if(mail($to,$subject,$emailbody,$headers))
            echo "<font colour='green' >Mail Sent. Thank you </font>" . $firstname . ", we will contact you shortly.";
        else
            echo"Mail Sent Failed";
            
       echo '<script>
        setTimeout(function() {
            //your code to be executed after 1 second
        }, 300000);
       window.location.href = "../";
       </script>';
    }