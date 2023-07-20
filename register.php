<?php
    include('includes/header.php');
    require('includes/database.php');

    $errors = array();
    if($_SERVER['REQUEST_METHOD'] =='POST'){

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        // check firstname, secondname and remove initial whitespaces
        $firstname = validate($_POST['firstname']);
        $lastname  = validate($_POST['lastname']);

        if(!empty($firstname) && !empty($lastname)){
            if(!preg_match("/^[a-zA-Z'.]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)){
                $errors[] = "Name MUST contain only letters.";
            } 
            else {
                $fname = mysqli_real_escape_string($dbconnect, trim(ucfirst(strtolower($firstname))));
                $lname = mysqli_real_escape_string($dbconnect, trim(ucfirst(strtolower($lastname))));
            }
        } 
        else {
            $errors[] = "Please provide your full name!";
        }

        // check email address and trim any initial whitespaces
        $email = validate($_POST['email']);
        if(!empty($_POST['email'])){

            $sql = "SELECT email FROM users WHERE email='$email'";
            $result = mysqli_query($dbconnect, $sql);

            ( mysqli_num_rows($result) > 0 ) ? ( $errors[] = "Email NOT available!" ) : ( $mail = mysqli_real_escape_string($dbconnect, trim(strtolower($email))) );

        } 
        else {
            $errors[] = "Email field is empty!";
        }

        // check if the two passwords match
        $password1 = validate($_POST['password1']);
        $password2 = validate($_POST['password2']);
        if(!empty($password1)){
            if( !empty($password2) ){
                ( $password1 != $password2 ) ? ( $errors[] = "Passwords don't match!" ) : ( $psd = mysqli_real_escape_string($dbconnect, trim($password1)) );
            }
            else {
                $errors[] = "Please confirm your password";
            } 
        } 
        else {
            $errors[] = "Please enter password";
        } 

        // allow user profile image or use default avatar
        if(isset($_FILES['image'])){
            $target = "uploads/images/";
            $target = $target.basename($_FILES['image']['name']);

            $pic = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $tmp = explode('.', $pic);
            $file_ext = strtolower(end($tmp));
            
            $extensions = array("jpeg","jpg","png");
            
            if(!empty(in_array($file_ext, $extensions)) && !in_array($file_ext, $extensions)){
                $errors[] = "Format not allowed!";
            }
            
            if($file_size > 20000000 ) {
                ( $errors[] = 'Image size too large' );
            }

            if(empty($errors) && !empty($pic)){
                move_uploaded_file($file_tmp,"uploads/profile-images/".$pic);
                $ppic = mysqli_real_escape_string($dbconnect, trim($pic));
            }
            else {
                $ppic = "default1.png";
            }
        }

        //  If everything goes well; no errors, no faults:
      
        if(empty($errors)){
            // password hashing (encryption) before storing in db
            $pass = password_hash($psd, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(id, user_level, first_name, second_name, email, password_field, date_registered, img) VALUES('', '', '$fname', '$lname', '$mail', '$pass', NOW(), '$ppic')";
            $result = mysqli_query($dbconnect, $sql);
            if($result){
                header('Location:index.php');
                exit();
            }
        } 
    }
?>

<form action="register.php" method="post" enctype="multipart/form-data" class="form">
    <?php
        if(count($errors) > 1){
            echo "<h4 class='error'><i class='fa fa-exclamation-triangle warning-icon'></i> You have " .count($errors). " errors!</h4>";
        }
        else if(count($errors) == 1){
            echo "<h4 class='error'><i class='fa fa-exclamation-triangle warning-icon'></i> You have 1 error!</h4>";
        }
        foreach($errors as $msg){
            echo "<p class='error-msg'><i class='fa fa-exclamation-circle warning-icon'></i>  $msg<br></p>";
        }
    ?>
    <h3 align=center>Registration Form</h3>

    <div class="first-entries">
        <label class="fa fa-user"></label>
        <input type="text" name="firstname" placeholder="Firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>" class="input-fn">
        <input type="text" name="lastname" placeholder="&   Lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>" class="input-ln">
        </div>
    </div><br>
    <div class="entries">
        <label class="fa fa-envelope"></label>
        <input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
    </div><br>
    <div class="entries">
        <label class="fa fa-key"></label>
        <input type="password" name="password1" placeholder="Password" value="<?php if(isset($_POST['password1'])) echo $_POST['password1'];?>" autocomplete="new-password">
    </div><br>
    <div class="entries">
        <label class="fa fa-key"></label>
        <input type="password" name="password2" placeholder="Repeat Password" value="<?php if(isset($_POST['password2'])) echo $_POST['password2'];?>" autocomplete="new-password">
    </div><br>
    <div class="entries">
        <input type="file" name="image" accept="uploads/images/" style="border: none; font-size: 12px;">
    </div><br>  
    <div class="btn">
        <button type="submit">SIGN UP</button>
    </div>
    <p style="font-size: 12px; text-align:center">Already having an account? <a href="login.php"> Login </a> or go to <a href="index.php"> <i class='fa fa-home'></i> </a> instead.</p>
</form>
