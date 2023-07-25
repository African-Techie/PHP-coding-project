<?php    
    $success = array();

    if(!isset($_SESSION['id']) || $_SESSION['status'] != 1) {
        header('location:../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Music Upload</title>
</head>
<body>
    <h2>Upload Your Music</h2>
    <?php
        foreach($success as $msg){
            echo "<p class='error-msg user-update-errors'><i class='fa fa-check warning-icon'></i>  $msg<br></p>";
        }
    ?>
    <form action="home.php" method="post" enctype="multipart/form-data">
        <label for="track_name">Track Name:</label>
        <input type="text" id="track_name" name="track_name" required><br>

        <label for="category">Genre:</label>
        <select id="category" name="category" required>
            <?php 
                $categories = array();
                $categories = ["Unknown", "Afro Beats", "EDM", "Pop", "Reggae", "Bongo Flava", "Gengetone", "Worship", "Ohangla"];
                foreach ($categories as $category): ?>
                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
            <?php endforeach; ?>
        </select><br>

        <div style="display: flex; width: 100% ">
            <label for="artist" style="margin-right: 20px">artist:</label>
            <input type="text" id="artist" name="artist" style="margin-left: 20px"><br>
        </div>
        <div style="display: flex; width: 100%; justify-content: space-between">
            <label for="music_file">Music File:</label>
            <input type="file" id="music_file" name="music_file" accept=".mp3" required><br>
        </div>
        <input type="submit" value="Upload">
    </form>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $track_name = $_POST['track_name'];
    $category_id = $_POST['category'];
    $artist = $_POST['artist'];

    // Handle file upload
    $target_dir = "../uploads/songs/"; // Directory where uploaded files will be saved
    $target_file = $target_dir . basename($_FILES['music_file']['name']);
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = array("mp3"); // Only allow MP3 files for simplicity

    if (in_array($file_extension, $allowed_extensions)) {
        if (move_uploaded_file($_FILES['music_file']['tmp_name'], $target_file)) {
            // File upload success, save the track information in the database
            $track_path = $target_file; // Save the file path in the database

            // Sanitize user input before inserting into the database
            $category_id = mysqli_real_escape_string($dbconnect, $category_id);
            $track_name = mysqli_real_escape_string($dbconnect, $track_name);
            $artist = mysqli_real_escape_string($dbconnect, $artist);
            $track_path = mysqli_real_escape_string($dbconnect, $track_path);

            // Insert track information into the database
            $query = "INSERT INTO songs (song_id, category_id, track_name, artist, track_path) VALUES ('', '$category_id', '$track_name', '$artist', '$track_path')";
            mysqli_query($dbconnect, $query);

            // Redirect the user to a success page or display a success message
            header("Location:home.php?success=song uploaded successfully");
            exit;
        } else {
            // File upload failed
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // Invalid file type
        echo "Invalid file type. Only MP3 files are allowed.";
    }
}
?>
