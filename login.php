<?php
  include('includes/header.php');
?>


<form action="verify.php" method="post" id="div-height" class="form">
    <?php
        if(isset($_GET['error'])){
            echo "<h3 class='error login-error'>
              <i class='fa fa-exclamation-triangle warning-icon'>
                $_GET[error]
              </i>
            </h3>";
        }

        if(isset($_GET['success'])){
            echo "<h3 class='success'>
              <i class='fa fa-check warning-icon'>
                $_GET[success]
              </i>
            </h3>";
        }
    ?>
    <h3 align=center>Login Form</h3>
    <div class="entries top-entry"> <input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"> <label for="email" <i class="fa fa-envelope"></label></div><br>
    <div class="entries"> <input type="password" name="pswd" placeholder="Password" value="<?php if(isset($_POST['pswd'])) echo $_POST['pswd']; ?>" autocomplete="new-password"> <label for="password" <i class="fa fa-key"></label></div><br>
    <div class="btn login-btn"> <button type="submit">SIGN IN</button></div></P>
    <p style="font-size: 12px; text-align:center">Not yet registered? <a href="register.php"> Register </a> or go to <a href="index.php"> <i class='fa fa-home'></i> </a> instead.</p>
</form>