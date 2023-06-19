<?php
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="M_Adnan"/>
    <!-- Document Title -->
    <title>Dao District Hospital Mangement System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/district_hospital_logo.png" type="image/x-icon">
    <link rel="icon" href="images/district_hospital_logo.png" type="image/x-icon">

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen"/>

    <!-- StyleSheets -->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/design.css">
    <link rel="stylesheet" href="css/responsive.css">


    <!-- Fonts Online -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Raleway:200,300,400,500,600,700,800,900"
          rel="stylesheet">

    <!-- JavaScripts -->
    <script src="js/vendors/modernizr.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- Page Loader -->
<div id="loader">
    <div class="position-center-center">
        <div class="cssload-thecube">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
    </div>
</div>

<!-- Page Wrapper -->
<div id="wrap">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>Welcome To Dao District, Hospital Management System</p>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons"><a href="https://www.facebook.com/dao.gerardo"><i
                                    class="fa fa-facebook"></i></a> <a href="https://www.twitter.com/itsourcecode"><i
                                    class="fa fa-twitter"></i></a> <a href="https://www.itsourcecode.com/"><i
                                    class="fa fa-dribbble"></i></a> <a
                                href="https://www.linkedin.com/in/joken-villanueva-776b99157/"><i
                                    class="fa fa-linkedin"></i></a> <a
                                href="https://www.youtube.com/c/JokenVillanueva?sub_confirmation=1"><i
                                    class="fa fa-youtube"></i></a></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Header -->
    <header class="header-style-2">
        <div class="container">
            <div class="logo"><a href="index.php"><img src="images/hms-logo.png" alt="" style="height: 70px;"></a></div>
            <div class="head-info">
                <ul>
                    <li><i class="fa fa-phone"></i>
                        <p>036-6580037<br>
                            0920-2029963</p>
                    </li>
                    <li><i class="fa fa-map-marker"></i>
                        <p>5810 Brgy. Balucuan Dao, Capiz <br>
                            Philippines</p>
                    </li>
                    <!-- <li> <a href="attendancemonitoring/index.php" target="_blank"> <p style="background-color: dodgerblue; padding: 10px;color:white; font-size:20px">Employees Attendance</p> </a>


                    </li> -->
                </ul>
            </div>
        </div>

        <!-- Nav -->
        <nav class="navbar ownmenu">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#nav-open-btn" aria-expanded="false"><span><i class="fa fa-navicon"></i></span>
                    </button>
                </div>

                <!-- NAV -->
                <div class="collapse navbar-collapse" id="nav-open-btn">
                    <ul class="nav">
                        <li><a href="index.php">HOME </a></li>
                        <li><a href="services.php">LIST OF SERVICES </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">OUT-PATIENT SERVICES </a>
                            <ul class="dropdown-menu multi-level" style="display: none;">
                                <li><a href="ourdepartment.php">CONSULTATION</a></li>
                                <li><a href="familyplanning.php">FAMILY PLANNING</a></li>
                                <li><a href="animalbite.php">ANIMAL BITE TREATMENT CENTER </a></li>
                                <li><a href="prenatal.php">PRENATAL / POSTNATAL CARE AND LECTURE </a></li>
                                <li><a href="tbdots.php">TB DOTS </a></li>
                                <li><a href="medicalrecord.php">MEDICAL RECORDS </a></li>
                            </ul>
                        </li>
                        <li><a href="inpatientservice.php">IN-PATIENT SERVICES </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">ANCILLARY SERVICES </a>
                            <ul class="dropdown-menu multi-level" style="display: none;">
                                <li><a href="laboratory.php">LABORATORY SERVICES</a></li>
                                <li><a href="xray.php">X-RAY/ULTRASOUND</a></li>
                                <li><a href="pharmacy.php">PHARMACY SERVICES </a></li>
                            </ul>
                        </li>
                        <li><button type="button" style="float: left; background-color: #04AA6D;"><a href="patientappointment.php">APPOINTMENT </a></li>
                        <!-- <li><a href="emergencyroom.php">EMERGENCY ROOM </a></li> -->
                        <li><a href="contact.php">CONTACT </a></li>
                        <li><a href="gallery.php">GALLERY </a></li>
                        <li class="dropdown">
                            <button type="button" style="float: right; background-color: #04AA6D;">
                                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">Log In </a></button>
                            <ul class="dropdown-menu multi-level" style="display: none;">
                                <li><a href="adminlogin.php">ADMIN</a></li>
                                <li><a href="doctorlogin.php">DOCTOR</a></li> -->
                                <!-- <li><a href="patientlogin.php">PATIENT LOG IN</a></li> -->
                                <!-- <li><a href="employeeslogin.php">Employees </a></li> -->

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>