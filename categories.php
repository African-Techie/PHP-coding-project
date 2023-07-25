<h3>Search by Song Category</h3>
<form action="user_profile.php" method="POST">
  <div style="display: flex; width: 100%">
    <select name="category" id="category" style="width: 30%; font-size: 15px; border-radius: none">
      <?php
        $categories = ["Unknown", "Afro Beats", "EDM", "Pop", "Reggae", "Bongo Flava", "Gengetone", "Worship", "Ohangla"];
        foreach ($categories as $category) {
        echo "<option value='$category'>$category</option>";
      }
      ?>
    </select>

    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
  </div>
  
</form>

<?php
// Assuming you have a database connection established here

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


// Display songs associated with the selected category if there are any
$selected_category = $_POST["category"]; 

$query = "SELECT * FROM songs WHERE category_id = '$selected_category'";
$result = mysqli_query($dbconnect, $query);

// Check if there are any songs in the selected category
if (mysqli_num_rows($result) > 0) {

  echo "<h3>Songs in the category '$selected_category':</h3>";

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

else {
  // No songs found in the selected category
  echo "<h3>No songs found in the category '$selected_category'.</h3>";
}
}

$dbconnect->close();
?>

