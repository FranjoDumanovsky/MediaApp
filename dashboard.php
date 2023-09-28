<?php 

session_start();
include('authentication.php');

$page_title = "Dashboard";
include('includes/header.php');
include('includes/navbar.php')

?>


<div class="container mx-auto mt-12">
<?php 
if(isset($_SESSION['status'])) {
                    ?>
                    <div>
                        <h5 class="text-neutral-400  font-bold"><?= $_SESSION['status']; ?> </h5>
                    </div>
    <?php
        unset($_SESSION['status']);
    } ?>
    
    <h2 class=" font-bold text-cyan-600 text-4xl mb-4">Dashboard</h2>

    <img src="" alt="">
    <img src="uploads/_<?=$_SESSION['auth_user']['name'];?>.png" class="mb-4 w-32 h-32 object-cover rounded-full" alt="">
    <h5 class="text-4xl text-white mb-4">Name: <?= $_SESSION['auth_user']['name'];?></h5>
    <h5 class="text-4xl text-white mb-4">Email: <?= $_SESSION['auth_user']['email'];?></h5>
    <h5 class="text-4xl text-white mb-4">Phone: <?= $_SESSION['auth_user']['phone'];?></h5>



    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

</div>
