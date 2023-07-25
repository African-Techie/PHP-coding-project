

<?php
include_once("../includes/database.php");
// include("includes/header.php");

$search_result = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve the search query from the form
    $search_query = isset($_GET['q']) ? $_GET['q'] : '';

    // Sanitize the search query before using it in the database query
    $search_query = mysqli_real_escape_string($dbconnect, $search_query);

    // Perform the database search
    $query = "SELECT * FROM users WHERE first_name LIKE '%$search_query%' OR second_name LIKE '%$search_query%' OR email LIKE '%$search_query%' ORDER BY first_name ASC";
    $result = mysqli_query($dbconnect, $query);

    // Display search results
    if(mysqli_num_rows($result) == 0){
        echo "<h2>We found no user related to <i>\"".$search_query."\"</i>.</h2>";
    }

    else if(mysqli_num_rows($result) == 1){
        echo "<h2>Your search <i>\"".$search_query."\"</i> returned 1 result.</h2>";
    }
    else echo "<h2>Your search <i>\"".$search_query."\"</i> returned " . mysqli_num_rows($result) . " results.</h2>";

    if (mysqli_num_rows($result) > 0) {

        echo "<table cellspacing='0' cellpadding='3' style='width: 100%;'>
            <tr>
                <td><b>Name</b></td> 
                <td><b>Email</b></td> 
                <td><b>Photo</b></td> 
                <td><b>Reg Date</b></td>
                <td><b>Edit</b></td>
                <td><b>Del</b></td>
            </tr>";
        $bg = '#eeeeee';

        while ($row = mysqli_fetch_assoc($result)) {

            $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
            
            echo "<tr bgcolor='".$bg."'>
                <td> {$row['first_name']} {$row['second_name']}</td>
                <td> {$row['email']}</td>
                <td> <img src='../uploads/profile-images/" .$row['img']." ?>' style='width:30px;'</td>
                <td> {$row['date_registered']}</td>
                <td> <a href='editUser.php?id=".$row['id']."'> <i class='fa fa-edit'></i> </a></td>
                <td>"; 
                    echo  ($row['user_level'] ) == 1  ?  ""  :  "<a href='delUser.php?id=".$row['id']."'> <i class='fa fa-trash-o'></i> </a>";
                "</td>
            </tr>";
        }
        echo "</table>";
    } 
}
?>
