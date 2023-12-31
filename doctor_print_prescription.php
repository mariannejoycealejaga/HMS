<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");

$sql ="SELECT * FROM prescription WHERE prescriptionid='$_GET[prescriptionid]'";
$result = mysqli_query($con,$sql);

$prescription = mysqli_fetch_array($result);
$sqlpatient = "SELECT * FROM patient WHERE patientid='$prescription[patientid]'";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient = mysqli_fetch_array($qsqlpatient);

$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$prescription[doctorid]'";
$qsqldoctor = mysqli_query($con,$sqldoctor);
$rsdoctor = mysqli_fetch_array($qsqldoctor);
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>HMS by Dao District Hospital</title>
    <link rel="icon" href="images/district_hospital_logo.png" type="image/x-icon">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet"/>

    <!-- Custom Css -->
    <!--    <link href="assets/css/main.css" rel="stylesheet">-->
    <!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/themes/all-themes.css" rel="stylesheet"/>
    <!-- Bootstrap Material Datetime Picker Css -->
    <style>
        *{
            margin: 10px !important;
            justify-content: center;
        }
        body {
            transition: all 0.3s ease;
        }

        .prescription_form {
            width: 100%;
            height: 50vh !important;

            background: white;
        }

        .prescription {
            width: 720px;
            height: 960px;
            margin: 0 auto;
            border: 1px solid lightgrey;
        }

        .prescription tr > td {
            padding: 15px;
        }

        .header {
            color: #333;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            flex: 1;
        }

        .logo img {
            width: 120px;
            height: 120px;
            float: left;
        }

        .credentials {
            flex: 1;
        }

        .credentials h4 {
            line-height: 1em;
            letter-spacing: 1px;
            font-weight: 700;
            margin: 0px;
            padding: 0px;
        }

        .credentials p {
            margin: 0 0 5px 0;
            padding: 3px 0px;
        }

        .credentials small {
            margin: 0;
            padding: 0;
            letter-spacing: 1px;
            padding-right: 80px;
            font-size: 20px;
            
        }

        .d-header {
            width: 100%;
            text-align: center;
            background: mediumseagreen;
            padding: 5px;
            color: white;
            font-weight: 800;
        }

        .symptoms,
        .tests,
        .advice {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .symptoms ul,
        .tests ul {
            list-style: square;
            margin: 0;
            padding-left: 10px;
            height: 100%;
        }

        .advice p {
            letter-spacing: 0;
            font-size: 14px;
        }

        .advice .adv_text {
            flex-grow: 1;
            width: 100%;
            height: 100%;
        }

        .desease_details {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            appearance: none;
            outline: 0;
            box-shadow: none;
            border: 0 !important;
            background: #fff;
            background-image: none;
        }

        select::-ms-expand {
            display: none;
        }

        select {
            font-weight: bold;
            padding: 0 0.5em;
            color: #333;
            cursor: pointer;
            outline: none;
        }

        input[type="date"] {
            padding: 0;
            margin: 0;
            font-weight: bold;
            border: none;
        }

        .med_meal_action .btn {
            margin: 2px;
        }

        @keyframes shake {
            10%, 90% {
                transform: translate3d(-1px, 0, 0);
            }

            20%, 80% {
                transform: translate3d(2px, 0, 0);
            }

            30%, 50%, 70% {
                transform: translate3d(-4px, 0, 0);
            }

            40%, 60% {
                transform: translate3d(4px, 0, 0);
            }
            95% {
                opacity: 0;
            }
        }

        hr {
            margin: 10px 0px;
        }

        .med:hover hr {
            border-top: 3px #111 solid;
        }

        .med:hover .delete {
            display: inline;
            opacity: 1;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }
            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }
            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }
            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }
            to {
                bottom: 0;
                opacity: 0;
            }
        }

        .symptoms > ul > li {
            font-size: 20px;
        }
        h1 {
        text-align: center;
        font-size: 25px;
        }
        h3 {
        text-align: right;
        }
    </style>
</head>


<body>
<section class="container">
    <h2 class="text-center">HMS Prescription Report</h2>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <div class="prescription_form">

                <table class="prescription" border="1">
                    <tbody>
                    <tr height="15%">
                        <td colspan="2">
                            <div class="header">
                                <div class="logo">
                                    <img src="images/district_hospital_logo.png"
                                         height="100" width="100"/><br>
                                         <h1> SEN. GERARDO M. ROXAS MEMORIAL DISTRICT HOSPITAL </h1>
                                         <h1> Brgy. Balucuan Dao. Capiz </h1>
                                </div>
                            </div>
                            </div>
                                <div class="credentials">
                                    <!-- <h4><?= $rsdoctor[doctorname]?></h4> -->

                                    <small> Name: <?= $rspatient['patientname']?></small><br>
                                    <small> Address: <?= $rspatient[address]?></small><br>
                                    <small> Mobile Number: <?= $rspatient[mobileno]?></small><br>
                                    <small> Date: <?= $dt = date("m-d-Y")?></small><br>
                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr height="5%">
                        <td><h4>RX</h4></td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <div class="desease_details">
                                <div class="symptoms">
                                    <h4 class="d-header">Medicines</h4>
                                    <?php
                                    $sql_pres_records ="SELECT a.cost, a.unit, a.dosage, b.medicinename, b.medicinecost, b.description FROM prescription_records a INNER JOIN medicine b ON a.medicine_name = b.medicineid WHERE prescription_id = '$_GET[prescriptionid]' AND a.status='Active'";
                                    $ssql_pres_records = mysqli_query($con,$sql_pres_records);
                                    echo "<ul>";
                                    while($pres_records_results = mysqli_fetch_array($ssql_pres_records))
                                    {
                                        echo "<li>" . $pres_records_results[medicinename] . " - " . $pres_records_results[unit] . " units" . "</li>";
                                        echo "<li>" . $pres_records_results[dosage] . "</li>";
                                    }
                                    echo "</ul>";
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4 class="d-header">Notes</h4>
                            <?php
                            $sql_pres_records ="SELECT a.notes FROM prescription_records a INNER JOIN medicine b ON a.medicine_name = b.medicineid WHERE prescription_id = '$_GET[prescriptionid]' AND a.status='Active'";
                            $ssql_pres_records = mysqli_query($con,$sql_pres_records);
                            while($pres_records_results = mysqli_fetch_array($ssql_pres_records))
                            {
                                echo "<p>" . $pres_records_results[notes] . "</p>";
                            }
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <h3><?= $rsdoctor[doctorname]?> M.D</h3 >
                <h3> License No.: ___________</h3>

            </div>
        </div>
    </div>
</section>

<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="assets/bundles/morphingsearchscripts.bundle.js"></script> <!-- morphing search Js -->
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<script src="assets/bundles/datatablescripts.bundle.js"></script><!-- Jquery DataTable Plugin Js -->

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/bundles/morphingscripts.bundle.js"></script><!-- morphing search page js -->
<script src="assets/js/morphing.js"></script><!-- Custom Js -->
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/pages/forms/editors.js"></script>
<script>
    window.print();
</script>
</body>