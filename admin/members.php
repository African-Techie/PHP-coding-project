<?php
    include('../includes/header.php');
    
    $errors = array();

    if(!isset($_SESSION['id']) || $_SESSION['status'] != 1) {
        header('location:../index.php');
        exit();
    }
    else {
        
        $display = 5;

        if(isset($_GET['p']) && is_numeric($_GET['p'])) {
            $pages = $_GET['p'];
        }
        else {
            $sql = "SELECT COUNT(id) FROM users";
            $result = mysqli_query($dbconnect, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $records = $row[0];        

            ( $records > $display ) ? $pages = ceil($records / $display) : $pages = 1;
        }

        isset($_GET['s']) && is_numeric($_GET['s'])  ?  $start = $_GET['s']  : ( $start = 0 );

        $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'fn';

        // Determining the sorting order
        switch ($sort){
            case 'fn':
                $order_by = 'first_name ASC';
                break;
            case 'ln':
                $order_by = 'second_name ASC';
                break;
            case 'e':
                $order_by = 'email ASC';
                break;    
            case 'regdate':
                $order_by = 'regdate ASC';
                break;
            default:
                $order_by = 'first_name ASC';
                $sort = 'fn';
                break;
        }

        if(isset($_GET['error'])){
            echo "<h3 class='del-msg'>
                <i class='fa fa-exclamation-triangle warning-icon'>
                $_GET[error]
                </i>
            </h3>";
        }

        if(isset($_GET['success'])){
            echo "<h3 class='del-msg del-success'>
                <i class='fa fa-check warning-icon'>
                $_GET[success]
                </i>
            </h3>";
        }

        $sql = "SELECT user_level, id, first_name, second_name, email, img, DATE_FORMAT(date_registered, '%M %d, %Y') AS regdate FROM users ORDER BY $order_by LIMIT $start, $display";
        $result = @mysqli_query($dbconnect, $sql);

        if($result){
            
            echo "<table align='center' cellspacing='0' cellpadding='3' style='width: 100%'>
                <caption style='caption-side:bottom'>
                    
                    <h3 style='margin-top: -10px;'>";
                        if($pages > 1){
                            echo '<br/><p style="float: left">';
            
                            $current_page = ($start / $display) + 1;
            
                            if($current_page != 1){
                                echo '<a href="members.php?s='.($start - $display). '&p='. $pages .'&sort='. $sort .'" class="pag-item-next-prev"> <i class="fa fa-angle-left"></i> </a>';
                            }

                            for($i = 1; $i <= $pages; $i++) {
                                echo ( $i != $current_page ) ? ( '<a href="members.php?s=' .(($display * ($i - 1))).'&p=' .$pages. '&sort='. $sort .'" class="pag-item-inactive">' . $i . '</a>') : ( '<a class="pag-item">'. $i .'</a>' );
                            }
            
                            if($current_page != $pages) {
                                echo '<a href="members.php?s='.($start + $display) .'&p=' .$pages. '&sort='. $sort .'" class="pag-item-next-prev"> <i class="fa fa-angle-right"></i> </a>';
                            }                            
                            echo'</p>';
                        }"
                    </h3>
                </caption>";

                echo"<tr>
                    <td><b>Status</b></td> 
                    <td><b><a href='members.php?sort=fn'>Firstname</a></b></td> 
                    <td><b><a href='members.php?sort=ln'>Lastname</a></b></td> 
                    <td><b>Photo</b></td> 
                    <td><b><a href='members.php?sort=e'>Email</b></td> 
                    <td><b><a href='members.php?sort=regdate'>Reg Date</a></b></td>
                    <td><b>Edit</b></td>
                    <td><b>Del</b></td>
                </tr>";

            $bg = '#eeeeee';
            
            while($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)){

                $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
                                
                $status = $row['user_level'];
            
                $userval = ['Admin', 'User'];

                ( $row['user_level'] ) ? ( $status = $userval[0] ) : ( $status = $userval[1] );

                echo "<tr bgcolor='".$bg."'>
                    <td ><b>".$status."</b></td>
                    <td >".$row['first_name']."</td> 
                    <td >".$row['second_name']."</td> 
                    <td ><img src='../uploads/profile-images/" .$row['img']." ?>' style='width:30px;'></td> 
                    <td >".$row['email']."</td> 
                    <td >".$row['regdate']."</td>
                    <td >
                        <a href='editUser.php?id=".$row['id']."'> <i class='fa fa-edit'></i> </a>
                    </td>
                        
                    <td >";

                        echo ( $row['user_level'] == 1 ) ? ( "" ) : ( "<a href='delUser.php?id=".$row['id']."'> <i class='fa fa-trash-o'></i> </a>" );
                        
                    "</td>
                </tr>";
            }
            echo'</table>';
            mysqli_free_result($result);
        }
    } 
?>
