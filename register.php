<?php 
session_start();
$page_title = "Registration Page";
include('includes/header.php');
include('includes/navbar.php')
?>



<div>
    <div>
        <div>
            <div>
                <div>
                    <?php 
                    if(isset($_SESSION['status']))
                    {
                        echo "<h4>".$_SESSION['status']."</h4>";
                        unset($_SESSION['status']);
                    }  ?>
                </div>
                <div>
                    <div>
                        <h5>Registration Form</h5>
                    </div>
                    <div>
                        <form action="code.php" method="POST">
                            <div>
                                <label for="name">Name</label>
                                <input type="text" name="name">
                            </div>
                            <div>
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone">
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input type="text" name="email">
                            </div>
                            <div>
                                <label for="password">Password</label>
                                <input type="text" name="password">
                            </div>

                            <div class="form-group">
                                <button name="register_btn" type="submit">Register</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php') ?>