
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Coding Project</title>

  <link rel="stylesheet" href="css/navbar.css">
</head>

<body style="display:block">
  <nav class="navbar" id="navbar" style="position: fixed; margin-top: -22px;">
    <div class="navbar-menu" id="navbarMenu">
    <?php 
        echo'<a class="nav-item" href="home.php?id='.$_SESSION["id"].'">Home</a>';
        echo'<a class="nav-item" href="members.php">Members</a>';

        echo'<a class="nav-item" href="#"> Edit Profile </a>';
      ?>
      <a class="nav-item" href="../logout.php">Logout</a>
    </div>
    <?php

    if($_SESSION['status'] == 1) {

      include_once('../includes/database.php');

      // $id = $_SESSION['id'];

      // $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username, img FROM users WHERE id=$id";
      // $result = mysqli_query($dbconnect, $sql);

      // if(mysqli_num_rows($result) == 1 ){ 
      //     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // }
    } 
    ?>
    <div class="nav-item admin-name">
      <img src="../uploads/profile-images/<?php echo $_SESSION['image'] ?>" class="navbar-profile-img"> </img>
      <a href="#"><?php echo $_SESSION['name'] ?></a>
    </div>
    <button class="navbar-toggle" id="navbarToggle">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </nav>

  <script>
        const navbarToggle = document.getElementById('navbarToggle');
        const navbarMenu = document.getElementById('navbarMenu');

        navbarToggle.addEventListener('click', () => {
          navbarMenu.classList.toggle('show-menu');

          document.getElementById('navbar').style.height = "30vh";
          document.getElementById('admin-name').style.marginTop = "-120px";
        });

      

    </script>
</body>

</html>

