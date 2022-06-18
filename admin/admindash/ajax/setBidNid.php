<?php

$nid = $_POST['nid'];
$bid = $_POST['bid'];

function setBid($bid, $nid) {
    include "../../../dbcon.php";
    $sql = "UPDATE `bookings` SET `nid` = '$nid' WHERE `bid` = '$bid'";
    $result = mysqli_query($con, $sql);
    if($result) {
        echo 1;
    } else {
        echo 0;
    }
}

function setNid($nid) {
    include "../../../dbcon.php";
    $sql = "UPDATE `nurses` SET `status` = 'allocated' WHERE `nid` = '$nid'";
    $result = mysqli_query($con, $sql);
    if($result) {
        echo 1;
    } else {
        echo 0;
    }
}

    setBid($bid, $nid);
    setNid($nid)

?>