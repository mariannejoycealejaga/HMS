<?php

include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
    $dt = date("Y-m-d");
    $tim = date("H:i:s");
    $sql ="INSERT INTO emergency_room_patients(patient_case_no,patient_name,address,chief_complaint, contact_no, present_illness, blood_pressure, respiratory_rate, capillary_refill, temperature, weight, pulse_rate, attending_physician_id, appointment_date, physical_examination, diagnosis, medication_treatment) VALUES ('$_POST[patienteID]', '$_POST[patiente]', '$_POST[textarea]', '$_POST[chiefcomplaint]', '$_POST[mobileno]', '$_POST[history]', '$_POST[bloodpressure]', '$_POST[respiratoryrate]', '$_POST[capillaryrefill]', '$_POST[temperature]', '$_POST[weight]', '$_POST[pulserate]', '$_POST[doct]', '$_POST[dob]', '$_POST[physical_examination]', '$_POST[diagnosis]', '$_POST[app_reason]')";
    if($qsql = mysqli_query($con, $sql))
    {
        echo "<script>alert('Patient Record inserted successfully...');</script>";
    }
    else
    {
        echo mysqli_error($con);
    }

    $lastinsid = mysqli_insert_id($con);
	
	$sqlappointment="SELECT * FROM emergencyroom WHERE appointmentdate='$_POST[appointmentdate]' AND appointmenttime='$_POST[appointmenttime]' AND doctorid='$_POST[doct]' AND status='Approved'";
	$qsqlappointment = mysqli_query($con,$sqlappointment);
	if(mysqli_num_rows($qsqlappointment) >= 1)
	{
		echo "<script>alert('Appointment Already Scheduled for This Time.');</script>";
	}
	else
	{
//		$sql ="INSERT INTO appointment(appointmenttype,id,appointmentdate,appointmenttime,app_reason,status,departmentid,doctorid) values('ONLINE','$lastinsid','$_POST[appointmentdate]','$_POST[appointmenttime]','$_POST[app_reason]','Pending','$_POST[department]','$_POST[doct]')";
//		if($qsql = mysqli_query($con,$sql))
//		{
//			echo "<script>alert('Appointment Record Inserted Successfully...');</script>";
//		}
//		else
//		{
//			echo mysqli_error($con);
//		}
	}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
if(isset($_SESSION[id]))
{
    $sqlpatient = "SELECT * FROM patient WHERE id='$_SESSION[id]' ";
    $qsqlpatient = mysqli_query($con,$sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);
    $readonly = " readonly";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="wrapper col4">
    <div id="container">

        <?php
        if(isset($_POST[submit]))
        {
           if(mysqli_num_rows($qsqlappointment) >= 1)
           {		
             echo "<h2>Appointment already scheduled for ". date("d-M-Y", strtotime($_POST[appointmentdate])) . " " . date("H:i A", strtotime($_POST[appointmenttime])) . " .. </h2>";
         }
         else
         {
          if(isset($_SESSION[id]))
          {
             echo '<section class="p-t-b-150">
             <div class="container">
             <div class="intro-main">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text-sec padding-right-0">
                            <div class="heading-block head-left margin-bottom-50">
                                <h4>Patient information has been successfully encoded</h4>
                            </div>
                            <p>Appointment record is in successfully processed.</p>
                            <p> <a href="viewappointment.php">View Appointment record</a>. </p>
                        </div>
                    </div>
                </div>
            </div></div></section>
                ';		
         }
         else
         {
             echo '<section class="p-t-b-150">
             <div class="container">
             <div class="intro-main">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text-sec padding-right-0">
                            <div class="heading-block head-left margin-bottom-50">
                                <h4>Patient information has been successfully encoded</h4>
                            </div>
                            <p>Appointment record is in successfully processed.</p>
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
        <div id="contented">



            <!-- Make an Appointment -->
            <section class="main-background">
                <div class="container">
                    <div class="row">

                        <!-- Make an Appointment -->
                        <div class="col-lg-9">
                            <div class="appointment">

                                <!-- Heading -->
                                <div class="heading-block head-left margin-bottom-10">
                                 <center><h1>Emergency Room</h1></center>
                                    <br>
                                    <h5><strong>Patient Information</strong></h5>
                                <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" name="frmpatapp" onSubmit="rseturn validateform()"
                                    class="appointment-form">
                                    <ul class="row">
                                    <li class="col-sm-6">
                                    PATIENT CASE NUMBER:  <label>
                                             <input placeholder="Enter Patient Case Number" type="text" class="form-control"
                                                    name="patienteID" id="patienteID"
                                                    value="<?php echo $rspatient[a_fname];  ?>"
                                                    <?php echo $readonly; ?>>
                                                <i class="fa fa-user-plus"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                        PATIENT NAME:  <label>
                                             <input placeholder="Enter Patient Name" type="text" class="form-control"
                                                    name="patiente" id="patiente"
                                                    value="<?php echo $rspatient[a_fname];  ?>"
                                                    <?php echo $readonly; ?>>
                                                <i class="icon-user"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        ADDRESS:   <label><input placeholder="Enter Address" type="text" class="form-control"
                                                    name="textarea" id="textarea"
                                                    value="<?php echo $rspatient[address];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-compass"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                        CHIEF COMPLAINT:    <label><input placeholder="Enter Chief Complaint" type="text" class="form-control"
                                                    name="chiefcomplaint" id="chiefcomplaint" 
                                                    value="<?php echo $rspatient[chiefcomplaint];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-pin"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                        MOBILE NUMBER: <label>
                                                <input placeholder="Mobile Number" type="text" class="form-control"
                                                    name="mobileno" id="mobileno"
                                                    value="<?php echo $rspatient[mobileno];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-phone"></i>
                                            </label>

                                        </li>
                            
    
                                        <li class="col-sm-6">
                                        HISTORY OF PRESENT ILLNESS: <label>
                                                <input placeholder="Enter History of Present Illness" type="history" class="form-control"
                                                    name="history" id="history"
                                                    value="<?php echo $rspatient[history];  ?>"
                                                    <?php echo $readonly; ?>><i class="fa fa-clone"></i>
                                            </label>

                                        </li>

                                         <br>
                                         <br>
                                         <h5 class="col-sm-9"> <strong>Vital Signs </strong></h5>

                                         <li class="col-sm-6">
                                         Blood Pressure: <label>
                                                <input placeholder="Enter Blood Pressure" type="bloodpressure" class="form-control"
                                                    name="bloodpressure" id="bloodpressure"
                                                    value="<?php echo $rspatient[bloodpressure];  ?>"
                                                    <?php echo $readonly; ?>><i class="fa fa-heartbeat"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        Respiratory Rate: <label>
                                                <input placeholder="Enter Respiratory Rate" type="respiratoryrate" class="form-control"
                                                    name="respiratoryrate" id="respiratoryrate"
                                                    value="<?php echo $rspatient[respiratoryrate];  ?>"
                                                    <?php echo $readonly; ?>><i class="fa fa-stethoscope"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        Capillary Refill: <label>
                                                <input placeholder="Enter Capillary Refill" type="capillaryrefill" class="form-control"
                                                    name="capillaryrefill" id="capillaryrefill"
                                                    value="<?php echo $rspatient[capillaryrefill];  ?>"
                                                    <?php echo $readonly; ?>><i class="fa fa-user-md"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        Temperature: <label>
                                                <input placeholder="Enter Temperature" type="temperature" class="form-control"
                                                    name="temperature" id="temperature"
                                                    value="<?php echo $rspatient[temperature];  ?>"
                                                    <?php echo $readonly; ?>><i class="	fa fa-thermometer"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        Weight: <label>
                                                <input placeholder="Enter Weight" type="weight" class="form-control"
                                                    name="weight" id="weight"
                                                    value="<?php echo $rspatient[weight];  ?>"
                                                    <?php echo $readonly; ?>><i class="fa fa-medkit"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        Pulse Rate: <label>
                                                <input placeholder="Enter Pulse Rate" type="pulserate" class="form-control"
                                                    name="pulserate" id="pulserate"
                                                    value="<?php echo $rspatient[pulserate];  ?>"
                                                    <?php echo $readonly; ?>><i class="fa fa-hospital-o"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        ATTENDING PHYSICIAN:    <label>
                                                <select name="doct" class="selectpicker" id="department"
                                                    >
                                                    <option value="">Select Doctor</option>
                                            <?php
                                                $sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
                                                $qsqldoctor = mysqli_query($con,$sqldoctor);
                                                while($rsdoctor = mysqli_fetch_array($qsqldoctor))
                                                {
                                                if($rsdoctor[doctorid] == $rsedit[doctorid])
                                                {
                                                    echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
                                                }
                                            }
                                        ?>
                                                                </select>
                                                <i class="ion-medkit"></i>

                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                        DATE:   <label>
                                                <input placeholder="mm/dd/yy" type="text" class="form-control"
                                                    name="dob" id="dob" onfocus="(this.type='date')"
                                                    value="<?php echo $rspatient[dob]; ?>" <?php echo $readonly; ?>><i
                                                    class="ion-calendar"></i>
                                            </label>

                                        </li>
                                        

                                        <li class="col-sm-6">
                                        PHYSICAL EXAMINATION <label>
                                                <textarea class="form-control" name="physical_examination"
                                                    placeholder="Enter Physical Examination"></textarea>
                                            </label>
                                        </li>

                                        <li class="col-sm-6">
                                        DIAGNOSIS <label>
                                                <textarea class="form-control" name="diagnosis"
                                                    placeholder="Enter Diagnosis"></textarea>
                                            </label>
                                        </li>

                                        <li class="col-sm-6">
                                        MEDICATION/TREATMENT <label>
                                                <textarea class="form-control" name="app_reason"
                                                    placeholder="Enter Medication/Treatment"></textarea>
                                            </label>
                                        </li>
                                        <li class="col-sm-12">
                                            <button type="submit" class="btn" name="submit" id="submit">make an
                                                appointment</button>
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
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("divdoc").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "departmentDoctor.php?deptid=" + deptid, true);
    xmlhttp.send();
}
</script>