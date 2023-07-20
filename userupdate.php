<?php
    session_start();
    include('includes/header.php');
    require('includes/database.php');
    
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
        header('location:user_profile.php?id='.$id);
    }
?>

<form action="userupdate.php" method = "post" enctype = "multipart/form-data">

    <?php
        foreach($errors as $msg){
            echo "<p class='error error-msg login-error'><i class='fa fa-exclamation-circle warning-icon'></i>  $msg<br></p>";
        }
    ?>

<table cellspacing='0' cellpadding='7' border='1px solid #d3d3d3' border-collapse='collapse' style='width:30%; height:10px; border:1px solid #d3d3d3'>

    <?php
        $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username FROM users WHERE id=$id";
        $result = mysqli_query($dbconnect, $sql);

        if(mysqli_num_rows($result) == 1 ){ 
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo "<tr><td colspan='2'><h3>Change any of your credentials</h3></td></tr>";
            echo"<tr><td colspan='2'><div><h5 align=center><div><h5 align=center>You are interacting as <a href='user_profile.php?id=$id'>". $row['username']."</a></h5></div></td></tr>";
        } 
    ?>
    
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
        <td>Image</td>
        <td><input type="file" name="image"></td>
    </tr>
        
    </table>
    <br>
    <div>Enter current password:</div><br>
    <input type="password" name="pswd" value="<?php if (isset($_POST['pswd'])) echo $_POST['pswd']; ?>" style="border: 1px solid;"><br><br>
    <button type="submit" style="margin-left:20px; padding: 7px 25px; font-size: 15px;">SUBMIT</button>
    <input type="hidden" value="<?php echo $id ?>">
</form>
