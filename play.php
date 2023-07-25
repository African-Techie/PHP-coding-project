
<?php

    if(!isset($_SESSION['id']) || $_SESSION['status'] != 0) {
        header('location:login.php?error=You MUST login to stream music!');
        exit();

    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['song'])) {
        $songid = $_GET['song'];

        // Fetch the track details from the database
        include_once("includes/database.php");
        $query = "SELECT * FROM songs WHERE song_id = $songid";
        $result = mysqli_query($dbconnect, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $song_id = $row['song_id'];
                $category = $row['category_id'];
                $title = $row['track_name'];
                $artist = $row['artist'];
                if (substr($row['track_path'], 0, 3) === "../") {
                    // Remove the two dots by extracting the part of the file path after the first two characters
                    $file_path = substr($row['track_path'], 3);
                } 
                
                else {
                    // File path doesn't start with "../", store it as is
                    $file_path = $row['track_path'];
                }

                $_SESSION['song_id'] = $song_id;
                echo "<h2>Now Playing</h2>";

                echo "<b>Title:</b> $title <br>";
                echo "<b>Artist:</b> $artist <br>";
                echo "<b>Category:</b> $category <br>";
                echo "<audio id='audio$song_id' controls>";
                echo "<source src='$file_path' type='audio/mpeg'>";
                echo "</audio>";
            }
        } 
        else {
            echo "No songs found in the database.";
        }
    }

?>
