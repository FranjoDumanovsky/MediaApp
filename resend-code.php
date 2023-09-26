<?php 


session_start();
include("dbcon.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function resend_email_verify($name,$email,$verify_token) 
{
    $mail = new PHPMailer(true);
    
    try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'dumanovskyfinance@gmail.com';                     //SMTP username
    $mail->Password   = 'yykmxheirqsjfsbx';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('dumanovskyfinance@gmail.com', $name);
    $mail->addAddress($email, 'Joe User');     //Add a recipient

    // $mail->addReplyTo('info@example.com', 'Information');

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Resend - Email Verification';
    $email_template = "
        <h2>You have been Registrated with my Account</h2>
        <h5>Verify your email</h5>
        <br/><br/>
        <a href='https://croatiaholidays.hr/max_nema_pojma_php/verify-email.php?token=$verify_token'>Click</a>
    ";

    $mail->Body = $email_template;


    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

if(isset($_POST['resend_email_verify_btn'])){
    
    if(!empty(trim($_POST['email']))){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $checkemail_query_run = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($checkemail_query_run) > 0) {
            $row = mysqli_fetch_array($checkemail_query_run);

            if($row['verify_status'] == "0"){
                $name = $row['name'];
                $email = $email['email'];
                $verify_token = $row['verify_token'];
                
                resend_email_verify($name, $email, $verify_token);

                $_SESSION['status'] = "Verification email link has been sent to your email address";
                header("Location: login.php");
                exit(0);

            } else {

                $_SESSION['status'] = "Email is already verified. Please log in";
                header("Location: resend-email-verification.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Email is not registrated. Please register now";
            header("Location: registration.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Please enter the email field";
        header("Location: resend-email-verification.php");
        exit(0);
    }
}


?>