<?php
  include "../../dbcon.php";
  session_start();
  if($_SESSION['loggedin'] != true && $_SESSION['admin'] != true) {
    header('location: adminlogin.php');
  }
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed " dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">


<!-- Mirrored from demos.themeselection.com/sneat-bootstrap-html-admin-template-free/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Jun 2022 08:47:13 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta name="description"
        content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <script src="../assets/js/config.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>


</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- aside menu       -->
            <?php include "navbar.php";?>
            <!-- aside menu ends      -->

            <div class="layout-page">
                <!-- body here -->

                <h2 style="width:75%; margin-top: 5vh; margin-left:5vh;">Deallocate Nurse</h2>
             
                <div class="row" style="width:100%; margin-top: 3vh; margin-left:3vh;">
                <?php
                    

                    function getUserEmailID($uid) {
                        include "../../dbcon.php";
                        $sql = "SELECT * FROM `user` WHERE `uid` = '$uid'";
                        $result = mysqli_query($con, $sql);
                        if($result) {
                            $row = mysqli_fetch_assoc($result);
                            return $row['uemail'];
                        }
                    }

                        $sql = "SELECT * FROM `bookings` WHERE `status` = 'notcompleted' AND `nid` != 'notallocated'";
                        $result = mysqli_query($con, $sql);

                        if($result) {
                            $num = mysqli_num_rows($result);
                            if($num == 0) {
                                echo '<p>No record to show </p>';
                            }
                            while($row = mysqli_fetch_assoc($result)) {
                                $uid = $row['uid'];
                                $email = getUserEmailID($uid);
                                echo '<div class="card mb-3" style="width:75%; margin-top: 3vh; margin-left:3vh;">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><b>Name</b> : '.$row['name'].'</h5>
                                            <p class="card-text">
                                            <div>
                                                <span>Contact : '.$row['contact'].'</span>
                                            </div>
                    
                                            <div>
                                                <span>Email : '.$email.'</span>
                                            </div>
                    
                                            <div>
                                                <span>Address : '.substr($row['address'], 0, 20).'</span>
                                            </div>

                                            <div>
                                            <span>City : '.$row['city'].'</span>
                                        </div>
                                            
                                            <div>
                                                <span>Package Name : <b style="color: black;"> '.$row['package_name'].'</b></span>
                                            </div>
                                            
                                            <div>
                                                <span>Booking Time : '.$row['booking_time'].'</span>
                                            </div>
                                            
                                            <div>
                                                <span><b>Status</b> :<b style="color: red"> '.$row['status'].'</b></span>
                                            </div>
                                            </p>
                                            <div class="mt-2">
                                            <button type="button" id="allocateNurse" class="btn btn-primary" data-nid="'.$row['nid'].'" data-bid="'.$row['bid'].'">Deallocate Nurse</button>
                                        </div>
                                            </div>
                                    </div>
                                </div>
                            </div>';
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            $(document).on("click", "#allocateNurse", function() {
                let nid = $(this).attr("data-nid");
                let bid = $(this).attr("data-bid");
                $.ajax({
                    url: "ajax/completeService.php",
                    type: "POST",
                    data: {
                        nid: nid,
                        bid: bid
                    },
                    success: function(data) {
                        location.reload();
                        // alert(data);
                    }
                })
            })
        })
    </script>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="../../../buttons.github.io/buttons.js"></script>

</body>

</html>