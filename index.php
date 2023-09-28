

<?php 
session_start();
$page_title = "Home-Page";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mx-auto">
    <h1 class="text-center text-slate-100 font-extrabold text-8xl mb-6 mt-28">MediaAPP</h1>
    <h2 class="text-center font-bold text-cyan-600 text-4xl mb-4">Best Social Media APP</h2>
    <h3 class="text-center text-slate-100 text-2xl">Become addicted ASAP</h3>

    <div class="flex justify-center mt-8 gap-2">
        <a class="bg-cyan-600 cursor-pointer text-slate-100 text-center text-2xl rounded py-2.5 w-1/6">Join now</a>
        <a class="bg-slate-100 text-center cursor-pointer text-2xl rounded py-2.5 w-1/6">Contact us</a>
    </div>
</div>



<?php include('includes/footer.php') ?>