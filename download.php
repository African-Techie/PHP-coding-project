<?php
session_start();
include("includes/users-nav.php");
include_once("includes/database.php");
$errors = array();

if(!isset($_SESSION['id']) || $_SESSION['status'] != 0) {
    header('location:login.php?error=You MUST login to download a Song!');
    exit();

}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['song-id'])) {
    $songid = $_GET['song-id'];

    // Fetch the track details from the database
    $query = "SELECT * FROM songs WHERE song_id = $songid";
    $result = mysqli_query($dbconnect, $query);
    $track = mysqli_fetch_assoc($result);

    if ($track) {

        // Check if the retrieved file path starts with "../"
        if (substr($track['track_path'], 0, 3) === "../") {
            // Remove the two dots by extracting the part of the file path after the first two characters
            $file_path = substr($track['track_path'], 3);
        } 
        
        else {
            // File path doesn't start with "../", store it as is
            $file_path = $track['track_path'];
        }
        
        // Set appropriate headers for the download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Content-Length: ' . filesize($file_path));

        // Read the file and output its contents
        readfile($file_path);
        exit;
    } else {
        // Track not found, display an error message or redirect to an error page
        echo "Track not found.";
    }
} else {
    // Invalid request, track_id not provided or request method is not GET
    echo "Invalid request.";
}
?>
