
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
  <nav class="navbar" id="navbar">
    <div class="navbar-menu" id="navbarMenu" style="display:flex">

    <a class="nav-item" href="index.php" style="margin-top:7px">Home</a>
  
    <?php 
        echo'<a class="nav-item" href="login.php" style="margin-top:7px">Login</a>';

        echo'<a class="nav-item" href="register.php" style="margin-top:7px"> Sign up</a>';
      ?>
      
      <form action="index.php#search" method="get" style="display: flex">
          <input type="text" id="search_query" name="q" placeholder="Search song keywords" class="" style="border: 1px solid grey; padding: 5px 5px; color: white" required>
          <button type="submit" class="search-btn"> <i class='fa fa-search'></i></button>
      </form>
    </div>
  
    <div class="nav-item admin-name">
      <img src="uploads/logos/fyvee - inverse.png" style="width: 40px"> </img>
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

