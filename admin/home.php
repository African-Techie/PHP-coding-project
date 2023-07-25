<?php 
    session_start();
    include('../includes/header.php');

    if(!isset($_SESSION['id']) || $_SESSION['status'] != 1) {
        header('location:../index.php');
        exit();
    }
    else if(isset($_SESSION['id'])) {
        include('admin-nav.php');?>

        <div style="display:flex; margin: 20px; padding: 20px">
                <div style="display: block; width: 40%; margin-right: 30px; margin-top: 10vh">
                    <div style="background-color: #eeeeee77; padding: 20px;  border: 1px solid lightgray; border-bottom: none;">
                        <?php 
                        $id = $_SESSION['id'];
                        include_once('../includes/database.php');
                        $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username, first_name, img FROM users WHERE id=$id";
                        $result = mysqli_query($dbconnect, $sql);

                        if(mysqli_num_rows($result) == 1 ){ 
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        } 
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['userimage'] = $row['img'];
                            echo "<img src='../uploads/profile-images/" .$_SESSION['userimage']."' class='profile-img'>";
                        ?>
                        <h3>Welcome <?php echo $_SESSION['name'] ?>!</h3>
                        <h3> Your admin profile number is <?php echo $_SESSION['id'] ?>.</h3>
                        
                    </div>

                    <div style="padding: 20px; border: 1px solid lightgray;" id="play">
                        <?php include('song_upload.php'); ?>
                    </div>

                    <div class="editor" id="editor">
                        <?php include('edit_user.php'); ?>
                    </div>

                </div>

                <div style="display: block; width: 60%; margin-top: 10vh">
                    
                    <div id="search" style="padding: 20px; background-color: #eeeeee77; border: 1px solid lightgray;">
                        <?php include('members.php'); ?>
                    </div>

                    <div style="padding: 20px; border: 1px solid lightgray; margin-top: 20px">
                        <?php include('search.php'); ?>
                    </div>

                </div>
            </div>
    <?php }
    else{
        header('location:../index.php');
        exit();
    }
?>
