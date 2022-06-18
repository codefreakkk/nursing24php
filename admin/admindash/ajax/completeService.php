<?php
    $nid = $_POST['nid'];
    $bid = $_POST['bid'];
    
    function updateBooking($bid) {
        include "../../../dbcon.php";
        $sql = "UPDATE `bookings` SET `status` = 'completed' WHERE `bid` = '$bid'";
        $result = mysqli_query($con, $sql);
    }
    
    // update bookings
    updateBooking($bid);

    // update nurse table
    include "../../../dbcon.php";
    $sql = "UPDATE `nurses` SET `status` = 'notallocated' WHERE `nid` = '$nid'";
    $result = mysqli_query($con, $sql);
   

?>