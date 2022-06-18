<?php
    include "../../../dbcon.php";
    $sql = "SELECT * FROM `nurses`";
    $result = mysqli_query($con, $sql);
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $email = $row['email'];
            $phone_number = $row['phone_number'];
            $address = $row['address'];
            $state = $row['state'];
            $zipcode = $row['zipcode'];
            $fullName = $firstName . " " . $lastName;
            $status = $row['status'];
            echo '<div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Nurse ID : '.$row['nid'].'</h5>
                        <p class="card-text">
                        <div>
                            <span>Name : '.$fullName.'</span>
                        </div>

                        <div>
                            <span>Email : '.$email.'</span>
                        </div>

                        <div>
                            <span>Contact : '.$phone_number.'</span>
                        </div>

                        <div>
                            <span>Address : '.substr($address, 0, 20).'</span>
                        </div>
                        
                        <div>
                            <span>State : '.$state.'</span>
                        </div>
                        <div>
                            <span>Zipcode : '.$zipcode.'</span>
                        </div>
                        
                        <div>
                        <span><b>Status </b>: <b>'.$status.'</b></span>
                    </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
?>