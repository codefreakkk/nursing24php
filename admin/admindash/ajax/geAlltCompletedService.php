<?php
    include "../../../dbcon.php";

    function getUserEmailID($uid) {
        include "../../../dbcon.php";
        $sql = "SELECT * FROM `user` WHERE `uid` = '$uid'";
        $result = mysqli_query($con, $sql);
        if($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['uemail'];
        }
    }


    $sql = "SELECT * FROM `bookings` WHERE `status` = 'completed'";
    $result = mysqli_query($con, $sql);
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
           $nid = $row['nid'];
           $uid = $row['uid'];
           $email = getUserEmailID($uid);
           $contact = $row['contact'];
           $address = $row['address'];
           $booking_time = $row['booking_time'];
           $name = $row['name'];

            echo '<div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Nurse ID : '.$nid.'</h5>
                        <p class="card-text">
                        <div>
                            <span>Name : '.$name.'</span>
                        </div>

                        <div>
                            <span>Email : '.$email.'</span>
                        </div>

                        <div>
                            <span>Contact : '.$contact.'</span>
                        </div>

                        <div>
                            <span>Address : '.substr($address, 0, 20).'</span>
                        </div>

                        <div>
                            <span>Registration Date : '.$booking_time.'</span>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
?>