<?php
    session_start();
    include('../includes/header.php');
    require('../includes/database.php');

    $success = array();
    $errors = array();

    if(!isset($_SESSION['id']) || $_SESSION['status'] != 1){
        header('location:../index.php');
        exit();
    }
    else {
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
        }
        else echo 'Error!';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['sure'] == 'Yes'){
                $id = $_SESSION['id'];
                $sql = "DELETE FROM users WHERE id=$id LIMIT 1";
                $result = mysqli_query($dbconnect, $sql);
                (mysqli_affected_rows($dbconnect) == 1) ? header('location:members.php?success='.$_SESSION['username'].' has been deleted') : header('location:members.php?error=User not deleted');
                    
            }
            else {
                header('location:members.php?error='.$_SESSION['username'].' has NOT been deleted!');
                exit();
            }
        }
        else {
            $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username FROM users WHERE id=$id";
            $result = mysqli_query($dbconnect, $sql);

            if(mysqli_num_rows($result) == 1 ){ 
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $_SESSION['username'] = $row['username'];
                echo "<h3>Confirm deletion of " .$row['username']. ".</h3>";
                echo"<form action='delUser.php' method='post'>
                <div style='display: flex;'>
                    Yes: <input type='radio' name='sure' value='Yes'/>
                    No: <input type='radio' name='sure' value='No' checked='checked'/>
                    <input type='submit' name='submit' value='Submit'/>
                    <input type='hidden' name='id' value='".$id."'/>
                </div>
                </form>";
            }
        }
        mysqli_close($dbconnect);
    }
?>