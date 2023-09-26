<?php 
session_start();
include('dbcon.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

function sendemail_verify($name, $email, $verify_token){
    $mail = new PHPMailer(true);
    
    try {
    $mail->isSMTP();                                           //Send using SMTP
    // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Host       = 'mail.croatiaholidays.hr';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'admin@croatiaholidays.hr';                     //SMTP username
    $mail->Password   = 'j59M25W1';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('dumanovskyfinance@gmail.com', $name);
    $mail->addAddress($email, $name);     //Add a recipient

    // $mail->addReplyTo('info@example.com', 'Information');

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Resend the Email verification';
    $email_template = "
        <h2>You have been Registrated with my Account</h2>
        <h5>Verify your email</h5>
        <br/><br/>
        <a href='https://croatiaholidays.hr/max_nema_pojma_php/verify-email.php?token=$verify_token'>Click</a>
    ";

    $mail->Body = $email_template;


    $mail->send();
    // echo 'Message has been sent';
    } catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

if(isset($_POST['register_btn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    // Email exists or not
    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['status'] = "Emaul ID already exsists";
        header("Location: login.php");
    } else {
        //Insert users & register user data
        $query = "INSERT INTO users (name, phone, email, password, verify_token) VALUES ('$name', '$phone', $email', '$password', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if($query_run) {
            sendemail_verify("$name", "$email", "$verify_token");
            $_SESSION['status']= "Registration sucessfull! Please verify your Email Adress";
            header("Location: register.php");

        } else {
            $_SESSION['status'] = "Registration failed";
            header("Location: register.php");
        }

    }


}


?>