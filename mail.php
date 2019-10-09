<?php
    if(isset($_POST['email']))
    {
        $secretKey = '6LdGoLcUAAAAAOQnjmeIlTXhOdgYyxtFYkxx52Cd';
        $captcha = $_POST['g-recaptcha-response'];

        if(!$captcha){
            echo '<p class="alert alert-warning">Please check the the captcha form.</p>';
            exit;
        }

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

        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);

        if(intval($responseKeys["success"]) !== 1) {
            echo '<p class="alert alert-warning">Please check the the captcha form.</p>';
        } else {
            $from = $_POST['email'];
            $firstname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $emailbody = $firstname . " " . " wrote the following:" . "\n\n" . $_POST['message'] . "\n\nTel: " . $phone;

            $headers = "From:" . $from;

            if(mail($to,$subject,$emailbody,$headers))
                echo "<font colour='green' >Mail Sent. Thank you </font>" . $firstname . ", we will contact you shortly.";
            else
                echo"Mail Sent Failed";

            echo '<script>
            setTimeout(function() {
            //your code to be executed after 1 second
            alert("Your Email is successfully send. Thank you.");
            window.location.href = "../";
            }, 300);            
            </script>';
            }

    }else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo '<p class="alert alert-warning">There was a problem with your submission, please try again.</p>';
    }