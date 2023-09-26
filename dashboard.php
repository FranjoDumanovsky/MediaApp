<?php 

session_start();
include('authentication.php');

$page_title = "Dashboard";
include('includes/header.php');
include('includes/navbar.php')

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_SESSION['status'])) {
                ?> 
                    <div class="alert alert-success">
                        <h5>
                            <?= $_SESSION['status']; ?>
                        </h5>
                    </div>
                <?php 
                    unset($_SESSION['status']); 
                } ?>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4>User dashboard</h4>
                </div>
                <div class="card-body">
                <h4>Access when you are Logged In</h4>
                        <hr>
                        <h5>Username: <?= $_SESSION['auth_user']['username'];?></h5>
                        <h5>Email: <?= $_SESSION['auth_user']['email'];?></h5>
                        <h5>Phone: <?= $_SESSION['auth_user']['phone'];?></h5>

                        <a style="font-size:50px;" href="https://croatiaholidays.hr/max_nema_pojma_php/ultimate_app.php">Become A programer NOW!!</a>
                </div>
            </div>
        </div>
    </div>
</div>