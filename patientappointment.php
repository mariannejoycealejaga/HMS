<?php

include("header.php");
include("dbconnection.php");
if (isset($_POST[submit])) {
    if (isset($_SESSION[patientid])) {
        $lastinsid = $_SESSION[patientid];
    } else {
        $query = "SELECT * FROM patient WHERE loginid = '$_POST[loginid]'";
        if ($result = mysqli_query($con, $query)) {
            $rowcount = mysqli_num_rows($result);
            if (!$rowcount) {
                $dt = date("Y-m-d");
                $tim = date("H:i:s");
                $sql = "INSERT INTO patient(patientname,admissiondate,admissiontime,address,city,mobileno,loginid,password,gender,dob,status) values('$_POST[patiente]','$dt','$tim','$_POST[textarea]','$_POST[city]','$_POST[mobileno]','$_POST[loginid]','$_POST[password]','$_POST[select6]','$_POST[dob]','Active')";
                if ($qsql = mysqli_query($con, $sql)) {
                    $dt = date("Y-m-d");
                    $tim = date("H:i:s");
                    $sql = "INSERT INTO appointment(appointmenttype,patientid,appointmentdate,appointmenttime,app_reason,status,departmentid,doctorid) values('ONLINE', $_POST[loginid], '$_POST[appointmentdate]','$_POST[appointmenttime]', '$_POST[app_reason]','Pending', '$_POST[department]','$_POST[doct]')";
                    mysqli_query($con, $sql);
                    echo "<script>alert('Account and appointment has been successfully created.');</script>";
                } else {
                    echo mysqli_error($con);
                }
                $lastinsid = mysqli_insert_id($con);
            } else {
                // Fetch one and one row
                $dt = date("Y-m-d");
                $tim = date("H:i:s");
                $sql = "INSERT INTO appointment(appointmenttype,patientid,appointmentdate,appointmenttime,app_reason,status,departmentid,doctorid) values('ONLINE', $_POST[loginid], '$_POST[appointmentdate]','$_POST[appointmenttime]', '$_POST[app_reason]','Pending', '$_POST[department]','$_POST[doct]')";
                if ($qsql = mysqli_query($con, $sql)) {
                    echo "<script>alert('Account has already been registered but appointment has been successfully created.');</script>";
                } else {
                    echo mysqli_error($con);
                }
                $lastinsid = mysqli_insert_id($con);
            }
        }

    }

//    $sqlappointment = "SELECT * FROM appointment WHERE appointmentdate='$_POST[appointmentdate]' AND appointmenttime='$_POST[appointmenttime]' AND doctorid='$_POST[doct]' AND status='Approved'";
//    $qsqlappointment = mysqli_query($con, $sqlappointment);
//    if (mysqli_num_rows($qsqlappointment) >= 1) {
//        echo "<script>alert('Appointment Already Scheduled for This Time.');</script>";
//    } else {
//        $sql = "INSERT INTO appointment(appointmenttype,patientid,appointmentdate,appointmenttime,app_reason,status,departmentid,doctorid) values('ONLINE','$lastinsid','$_POST[appointmentdate]','$_POST[appointmenttime]','$_POST[app_reason]','Pending','$_POST[department]','$_POST[doct]')";
//        if ($qsql = mysqli_query($con, $sql)) {
//            echo "<script>alert('Appointment Record Inserted Successfully...');</script>";
//        } else {
//            echo mysqli_error($con);
//        }
//    }
}
if (isset($_GET[editid])) {
    $sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);

}
if (isset($_SESSION[patientid])) {
    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
    $qsqlpatient = mysqli_query($con, $sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);
    $readonly = " readonly";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="wrapper col4">
    <div id="container">

        <?php
        if (isset($_POST[submit]))
        {
            if (mysqli_num_rows($qsqlappointment) >= 1) {
                echo "<h2>Appointment already scheduled for " . date("d-M-Y", strtotime($_POST[appointmentdate])) . " " . date("H:i A", strtotime($_POST[appointmenttime])) . " .. </h2>";
            } else {
                if (isset($_SESSION[patientid])) {
                    echo '<section class="p-t-b-150">
             <div class="container">
             <div class="intro-main">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text-sec padding-right-0">
                            <div class="heading-block head-left margin-bottom-50">
                                <h4>Appointment taken successfully</h4>
                            </div>
                            <p>Appointment record is in pending process. Kinldy check the appointment status.</p>
                            <p> <a href="viewappointment.php">View Appointment record</a>. </p>
                        </div>
                    </div>
                </div>
            </div></div></section>
                ';
                } else {
                    echo '<section class="p-t-b-150">
             <div class="container">
             <div class="intro-main">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text-sec padding-right-0">
                            <div class="heading-block head-left margin-bottom-50">
                                <h4>Appointment taken successfully</h4>
                            </div>
                            <p>Appointment record is in pending process. Please wait for confirmation message.</p>
                            <p> <a href="patientlogin.php">Click here to Login</a>. </p>
                        </div>
                    </div>
                </div>
            </div></div></section>
                ';
                }
            }
        }
        else
        {
        ?>
        <!-- Content -->
        <div id="content">


            <!-- Make an Appointment -->
            <section class="main-oppointment ">
                <div class="container">
                    <div class="row">

                        <!-- Make an Appointment -->
                        <div class="col-lg-7">
                            <div class="appointment">

                                <!-- Heading -->
                                <div class="heading-block head-left margin-bottom-10">
                                    <!-- <a href="patientrecordtable.php"><button style="background-color:#0a0a0a; color: white; padding: 14px 28px;"> Patient Record Table</button></a><br><br> -->
                                    <center><h1>Make an Appointment</h1></center>
                                    <form method="post" action="" name="frmpatapp" onSubmit="return validateform()"
                                          class="appointment-form">
                                        <ul class="row">
                                            <div class="col-sm-6">
                                                Patient Name: <label>
                                                    <input placeholder="Patient Name" type="text" class="form-control"
                                                           name="patiente" id="patiente"
                                                           value="<?php echo $rspatient[patientname]; ?>"
                                                        <?php echo $readonly; ?>>
                                                    <i class="icon-user"></i>
                                                </label>
                                            </div>

                                            <li class="col-sm-6">
                                                Address: <label><input placeholder="Address" type="text"
                                                                       class="form-control"
                                                                       name="textarea" id="textarea"
                                                                       value="<?php echo $rspatient[address]; ?>"
                                                        <?php echo $readonly; ?>><i class="icon-compass"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                City: <label><input placeholder="City" type="text" class="form-control"
                                                                    name="city" id="city"
                                                                    value="<?php echo $rspatient[city]; ?>"
                                                        <?php echo $readonly; ?>><i class="icon-pin"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                Mobile Number: <label>
                                                    <input placeholder="Mobile Number" type="text" class="form-control"
                                                           name="mobileno" id="mobileno"
                                                           value="<?php echo $rspatient[mobileno]; ?>"
                                                        <?php echo $readonly; ?>><i class="icon-phone"></i>
                                                </label>

                                            </li>
                                            <?php
                                            if (!isset($_SESSION[patientid])) {
                                                ?>
                                                <li class="col-sm-6">
                                                    Login ID: <label>
                                                        <input placeholder="Login ID" type="text" class="form-control"
                                                               name="loginid" id="loginid"
                                                               value="<?php echo $rspatient[loginid]; ?>"
                                                            <?php echo $readonly; ?>><i class="icon-login"></i>
                                                    </label>

                                                </li>
                                                <li class="col-sm-6">
                                                    Password: <label>
                                                        <input placeholder="Password" type="password"
                                                               class="form-control"
                                                               name="password" id="password"
                                                               value="<?php echo $rspatient[password]; 
                                                               $hashed_password = password_hash($_POST[password], PASSWORD_DEFAULT);?>"
                                                            <?php echo $readonly; ?>><i class="icon-lock"></i>
                                                    </label>

                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <li class="col-sm-6">
                                                Select Gender: <label>

                                                    <?php
                                                    if (isset($_SESSION[patientid])) {
                                                        echo $rspatient[gender];
                                                    } else {
                                                        ?>
                                                        <select name="select6" id="select6" class="selectpicker">
                                                            <option value="" selected="" hidden="">Select Gender
                                                            </option>
                                                            <?php
                                                            $arr = array("Male", "Female");
                                                            foreach ($arr as $val) {
                                                                echo "<option value='$val'>$val</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <?php
                                                    }
                                                    ?>
                                                    <i class="ion-transgender"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                Date of Birth: <label>
                                                    <input placeholder="Date of birth" type="text" class="form-control"
                                                           name="dob" id="dob" onfocus="(this.type='date')"
                                                           value="<?php echo $rspatient[dob]; ?>" <?php echo $readonly; ?>><i
                                                        class="ion-calendar"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                Appointment Date:<label>
                                                    <input placeholder="Appointment date" type="text"
                                                           class="form-control"
                                                           min="<?php echo date("Y-m-d"); ?>" name="appointmentdate"
                                                           onfocus="(this.type='date')" id="appointmentdate"><i
                                                        class="ion-calendar"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                Appointment Time: <label>
                                                    <input placeholder="Appointment time" type="text"
                                                           onfocus="(this.type='time')" class="form-control"
                                                           name="appointmenttime" id="appointmenttime"><i
                                                        class="ion-ios-clock"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                Select Department: <label>

                                                    <select name="department" class="selectpicker" id="department"
                                                    >
                                                        <option value="">Select department</option>
                                                        <?php
                                                        $sqldept = "SELECT * FROM department WHERE status='Active'";
                                                        $qsqldept = mysqli_query($con, $sqldept);
                                                        while ($rsdept = mysqli_fetch_array($qsqldept)) {
                                                            echo "<option value='$rsdept[departmentid]'>$rsdept[departmentname]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <i class="ion-university"></i>
                                                </label>

                                            </li>
                                            <li class="col-sm-6">
                                                Select Doctor: <label>
                                                    <select name="doct" class="selectpicker" id="department"
                                                    >
                                                        <option value="">Select Doctor</option>
                                                        <?php
                                                        $sqldoctor = "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
                                                        $qsqldoctor = mysqli_query($con, $sqldoctor);
                                                        while ($rsdoctor = mysqli_fetch_array($qsqldoctor)) {
                                                            if ($rsdoctor[doctorid] == $rsedit[doctorid]) {
                                                                echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
                                                            } else {
                                                                echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <i class="ion-medkit"></i>

                                                </label>

                                            </li>
                                            <li class="col-sm-12">
                                                Appointment Reason: e.g (fever, headache) <label>
                                                <textarea class="form-control" name="app_reason"
                                                          placeholder="Appointment reason"></textarea>
                                                </label>
                                            </li>
                                            <li class="col-sm-12">
                                                <button type="submit" class="btn" name="submit" id="submit">make an
                                                    appointment
                                                </button>
                                            </li>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    }
                    ?>

                </div>
        </div>
    </div>
    </section>
</div>


<?php
include("footer.php");
?>
<script type="application/javascript">
    var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
    var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
    var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

    function validateform() {
        if (document.frmpatapp.patiente.value == "") {
            alert("Patient name should not be empty..");
            document.frmpatapp.patiente.focus();
            return false;
        } else if (!document.frmpatapp.patiente.value.match(alphaspaceExp)) {
            alert("Patient name not valid..");
            document.frmpatapp.patiente.focus();
            return false;
        } else if (document.frmpatapp.textarea.value == "") {
            alert("Address should not be empty..");
            document.frmpatapp.textarea.focus();
            return false;
        } else if (document.frmpatapp.city.value == "") {
            alert("City should not be empty..");
            document.frmpatapp.city.focus();
            return false;
        } else if (!document.frmpatapp.city.value.match(alphaspaceExp)) {
            alert("City name not valid..");
            document.frmpatapp.city.focus();
            return false;
        } else if (document.frmpatapp.mobileno.value == "") {
            alert("Mobile number should not be empty..");
            document.frmpatapp.mobileno.focus();
            return false;
        } else if (!document.frmpatapp.mobileno.value.match(numericExpression)) {
            alert("Mobile number not valid..");
            document.frmpatapp.mobileno.focus();
            return false;
        } else if (document.frmpatapp.loginid.value == "") {
            alert("Login ID should not be empty..");
            document.frmpatapp.loginid.focus();
            return false;
        } else if (!document.frmpatapp.loginid.value.match(alphanumericExp)) {
            alert("Login ID not valid..");
            document.frmpatapp.loginid.focus();
            return false;
        } else if (document.frmpatapp.password.value == "") {
            alert("Password should not be empty..");
            document.frmpatapp.password.focus();
            return false;
        } else if (document.frmpatapp.password.value.length < 8) {
            alert("Password length should be more than 8 characters...");
            document.frmpatapp.password.focus();
            return false;
        } else if (document.frmpatapp.select6.value == "") {
            alert("Gender should not be empty..");
            document.frmpatapp.select6.focus();
            return false;
        } else if (document.frmpatapp.dob.value == "") {
            alert("Date Of Birth should not be empty..");
            document.frmpatapp.dob.focus();
            return false;
        } else if (document.frmpatapp.appointmentdate.value == "") {
            alert("Appointment date should not be empty..");
            document.frmpatapp.appointmentdate.focus();
            return false;
        } else if (document.frmpatapp.appointmenttime.value == "") {
            alert("Appointment time should not be empty..");
            document.frmpatapp.appointmenttime.focus();
            return false;
        } else {
            return true;
        }
    }

    function loaddoctor(deptid) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divdoc").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "departmentDoctor.php?deptid=" + deptid, true);
        xmlhttp.send();
    }
</script>