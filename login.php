<?php 
session_start();

if(isset($_SESSION['authenticated'])){
    $_SESSION['status'] = "You are already logged in";
    header('Location: dashboard.php');
    exit(0);
}

$page_title = "Login Page";
include('includes/header.php');
include('includes/navbar.php');
?>



<div class="w-full mt-16">
<?php if(isset($_SESSION['status'])) {
                    ?>
                    <div>
                        <h5 class="text-neutral-400 text-center font-bold"><?= $_SESSION['status']; ?> </h5>
                    </div>
                <?php
                    unset($_SESSION['status']);
                } ?>
    <h1 class="font-extrabold text-center text-slate-100 text-4xl mb-10 mt-4">Login Form</h1>
    <div class="flex justify-center">
        <form class="shadow-md mb-4 w-3/12" action="logincode.php" method="POST">
            <div class="mb-4">
            <label class="block  text-slate-100 text-sm font-bold mb-2" for="email">
                E-mail
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3  text-slate-100 leading-tight focus:outline-none focus:shadow-outline" type="text" name="email" placeholder="E-mail">
            </div>
            <div class="mb-6">
            <label class="block  text-slate-100 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3  text-slate-100 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="text" name="password" placeholder="******************">
            <p class="text-red-500 text-xs italic">Please choose a password.</p>
            </div>
            <div class="flex items-center justify-between">
            <button class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login_now_btn">
                Log In
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-cyan-500 hover:text-cyan-800" href="password-reset.php">
                Forgot Password?
            </a>

            </div>
        </form>
    </div>

    <p class="text-center text-neutral-400 mt-12">Did not recieve your Verification Email? <br>
       <a class="text-cyan-500"href="resend-email-verification.php">Resend</a>
    </p>
</div>







<?php include('includes/footer.php') ?>