<?php
 if(isset($_POST['email'])) {
    $email_to = "hello@bransive.com.au";
    $email_subject = "Bransive Contact Form";
    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo $error."<br /><br />";
        die();
    }
    if(!isset($_POST['full_name']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['company']) || !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }
    $name = $_POST['full_name'];
    $email_from = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
    $comments = $_POST['message'];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email_from)) {
        $error_message .= '<div class="email-erorr">Please enter a valid email.</div>';
    }
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$name)) {
        $error_message .= '<div class="name-erorr">Please enter your name.</div>';
    }
    if(strlen($comments) < 2) {
        $error_message .= '<div class="message-erorr">Please enter a message.</div>';
    }
    if(strlen($error_message) > 0) {
        died($error_message);
    }
    $email_message = "Form details below.\n\n";
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $email_message, $headers);
    header( 'Location: https://bransive.com.au/contact' ) ;
?>

<div class="success_message">Your message was sent.</div>
<?php
}
?>
