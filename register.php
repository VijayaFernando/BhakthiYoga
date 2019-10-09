<?php
if(isset($_POST['email']))
{
    $to = "info@bhakthiyogasrilanka.com";
    $subject = "Class Register: Mail from the Website";

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
        !isset($_POST['optone']) ||
        !isset($_POST['opttwo']) ||
        !isset($_POST['opttwoo'])
    ) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $fullname = $_POST['fullname']; // required
    $email = $_POST['email']; // required
    $phone = $_POST['phone']; //required
    $teacher = $_POST['optone']; // required
    $class = $_POST['opttwo'];// required
    $time = $_POST['opttwoo'];// required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$fullname)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br />';
    }

    if(strlen($phone) < 9) {
        $error_message .= 'Please Insert a correct phone number<br />';
    }

    if(strlen($teacher) < 2) {
        $error_message .= 'Please Select a Teacher<br />';
    }

    if(strlen($class) < 2) {
        $error_message .= 'Please Select a Class<br />';
    }

    if(strlen($time) < 2) {
        $error_message .= 'Please Select a Time<br />';
    }

    if(strlen($error_message) > 0) {
        died($error_message);
    }

        $from = $_POST['email'];
        $firstname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $emailbody = "Name: ".$firstname . "\n" . "Teacher: " . $teacher."\n"  . "Class: " . $class."\n" . "Time: " . $time."\n" . "Tel: " . $phone;

        $headers = "From:" . $from;

        if(mail($to,$subject,$emailbody,$headers))
            echo "Mail Sent. Thank you" . $firstname . ", we will contact you shortly.";
        else
            echo"Mail Sent Failed";

        echo '<script>
            setTimeout(function() {
            //your code to be executed after 1 second
            alert("Your class registration is successful. Thank you.");
            window.location.href = "../";
            }, 300);
            
            </script>';


}else {
    # Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo '<p class="alert alert-warning">There was a problem with your submission, please try again.</p>';
}