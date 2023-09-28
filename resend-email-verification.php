<?php 
session_start();
$page_title = "Login Form";
include('includes/header.php');
include('includes/navbar.php')
?>


<div class="w-full mt-16">
    <?php if(isset($_SESSION['status'])) { ?>
    <div>
        <h5 class="text-neutral-400 text-center font-bold"><?= $_SESSION['status']; ?> </h5>
    </div>
    <?php
        unset($_SESSION['status']);
    } ?>
    <h1 class="font-extrabold text-center text-slate-100 text-4xl mb-10 mt-4">Resend Email Verification</h1>
    <div class="flex justify-center">
        <form class="shadow-md mb-4 w-4/12" action="resend-code.php" method="POST">
            <div class="mb-4">
                <label class="block  text-slate-100 text-sm font-bold mb-2" for="email">
                    E-mail
                </label>
                <input class="shadow appearance-none border rounded text-gray-950 w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" type="text" name="email" placeholder="E-mail">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="resend_email_verify_btn">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>