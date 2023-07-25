<?php 
    include('includes/header.php');
    include('includes/homenav.php');
?>

<body >

    <span class="landing-page">

        <div style="margin-top: 120px">
            <h1 style="font-family:Verdana, Geneva, Tahoma, sans-serif; color:darkslateblue; ">Welcome to Fyvee Music! <i class="fa fa-music"></i></h1>
            <p>While perfection remains elusive, happiness always resides here!</p> <br>
            <button class="logout-btn"><a href="login.php">Catch the Vibe <i class="fa fa-arrow-right"></i></a></button>
        </div>

        <section id="landing-page-section">

            <article class="phone-displays" id="phone-1">
                <div class="top-hr-sm-phone"><hr  style="border: solid white"></div>
                <div class="landing-graphics"><img src="uploads/logos/music.jpg" alt=""></div>

                <p>Gengetone</p>
                <div class="hr-group">
                    <hr style="border: solid darkgray" class="hr1">
                    <hr style="border: solid darkgray" class="hr2">
                    <hr style="border: solid darkgray" class="hr3">
                </div>
                <hr class="phone-hr">
            </article>

            <article class="phone-displays" id="phone-2">
                <div class="status-bar">
                    <div class="left-sidebar">
                        <div id="status-bar-time">
                            <?php
                                date_default_timezone_set('Africa/Nairobi');
                                echo(new DateTime()) -> format("h:i ").PHP_EOL;
                            ?>
                        <div id="status-bar-battery"><i class="fa fa-battery-half"></i><div>
                    </div>
                    <div class="top-hr"><hr  style="border: solid black"></div>
                    <div class="right-sidebar">
                        <div id="status-bar-wifi"><i class="fa fa-wifi"></i><div>
                        <div id="status-bar-signal"><i class="fa fa-signal"></i><div>
                    </div>
                </div>
                <div class="side-buttons">
                    <div class="power">
                        <hr id="power" style="border-left: 1px solid black">
                    </div>
                        <div>
                            <div id="homeTime">
                                <h3 style="text-align:center; font-size: 25px;" >
                                    <?php
                                        date_default_timezone_set('Africa/Nairobi');
                                        echo(new DateTime()) -> format("h:i a").PHP_EOL;
                                    ?>
                                </h3>
                            </div>
                            <h2 style="text-align:center">
                                <?php
                                    $month = date('m');
                                    $month = substr($month, -2, 2);
                                    //echo(date('l, j F Y'));
                                    echo date('l, j M', strtotime(date('Y-'. $month .'-d')));
                                ?>
                            </h2>
                            <div class="landing-graphics"><img id="phone-2-img" src="uploads/logos/music.jpg" alt=""></div>
                           
                            <p>Electronic Dance</p>
                            <div class="hr-group">
                                <hr style="border: solid darkorange" class="hr1">
                                <hr style="border: solid royalblue" class="hr2">
                                <hr style="border: solid deeppink" class="hr3">
                            </div>
                        </div>

                    <div class="vol-up-down">
                        <hr id="vol-up" style="border-right: 1px solid black">
                        <hr id="vol-down" style="border-right: 1px solid black">
                    </div>
                </div>

                <div class="phone-nav">
                    <div id="back" class="fa fa-angle-left"></div>
                    <div type="button" id="home-2"></div>
                    <div id="recent">&equiv;</div>
                </div>
            </article>

            <article class="phone-displays" id="phone-3">
                <div class="top-hr-sm-phone"><hr  style="border: solid white"></div>
                <div class="landing-graphics"><img src="uploads/logos/music.jpg" alt=""></div>
               
                <p>RnB</p>
                <div class="hr-group">
                    <hr style="border: solid darkgray" class="hr1">
                    <hr style="border: solid darkgray" class="hr2">
                    <hr style="border: solid darkgray" class="hr3">
                </div>
                <hr class="phone-hr">
            </article>

        </section>

        <div class="wave" id="wave"></div>
    </span>

<?php
include("includes/database.php");
// include("includes/header.php");

$search_result = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Retrieve the search query from the form
    $search_query = isset($_GET['q']) ? $_GET['q'] : '';

    // Sanitize the search query before using it in the database query
    $search_query = mysqli_real_escape_string($dbconnect, $search_query);

    // Perform the database search
    $query = "SELECT * FROM songs WHERE category_id LIKE '%$search_query%' OR track_name LIKE '%$search_query%' OR artist LIKE '%$search_query%' OR track_path LIKE '%$search_query%' ORDER BY category_id ASC";
    $result = mysqli_query($dbconnect, $query);

    echo"<h2 id='search'>Song Search Results:</h2>";

    // Display search results
    if(mysqli_num_rows($result) == 0){
        echo "<h2 class='search-message'>We found no song related to <i>\"".$search_query."\"</i>.</h2>";
    }

    else if(mysqli_num_rows($result) == 1){
        echo "<h2 class='search-message'>Your search <i>\"".$search_query."\"</i> returned 1 track result.</h2>";
        echo "<p>This result could reflect either genre, artist, or track name.</p>";
    }
    else {
        echo "<h2 class='search-message'>Your search <i>\"".$search_query."\"</i> returned " . mysqli_num_rows($result) . " track results.</h2>";
        echo "<p><i>These ". mysqli_num_rows($result) . " results could reflect either genre, artist, or track name.</i></p>";
    }

    if (mysqli_num_rows($result) > 0) {

        echo "<table cellspacing='0' cellpadding='3' style='width: 58%; margin-bottom: 30px' align='center'>
            <tr>
                <td><b>Genre</b></td> 
                <td><b>Artist</b></td> 
                <td><b>Song Title</b></td> 
                <td></td>
                <td></td>
            </tr>";
        $bg = '#eeeeee';

        while ($row = mysqli_fetch_assoc($result)) {

            $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
            
            echo "<tr bgcolor='".$bg."'>
                <td> {$row['category_id']}</td>
                <td> {$row['artist']}</td>
                <td> {$row['track_name']}</td>
                <td >
                    <a href='play.php?song=".$row['song_id']."'> <i class='fa fa-play'></i> </a>
                </td>
                <td >
                    <a href='download.php?song-id=".$row['song_id']."'> <i class='fa fa-download'></i> </a>
                </td>
            </tr>";
        }
        echo "</table>";
    } 
}
?>


<?php include('includes/footer.php'); ?>

</body>