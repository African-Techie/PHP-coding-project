
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
  <nav class="navbar" id="navbar">
    <div class="navbar-menu" id="navbarMenu">
      <a class="nav-item" href="home.php">Home</a>
      <a class="nav-item" href="members.php">Members</a>
      <?php 
        echo'<a class="nav-item" href="#">EditProfile</a>';
      ?>
      <a class="nav-item" href="../logout.php">Logout</a>
  
    </div>

    <div class="admin-name" id="admin-name">
      <img src="../uploads/profile-images/<?php echo $_SESSION['image'] ?>" alt="<?php echo $_SESSION['name'] ?> img" class="navbar-profile-img"> </img>
      <a href="home.php"><?php echo $_SESSION['name'] ?></a>
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

