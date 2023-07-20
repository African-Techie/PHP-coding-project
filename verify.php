<?php
    session_start();
    include('includes/header.php');
    require('includes/database.php');

    $errors = array();

    if(isset($_POST['email']) && isset($_POST['pswd'])){

        // To prevent mysql injection
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        $e = validate($_POST['email']);
        $pass = validate($_POST['pswd']);

        if(!empty($e) && !empty($pass)){
            $sql = "SELECT * FROM users WHERE email='$e'";
            $result = mysqli_query($dbconnect, $sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                $pass = password_verify($pass, $row['password_field']);
                $email = $row['email'] === strtolower($e);

                if($email && $pass){
                    $_SESSION['name'] = $row['first_name']. " ". $row['second_name'];
                    $_SESSION['status'] = $row['user_level'];
                    $_SESSION['image'] = $row['img'];
                    $_SESSION['id'] = $row['id'];

                    $_SESSION['status'] ? header('location:admin/home.php') : header('location:user_profile.php?id='.$_SESSION["id"]);
                }
                else if(!$pass){
                    header('location:login.php?error=Incorrect Details!');
                    exit();
                }
            }
            else{
                header('location:login.php?error=User Not Registered!');
                exit();
            }
        }
        else if(empty($e) && empty($pass)){
            header('location:login.php?error=Empty Fields!');
        }
        else if(empty($e)){
            header('location:login.php?error=Empty Email!');
        }
        else if(empty($pass)){
            header('location:login.php?error=Empty Password!');
        } 
    }
    else {
        header('location:login.php?error=Invalid Login!');
    }

?>
