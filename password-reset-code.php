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


function send_password_reset($get_name,$get_email,$token){
    $mail = new PHPMailer(true);
    
    try {
    $mail->isSMTP();                                           //Send using SMTP
    // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Host       = 'mail.croatiaholidays.hr';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'admin@croatiaholidays.hr';                     //SMTP username
    $mail->Password   = 'j59M25W1';                              //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('dumanovskyfinance@gmail.com', $get_name);
    $mail->addAddress($get_email, $get_name);     //Add a recipient

    // $mail->addReplyTo('info@example.com', 'Information');

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Resend the Email verification';
    $email_template = "
        <h2>Hello $get_name</h2>
        <h3>You are receiving this email because we received a password reset request for your account.</h3>
        <br/><br/>
        <a href='https://croatiaholidays.hr/php-test-app/password-change.php?token=$token&email=$get_email'>Click</a>
    ";

    $mail->Body = $email_template;


    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

if(isset($_POST['password_reset_link'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if (mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($chekc_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if ($update_token_run){
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['status'] = "We emailed you a password reset link";
            header("Location: password-reset.php");
            exit(0);

        } else {
            $_SESSION['status'] = "Something went wrong! #1";
            header("Location: password-reset.php");
            exit(0); 
        }

    } else {
        $_SESSION['status'] = "No email found";
        header("Location: password-reset.php");
        exit(0);
    }
}


if (isset($_POST['password_update'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if(!empty($token)){
        
        if(!empty($token) && !empty($new_password) && !empty($confirm_password)){

            // Checking token is valid or not
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($con, $check_token);
            
            if(mysqli_num_rows($check_token_run) > 0) {
                
                if($new_password == $confirm_password) {
                    
                    $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($con, $update_password);

                    if($update_password_run) {
                    
                        $new_token = md5(rand());
                        $update_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
                        $update_token_run = mysqli_query($con, $update_token);
    
                        $_SESSION['status'] = "New Password successfully updated";
                        header("Location: login.php");
                        exit(0);
                    } else {
    
                        $_SESSION['status'] = "Did not update password. Something went wrong!";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                } else {

                    $_SESSION['status'] = "Password and confirm password do not match";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);
                }


            } else {

                $_SESSION['status'] = "Invalid Token";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);
            }
        } else {

            $_SESSION['status'] = "All fields are required";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    } else {

        $_SESSION['status'] = "No token available";
        header("Location: password-change.php");
        exit(0);
    }
}

?>