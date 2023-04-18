<?php 
    function send_activation_email(string $email, string $activation_code): void
    {
        //$conn = new mysqli("localhost:8080","root","1234","DBProj");
        // create the activation link
        $activation_link = "http://localhost/DBProject/activate.php?email=$email&activation_code=$activation_code";

        

        // set email subject & body
        $subject = 'Please activate your account';
        $message = <<<MESSAGE
                Hi,
                Please click the following link to activate your account:
                $activation_link
                MESSAGE;
        // email header
        $header = "From:" . "no-reply@gmail.com";

        // Set SMTP settings
        ini_set('SMTP', 'localhost'); // Replace with your SMTP server hostname
        ini_set('smtp_port', 25); // Replace with the appropriate port number for your SMTP server
        ini_set('sendmail_from', 'no-reply@gmail.com');

        // send the email
        mail($email, $subject, nl2br($message), $header);

    }
    Send_activation_email("suraj15102003@gmail.com","456");
?>