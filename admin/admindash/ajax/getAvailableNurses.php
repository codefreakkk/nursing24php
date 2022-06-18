<?php
    include "../../../dbcon.php";

    $sql = "SELECT * FROM `nurses` WHERE `status` = 'notallocated'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {

            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $fullName = $firstName . " " . $lastName;

            echo '<div class="card mb-3">
            <div class="card-body">
            <h5 class="card-title">'.$fullName.'</h5>
            <h5 class="card-title">ID : '.$row['nid'].'</h5>
                        <input type="button" id="allocate_button" data-id="'.$row['nid'].'" class="btn btn-primary" value="Allocate">
                    </div>
                    </div>';
        }
    }

?>