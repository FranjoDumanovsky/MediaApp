<?php 

session_start();
$page_title = "Password reset form";
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
                        <h5>Reset Password</h5>

                    </div>
                    <div class="card-body">
                        <form action="password-reset-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for=""></label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email Adress">
                            </div>
                            <div class="form-group mb-3">
                                
                                <button type="submit" class="btn btn-primary" name="password_reset_link">Send Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>