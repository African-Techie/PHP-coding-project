<?php 
    session_start();
    include('includes/header.php');
    include('includes/database.php');
    include('includes/users-nav.php');

    if(isset($_SESSION['id'])) {

        $id = $_SESSION['id'];

        $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username, first_name, img FROM users WHERE id=$id";
        $result = mysqli_query($dbconnect, $sql);

        if(mysqli_num_rows($result) == 1 ){ 
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } ?>
        <body>
            <div style="display:flex; margin: 20px; padding: 20px">
                <div style="display: block; width: 40%; margin-right: 30px; margin-top: 10vh">
                    <div style="background-color: #eeeeee77; padding: 20px;  border: 1px solid lightgray; border-bottom: none;">
                        <?php 
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['userimage'] = $row['img'];
                            echo "<img src='uploads/profile-images/" .$_SESSION['userimage']."' class='profile-img'>";
                        ?>
                        <h3> Welcome back, <?php echo $row['first_name'] ?>! </h3>
                        <h3> Your user profile number is <?php echo $_SESSION['id'] ?>.</h3>
                        
                    </div>

                    <div style="padding: 20px; border: 1px solid lightgray;" id="play">
                        <?php include('play.php'); ?>
                    </div>

                    <div class="editor" id="editor">
                        <?php include('userupdate.php'); ?>
                    </div>

                </div>

                <div style="display: block; width: 60%; margin-top: 10vh">
                    
                    <div id="search" style="padding: 20px; background-color: #eeeeee77; border: 1px solid lightgray;">
                        <?php include('includes/user_sidebar.php'); ?>
                    </div>

                    <div style="padding: 20px; border: 1px solid lightgray; margin-top: 20px">
                        <?php include('categories.php'); ?>
                    </div>

                </div>
            </div>  
            
            <script>
                const editorToggle = document.getElementById('editorToggle');
                const editor = document.getElementById('editor');

                editorToggle.addEventListener('click', () => {
                editor.classList.toggle('show-editor');

                document.getElementById('editor').style.marginTop = "20px";
                document.getElementById('editor').style.display = "block";
                });

            </script>
        </body>
    <?php }
    else{
        header('location:login.php');
        exit();
    }

    include('includes/footer.php');
?>