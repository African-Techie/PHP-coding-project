
<?php
if(!isset($_SESSION['id']) || $_SESSION['status'] != 0) {
    header('location:login.php?error=You MUST login to download a Song!');
    exit();

}
include("includes/header.php");
include_once("includes/database.php");
$errors = array();

$display = 2;

if(isset($_GET['p']) && is_numeric($_GET['p'])) {
    $pages = $_GET['p'];
}
else {
    $sql = "SELECT COUNT(category_id) FROM songs";
    $result = mysqli_query($dbconnect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    $records = $row[0];        

    ( $records > $display ) ? $pages = ceil($records / $display) : $pages = 1;
}

isset($_GET['s']) && is_numeric($_GET['s'])  ?  $start = $_GET['s']  : ( $start = 0 );
$search_result = array();

echo "<div id='searchArea' style='width: 106.5%; background-color:#d3d3d3; height: 10vh; margin-left: -20px; margin-top: -40px;'>
    <h3 align='center'> Your song search Results.</h3>
</div>";       

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Retrieve the search query from the form
    $search_query = isset($_GET['q']) ? $_GET['q'] : '';

    // Sanitize the search query before using it in the database query
    $search_query = mysqli_real_escape_string($dbconnect, $search_query);

    // Perform the database search
    $query = "SELECT * FROM songs WHERE category_id LIKE '%$search_query%' OR track_name LIKE '%$search_query%' OR artist LIKE '%$search_query%' OR track_path LIKE '%$search_query%' ORDER BY category_id ASC";
    $result = mysqli_query($dbconnect, $query);


    // Display search results
    if(mysqli_num_rows($result) == 0){
        echo "<h3 class='search-message'>We found no song related to <i>\"".$search_query."\"</i>.</h3><br>";
    }

    else if(mysqli_num_rows($result) == 1){
        echo "<h3 class='search-message'>Your search <i>\"".$search_query."\"</i> returned 1 track result.</h3>";
        echo "<p>This result could reflect either genre, artist, or track name.</p><br>";
    }
    else {
        echo "<h3 class='search-message'>Your search <i>\"".$search_query."\"</i> returned " . mysqli_num_rows($result) . " track results.</h3>";
        echo "<p>These ". mysqli_num_rows($result) . " results could reflect either genre, artist, or track name.</p><br>";
    }

    

    if (mysqli_num_rows($result) > 0) {

        echo "<table cellspacing='0' cellpadding='3' style='width: 100%; margin-bottom: 30px' align='center'>
            <caption style='caption-side:bottom'>
                    
                <h3 style='margin-top: -10px;'>";
                    if($pages > 1){
                        echo '<br/><p style="float: left">';
        
                        $current_page = ($start / $display) + 1;
        
                        if($current_page != 1){
                            echo '<a href="user_profile.php?s='.($start - $display). '&p='. $pages .'" class="pag-item-next-prev"> <i class="fa fa-angle-left"></i> </a>';
                        }

                        for($i = 1; $i <= $pages; $i++) {
                            echo ( $i != $current_page ) ? ( '<a href="user_profile.php?s=' .(($display * ($i - 1))).'&p=' .$pages. '" class="pag-item-inactive">' . $i . '</a>') : ( '<a class="pag-item">'. $i .'</a>' );
                        }
        
                        if($current_page != $pages) {
                            echo '<a href="user_profile.php?s='.($start + $display) .'&p=' .$pages. '" class="pag-item-next-prev"> <i class="fa fa-angle-right"></i> </a>';
                        }                            
                        echo'</p>';
                    }"
                </h3>
            </caption>";
            echo "<tr>
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
                    <a href='user_profile.php?song=".$row['song_id']."'> <i class='fa fa-play'></i> </a>
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

