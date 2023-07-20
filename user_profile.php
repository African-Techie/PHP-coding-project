<?php 
    session_start();
    include('includes/header.php');
    include('includes/database.php');

    if(isset($_SESSION['id'])) {

        $id = $_SESSION['id'];

        $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username, img FROM users WHERE id=$id";
        $result = mysqli_query($dbconnect, $sql);

        if(mysqli_num_rows($result) == 1 ){ 
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } ?>
        <body class="b-styling">
                <div class="cont-2 b-styling">
                    <?php 
                        echo "<img src='uploads/profile-images/" .$row['img']."' class='profile-img'>"; 
                    ?>
                    <h3> Welcome, <?php echo $row['username'] ?>! </h3>
                    <h3> You are logged in as a user </h3>
                    <div class="btn-cont">
                        <?php echo '<a href="userupdate.php?id='.$_SESSION["id"].'" class="anchor-btn"> Update </a>' ?>                                
                        <button class="logout-btn"><a href="logout.php">Logout</a></button>
                    </div>
                </div>
        </body>
    <?php }
    else{
        header('location:login.php');
        exit();
    }
?>