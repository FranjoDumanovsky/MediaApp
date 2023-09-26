<?php 
session_start();

$page_title = "Change your password";

include('includes/header.php');
include('includes/navbar.php');


?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">


            <?php if(isset($_SESSION['status'])) {
                    ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status']; ?> </h5>
                    </div>
                <?php
                    unset($_SESSION['status']);
                } ?>
                
                <div class="card">
                    <div class="card-header">
                        <h5>Change Password</h5>

                    </div>
                    <div class="card-body">
                        <form action="password-reset-code.php" method="POST">

                        <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                            <div class="form-group mb-3">
                                <label>Email Address</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email Adress" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label>New Password</label>
                                <input type="text" name="new_password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="form-group mb-3">
                                <label>Confirm Password</label>
                                <input type="text" name="confirm_password" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-success w-100" name="password_update">Send Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>