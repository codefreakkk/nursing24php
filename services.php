<?php
    include "navbar.php";
    
    function getPackageName($pid) {
        include "dbcon.php";
        $sql = "SELECT * FROM `packages` WHERE `pid` = '$pid'";
        $result = mysqli_query($con, $sql);
        if($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['package_name'];
        }
    }

    function getCurrentBooking($uid) {
        include "dbcon.php";
        $sql = "SELECT * FROM `bookings` WHERE `uid` = '$uid' AND `status` = 'notcompleted'";
        $result = mysqli_query($con, $sql);
        if($result) {
            $num = mysqli_num_rows($result);
            if($num > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    include "dbcon.php";
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        if($_SESSION['loggedin'] != true) {
            header("location: login.php");
            die();
        }

        $getBooking = getCurrentBooking($_SESSION['uid']);
        
        if($getBooking == true) {
            header("location: services.php?q=1");
            die();
        }

        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $package = $_POST['package'];
        
        if($city == "none" || $package == "none" || empty($name) || empty($contact) || empty($address)) {
            header('location: services.php?q=1');
        } else {
            $uid = $_SESSION['uid'];
            $package_name = getPackageName($package);
            $sql = "INSERT INTO `bookings` (`uid`, `pid`, `package_name`, `booking_time`, `contact`, `name`, `address`, `city`) VALUES ('$uid', '$package', '$package_name', current_timestamp(), '$contact', '$name' ,'$address', '$city')";
            $result = mysqli_query($con, $sql);
            if($result) {
                header("location: user/userdash/dashboard.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <section class="home-slider owl-carousel">
        <div class="slider-item bread-item" style="background-image: url('images/bg_1.jpg');"
            data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container" data-scrollax-parent="true">
                <div class="row slider-text align-items-end">
                    <div class="col-md-7 col-sm-12 ftco-animate mb-5">
                        <p class="breadcrumbs" data-scrollax=" properties: { translateY: '70%', opacity: 1.6}"><span
                                class="mr-2"><a href="index.html">Home</a></span> <span>Services</span></p>
                        <h1 class="mb-3" data-scrollax=" properties: { translateY: '70%', opacity: .9}">Our Service
                            Keeps you Smile</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-2">Our Service Keeps you Smile</h2>
                    <p>Choose Below Packages</p>
                </div>
            </div>

            <?php
          
          if(isset($_GET['q']) == "1") {
            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Alert</strong> Package not book please book again 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          }
         ?>

            <div class="container">
                <form action="services.php" method="post">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                            placeholder="Name">
                    </div>


                    <div class="mb-3">
                        <input type="text" name="contact" class="form-control" id="exampleFormControlInput1"
                            placeholder="Contact Number">
                    </div>

                    <div class="mb-4">
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1"
                            placeholder="Address" rows="3"></textarea>
                    </div>

                    <select class="form-select mb-3 mt-3" name="city" aria-label="Default select example">
                        <option selected value="none">City</option>
                        <option value="Mumbai">Mumbai</option>
                        <option value="Pune">Pune</option>
                        <option value="Nashik">Nashik</option>
                    </select>

                    <select class="form-select" name="package" aria-label="Default select example">
                    <option selected value="none">Select Package</option>
                        <?php
                            include "dbcon.php";
                            $sql = "SELECT * FROM `packages`";
                            $result = mysqli_query($con, $sql);
                            if($result) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $package_name = $row['package_name'];
                                    $pid = $row['pid'];
                                    echo '
                                        <option value="'.$pid.'">'.$package_name.'</option>
                                    ';
                                }
                            }
                        ?>
                        
                    </select>
               
            </div>

            <div>
                <button type="submit" style="border-radius: 3px; margin-left:12px;" class="btn btn-primary mt-4">BOOK
                    NOW</button>
            </div>
            </form>
        </div>

    </section>

    <?php include "footer.php";?>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>

    <!-- Modal -->
    <div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRequestLabel">Make an Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
                            <input type="text" class="form-control" id="appointment_name" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <!-- <label for="appointment_email" class="text-black">Email</label> -->
                            <input type="text" class="form-control" id="appointment_email" placeholder="Email">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- <label for="appointment_date" class="text-black">Date</label> -->
                                    <input type="text" class="form-control appointment_date" placeholder="Date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- <label for="appointment_time" class="text-black">Time</label> -->
                                    <input type="text" class="form-control appointment_time" placeholder="Time">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <!-- <label for="appointment_message" class="text-black">Message</label> -->
                            <textarea name="" id="appointment_message" class="form-control" cols="30" rows="10"
                                placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Make an Appointment" class="btn btn-primary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

</body>

</html>

<!-- 

ha hath pakadle ab bhi tera ho sakta hun mein 
bheed bohot hai iss mele me haan kho sakta hun mein 
PICHE CHUTE SATHI MUJKO YAAD ATE HAI VARNA
iss daud me sabse age ho sakta hun mein
AUR EK MASUM SA BACHHA MUJME ABTAK JINDA HAI CHOTI CHOTI BAATON PAR BHI ROO SAKTA HUN MEIN

 -->