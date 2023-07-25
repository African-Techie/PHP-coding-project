
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Coding Project</title>

  <link rel="stylesheet" href="admin/css/navbar.css">
</head>

<body style="display:block">
  <nav class="navbar" id="navbar" style="position: fixed; z-index: 7; margin-top: -22px">
    <div class="navbar-menu" id="navbarMenu" style="display:flex">
    <?php 
        echo'<a class="nav-item" href="user_profile.php?id='.$_SESSION["id"].'" style="margin-top:7px">Home</a>';

        echo'<a class="nav-item" href="#" style="margin-top:7px" id="editorToggle"> Edit Profile </a>';
      ?>

      <a class="nav-item" href="logout.php" style="margin-top:7px">Logout</a>

      <form action="user_profile.php" method="get" style="display: flex">
          <input type="text" id="search_query" name="q" placeholder="Search song keywords" class="" style="border: 1px solid grey; padding: 5px 5px; color: white" required>
          <button type="submit" class="search-btn"> <i class='fa fa-search'></i></button>
      </form>
    </div>
    <?php

    include_once("database.php");

    if(isset($_SESSION['id'])) {

      $id = $_SESSION['id'];

      $sql = "SELECT CONCAT(first_name, ' ', second_name) AS username, img FROM users WHERE id=$id";
      $result = mysqli_query($dbconnect, $sql);

      if(mysqli_num_rows($result) == 1 ){ 
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      }
    } 
    ?>
    <div class="nav-item admin-name">
      <img src="uploads/profile-images/<?php echo $row['img'] ?>" alt="<?php echo $row['username'] ?> img" class="navbar-profile-img"> </img>
      <a href="#"><?php echo $row['username'] ?></a>
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

