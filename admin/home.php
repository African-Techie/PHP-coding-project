<?php 
    session_start();
    include('../includes/header.php');

    if(!isset($_SESSION['id']) || $_SESSION['status'] != 1) {
        header('location:../index.php');
        exit();
    }
    else if(isset($_SESSION['id'])) {
        include('admin-nav.php');?>

        <div><h1>Welcome <?php echo $_SESSION['name'] ?>!</h1></div>
    <?php }
    else{
        header('location:../index.php');
        exit();
    }
?>
