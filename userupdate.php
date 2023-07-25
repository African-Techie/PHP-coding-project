<?php
    include('includes/header.php');
    require_once('includes/database.php');
    
    $errors = array();

    if(isset($_SESSION['id']) && $_SESSION['status'] == 0){

        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
        }
        else {

            $id = $_SESSION['id'];
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $pswd = $_POST['pswd'];

                if(!empty($pswd)){
                    $sql = "SELECT password_field AS pswd FROM users WHERE id = $id";
                    $result = mysqli_query($dbconnect, $sql);
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_assoc($result);
                        $password = password_verify($pswd, $row['pswd']);
                        if($password){
                            // check firstname and remove initial whitespaces
                            $firstname = $_POST['fname'];
                            if(!empty($firstname)){
                                if(!preg_match("/^[a-zA-Z'.]*$/", $firstname)){
                                    $errors[] = "Firstname MUST contain only letters.";
                                } 
                                else {
                                    $fname = mysqli_real_escape_string($dbconnect, trim(ucfirst(strtolower($firstname))));
                                    $update ="UPDATE users SET first_name = '$fname' WHERE id = '$id'";
                                    $rslt = mysqli_query($dbconnect, $update);
                                    $rslt ? header('Location:user_profile.php?id='.$id) : $errors[] = "Error updating firstname! Please retry";
                                }
                            } 
                            // check second name and remove any initial whitespaces
                            $lastname = $_POST['lname'];
                            if(!empty($lastname)){
                                if(!preg_match("/^[a-zA-Z]*$/", $lastname)){
                                    $errors[] = "Lastname MUST contain only letters.";
                                } 
                                else {
                                    $lname = mysqli_real_escape_string($dbconnect, trim(ucfirst(strtolower($lastname))));
                                    $update ="UPDATE users SET second_name = '$lname' WHERE id = '$id'";
                                    $rslt = mysqli_query($dbconnect, $update);
                                    $rslt ? header('Location:user_profile.php?id='.$id) : $errors[] = "Error updating lastname! Please retry";
                                }
                            } 
                            // check email address and trim any initial whitespaces
                            $email = $_POST['email'];
                            if(!empty($_POST['email'])){

                                $sql = "SELECT email FROM users WHERE email = '$email'";
                                $result = mysqli_query($dbconnect, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    $errors[] = "Email already taken!";
                                }
                                else {
                                    $mail = mysqli_real_escape_string($dbconnect, trim(strtolower($email)));
                                    $update ="UPDATE users SET email = '$mail' WHERE id = '$id'";
                                    $rslt = mysqli_query($dbconnect, $update);
                                    $rslt ? header('Location:user_profile.php?id='.$id) : $errors[] = "Error updating Email! Please retry";
                                }

                            }

                             // check password
                            $pass = $_POST['password'];
                            if(!empty($pass)){
                                
                                $psd = password_hash($pass, PASSWORD_DEFAULT);
                                $update ="UPDATE users SET password_field = '$psd' WHERE id = '$id'";
                                $rslt = mysqli_query($dbconnect, $update);
                                $rslt ? header('Location:user_profile.php?success=Account updated successfully') :header('Location:members.php?error=Error updating password');
                            } 

                            // image
                            if(isset($_FILES['image'])){
                                $target = "uploads/profile-images/";
                                $target = $target.basename($_FILES['image']['name']);

                                $pic = $_FILES['image']['name'];
                                $file_size = $_FILES['image']['size'];
                                $file_tmp = $_FILES['image']['tmp_name'];
                                $file_type = $_FILES['image']['type'];
                                $tmp = explode('.', $pic);
                                $file_ext = strtolower(end($tmp));
                                
                                $extensions = array("jpeg","jpg","png");
                                
                                if(!empty(in_array($file_ext,$extensions)) && !in_array($file_ext,$extensions)){
                                $errors[] = "Format not allowed!";
                                }

                                if($file_size > 20000000){
                                $errors[] = 'Imagesize too large';
                                }

                                if(empty($errors) && !empty($pic)){
                                move_uploaded_file($file_tmp, "uploads/profile-images/".$pic);
                                $ppic = mysqli_real_escape_string($dbconnect, trim($pic));
                                $update = "UPDATE users SET img = '$ppic' WHERE id = '$id'";
                                    $rslt = mysqli_query($dbconnect, $update);
                                    $rslt ? header('Location:user_profile.php?id='.$id) : $errors[] = "Error updating picture! Please retry";
                                }
                            } 
                        }
                        else {
                            $errors[] = "Incorrect password!";
                        }
                    }
                }
                else{
                    $errors[] = "You MUST enter your password to continue!";
                }
            }
        } 
    }
    else {
        header('location:user_profile.php');
    }
?>

<form action="user_update.php#" method = "post" enctype = "multipart/form-data">

    <?php
        foreach($errors as $msg){
            echo "<p class='error-msg user-update-errors'><i class='fa fa-exclamation-circle warning-icon'></i>  $msg<br></p>";
        }
    ?>

<table cellspacing='0' cellpadding='7' border='1px solid #d3d3d3' border-collapse='collapse' style='width:100%; height:10px; border:1px solid #d3d3d3' id="editorClose">

    <tr>
        <td style="border-right: none"><h3>Change any of these</h3></td>
        <td align="right" width="10%" style="border-left:none"><button id="closeToggle"> <i class="fa fa-close"></i> </button></td>
    </tr>
    
    <tr>
        <td>Firstname</td>
        <td><input type="text"  name="fname" value="<?php if (isset($_POST['email'])) echo $_POST['fname']; ?>"></td>
    </tr>
    <tr>
        <td>Secondname</td>
        <td><input type="text"  name="lname" value="<?php if (isset($_POST['email'])) echo $_POST['lname']; ?>"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"></td>
    </tr>
    <tr>
        <td>Image</td>
        <td><input type="file" name="image"></td>
    </tr>
        
    </table>
    <br>
    Enter current password to save changes:<br>
    <div class="entry">
        <input type="password" name="pswd" value="<?php if (isset($_POST['pswd'])) echo $_POST['pswd']; ?>" style="border: 1px solid;">
        <button type="submit">SUBMIT</button>
    </div>

    <hr style="width:100%; margin-top: 80px;">
    <input type="hidden" value="<?php echo $id ?>">
</form>

<script>
    const closeToggle = document.getElementById('closeToggle');
    const closeEditor = document.getElementById('editor');

    closeToggle.addEventListener('click', () => {
    closeEditor.classList.toggle('close-editor');

    });

</script>