<?php
    session_start();
    include('../includes/header.php');
    require('../includes/database.php');
    
    if(isset($_SESSION['id']) && $_SESSION['status'] == 1){

        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
        }
        else {

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $id = $_SESSION['id'];

                // check firstname and remove initial whitespaces
                $firstname = $_POST['fname'];
                if(!empty($firstname)){
                    if(!preg_match("/^[a-zA-Z'.]*$/", $firstname)){
                        header('Location:members.php?error=Use ONLY letters for name');

                    } 
                    else {
                        $fname = mysqli_real_escape_string($dbconnect, trim(ucfirst(strtolower($firstname))));
                        $update ="UPDATE users SET first_name = '$fname' WHERE id = '$id'";
                        $rslt = mysqli_query($dbconnect, $update);
                        $rslt ? header('Location:members.php?success=Account updated successfully') :header('Location:members.php?error=Error updating firstname');
                    }
                } 
                // check second name and remove any initial whitespaces
                $lastname = $_POST['lname'];
                if(!empty($lastname)){
                    if(!preg_match("/^[a-zA-Z]*$/", $lastname)){
                        header('Location:members.php?error=Use ONLY letters for name');
                    } 
                    else {
                        $lname = mysqli_real_escape_string($dbconnect, trim(ucfirst(strtolower($lastname))));
                        $update ="UPDATE users SET second_name = '$lname' WHERE id = '$id'";
                        $rslt = mysqli_query($dbconnect, $update);
                        $rslt ? header('Location:members.php?success=Account updated successfully') :header('Location:members.php?error=Error updating lastname');
                    }
                } 
                // check email address and trim any initial whitespaces
                $email = $_POST['email'];
                if(!empty($_POST['email'])){

                    $sql = "SELECT email FROM users WHERE email = '$email'";
                    $result = mysqli_query($dbconnect, $sql);
                    if(mysqli_num_rows($result) > 0){
                        header('Location:members.php?error=Email already in use');
                    }
                    else {
                        $mail = mysqli_real_escape_string($dbconnect, trim(strtolower($email)));
                        $update ="UPDATE users SET email = '$mail' WHERE id = '$id'";
                        $rslt = mysqli_query($dbconnect, $update);
                        $rslt ? header('Location:members.php?success=Account updated successfully') :header('Location:members.php?error=Error updating email');
                    }

                }
                // image
                if(isset($_FILES['image'])){
                    $target = "../uploads/profile-images/";
                    $target = $target.basename($_FILES['image']['name']);

                    $pic = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_type = $_FILES['image']['type'];
                    $tmp = explode('.', $pic);
                    $file_ext = strtolower(end($tmp));
                    
                    $extensions = array("jpeg","jpg","png");
                    
                    if(!empty(in_array($file_ext,$extensions)) && !in_array($file_ext,$extensions)){
                        header('Location:members.php?error=File type not allowed');
                    }

                    if($file_size > 20000000){
                        header('Location:members.php?error=Image size too large');
                    }

                    if(empty($errors) && !empty($pic)){
                    move_uploaded_file($file_tmp, "../uploads/profile-images/".$pic);
                    $ppic = mysqli_real_escape_string($dbconnect, trim($pic));
                    $update = "UPDATE users SET img = '$ppic' WHERE id = '$id'";
                        $rslt = mysqli_query($dbconnect, $update);
                        $rslt ? header('Location:members.php?success=Account updated successfully') :header('Location:members.php?error=Error updating profile image');
                    }
                }        
            } 
            else {
                header('Location:members.php');
            }
        } 
    }
    else{
        header('location:members.php');
    }
?>

<form action="edituser.php" method = "post" enctype = "multipart/form-data">

    <table align='center' cellspacing='0' cellpadding='7' border='1px solid #d3d3d3' border-collapse='collapse' style='width:100%; height:10px; border:1px solid #d3d3d3'>
        <?php
            $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username FROM users WHERE id=$id";
            $result = mysqli_query($dbconnect, $sql);

            if(mysqli_num_rows($result) == 1 ){ 
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo "<tr><td colspan='2'><div><h5 align=center>Updating details of <a href='members.php'>". $row['username']."</a></h5></div></td></tr>";
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

    <input type="hidden" name="id" value="<?php echo $id ?>">

    <button type="submit" style="margin-left:20px; padding: 7px 25px; font-size: 15px;">UPDATE</button>
</form>