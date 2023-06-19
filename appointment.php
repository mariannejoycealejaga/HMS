<?php

include("adheader.php");
include("dbconnection.php");
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $sql = "UPDATE patient SET status='Active' WHERE patientid = '" . $_POST['patient_id'] . "'";
    $qsql = mysqli_query($con, $sql);
    $patient_id = $_POST['patient_id'];
    $appointment_time = $_POST['appointment_date'];
    $department_id = $_POST['department_id'];
    $doctor_id = $_POST['doctor_id'];
    $status = $_POST['status'];
    $appointment_reason = $_POST['appointment_reason'];
    $appointment_date = date('Y-m-d'); // Assuming the input date is received via a form field
    $appointment_time = date("H:i:s");
    $sql = "INSERT INTO appointment (appointmenttype, patientid, roomid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) VALUES (null, $patient_id, null, $department_id, '$appointment_date', '$appointment_time', $doctor_id, '$status', '$appointment_reason')";
    if ($qsql = mysqli_query($con, $sql)) {
        include("insertbillingrecord.php");
        echo "<script>alert('Appointment Record Inserted Successfully.');</script>";
        echo "<script>window.location='patientreport.php?patientid=$patient_id';</script>";
    } else {
        echo mysqli_error($con);
    }
}
if (isset($_GET[editid])) {
    $sql = "SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}
?>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Book Appointment</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Appointment Information </h2>

                    </div>
                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="select2" value="Offline">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">Note!</h4>
                                        <p><code>*</code> fields are required.</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?php
                                            if (isset($_SESSION[patientid])) {
                                                $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]'";
                                                $qsqlpatient = mysqli_query($con, $sqlpatient);
                                                $rspatient = mysqli_fetch_array($qsqlpatient);
                                                echo "<label for='patient_id'>Patient <code>*</code></label>";
                                                echo "<br />";
                                                echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
                                                echo "<input type='hidden' id='patient_id' name='patient_id' value='$rspatient[patientid]'>";
                                            } else {
                                                ?>
                                                <label for="patient_id">Patient <code>*</code></label>
                                                <select name="patient_id" id="patient_id" class="form-control show-tick"
                                                        required autofocus>
                                                    <option value="" selected>Select Value</option>
                                                    <?php
                                                    $sqlpatient = "SELECT * FROM patient WHERE status='Active'";
                                                    $qsqlpatient = mysqli_query($con, $sqlpatient);
                                                    while ($rspatient = mysqli_fetch_array($qsqlpatient)) {
                                                        if ($rspatient[patientid] == $rsedit[patientid]) {
                                                            echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                                                        } else {
                                                            echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                                                        }

                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="address">Address <code>*</code></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="city">City <code>*</code></label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="e.g Roxas City" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="contact_no">Contact No. <code>*</code></label>
                                            <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="+639"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="gender">Gender <code>*</code></label>
                                            <select name="gender" id="gender" class="form-control show-tick">
                                                <option value="">Select Value</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="dob">Date of Birth <code>(dd/mm/yyyy) *</code></label>
                                            <input type="date" class="form-control" id="dob" name="dob" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="appointment_date">Appointment Date & Time <code>(dd/mm/yyyy
                                                    hh:mm am/pm) *</code></label>
                                            <input type="datetime-local" class="form-control" id="appointment_date_time"
                                                   name="appointment_date_time" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="department_id">Department <code>*</code></label>
                                            <select id="department_id" name="department_id" class="form-control show-tick" required>
                                                <option value="" selected>Select Value</option>
                                                <?php
                                                $sqldepartment = "SELECT * FROM department WHERE status='Active'";
                                                $qsqldepartment = mysqli_query($con, $sqldepartment);
                                                while ($rsdepartment = mysqli_fetch_array($qsqldepartment)) {
                                                    if ($rsdepartment[departmentid] == $rsedit[departmentid]) {
                                                        echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
                                                    } else {
                                                        echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
                                                    }

                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="doctor_id">Doctor <code>*</code></label>
                                            <select name="doctor_id" id="doctor_id" class="form-control show-tick" required>
                                                <option value="" selected>Select Value</option>
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
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="appointment_reason">Appointment Reason <code>(fever, headache) *</code></label>
                                        <textarea rows="4" class="form-control no-resize" name="appointment_reason"
                                                  id="appointment_reason" placeholder="Appointment Reason" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="status">Status <code>*</code></label>
                                            <select name="status" id="status" class="form-control show-tick" required>
                                                <option value="" selected>Select Value</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include 'adfooter.php'; ?>