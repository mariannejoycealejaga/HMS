<?php

include("adheader.php");
include("dbconnection.php");
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $patient_case_no = $_POST['patient_case_no'];
    $patient_name = $_POST['patient_name'];
    $address = $_POST['address'];
    $chief_complaint = $_POST['chief_complaint'];
    $mobile_no = $_POST['mobile_no'];
    $history_of_present_illness = $_POST['history_of_present_illness'];
    $blood_pressure = $_POST['blood_pressure'];
    $respiratory_rate = $_POST['respiratory_rate'];
    $capillary_refill = $_POST['capillary_refill'];
    $temperature = $_POST['temperature'];
    $weight = $_POST['weight'];
    $pulse_rate = $_POST['pulse_rate'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = date_format(date_create($_POST['appointment_date']), 'Y-m-d');
    $physical_examination = $_POST['physical_examination'];
    $diagnosis = $_POST['diagnosis'];
    $medication_treatment = $_POST['medication_treatment'];
    $sql = "INSERT INTO emergency_room_patients (patient_case_no, patient_name, address, chief_complaint, mobile_no, history_of_present_illness, blood_pressure, respiratory_rate, capillary_refill, temperature, weight, pulse_rate, doctor_id, appointment_date, physical_examination, diagnosis, medication_treatment) VALUES ('$patient_case_no', '$patient_name', '$address', '$chief_complaint', '$mobile_no', '$history_of_present_illness', '$blood_pressure', '$respiratory_rate', '$capillary_refill', '$temperature', '$weight', '$pulse_rate', '$doctor_id', '$appointment_date', '$physical_examination', '$diagnosis', '$medication_treatment')";
    if ($qsql = mysqli_query($con, $sql)) {
        echo "<script>alert('Emergency room has been successfully created.');</script>";
        echo "<script>location.replace('admin_emergency_room.php');</script>";
    } else {
        echo mysqli_error($con);
    }
}
?>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Emergency Room</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Patient Information </h2>
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
                                            <label for="patient_case_no">Patient Case Number <code>*</code></label>
                                            <input type="text" class="form-control" id="patient_case_no" name="patient_case_no" placeholder="Patient Case Number" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="patient_name">Patient Name <code>*</code></label>
                                            <input type="text" class="form-control" id="patient_name" name="patient_name" placeholder="Patient Name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="address">Address <code>*</code></label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="chief_complaint">Chief Complaint <code>*</code></label>
                                            <input type="text" class="form-control" id="chief_complaint" name="chief_complaint" placeholder="Chief Complaint" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="mobile_no">Mobile No. <code>*</code></label>
                                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="history_of_present_illness">History of Present Illness <code>*</code></label>
                                            <input type="text" class="form-control" id="history_of_present_illness" name="history_of_present_illness" placeholder="History of Present Illness" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="header">
                                        <h2>Vital Signs </h2>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="blood_pressure">Blood Pressure <code>*</code></label>
                                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="respiratory_rate">Respiratory Rate <code>*</code></label>
                                            <input type="text" class="form-control" id="respiratory_rate" name="respiratory_rate" placeholder="Respiratory Rate" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="capillary_refill">Capillary Refill <code>*</code></label>
                                            <input type="text" class="form-control" id="capillary_refill" name="capillary_refill" placeholder="Capillary Refill" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="temperature">Temperature (°C)<code>*</code></label>
                                            <input type="text" class="form-control" id="temperature" name="temperature" placeholder="Temperature" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="weight">Weight (KG)<code>*</code></label>
                                            <input type="number" step="0.01" class="form-control" id="weight" name="weight" placeholder="Weight" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="pulse_rate">Pulse Rate <code>*</code></label>
                                            <input type="number" step="0.01" class="form-control" id="pulse_rate" name="pulse_rate" placeholder="Pulse Rate" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="doctor_id">Attending Physician <code>*</code></label>
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
                                            <label for="appointment_date">Date <code>(dd/mm/yyyy) *</code></label>
                                            <input type="date" class="form-control" id="appointment_date"
                                                   name="appointment_date" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="physical_examination">Physical Examination <code>*</code></label>
                                            <textarea name="physical_examination" id="physical_examination" class="form-control no-resize" placeholder="Physical Examination"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="diagnosis">Diagnosis <code>*</code></label>
                                            <textarea name="diagnosis" id="diagnosis" class="form-control no-resize" placeholder="Diagnosis"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="medication_treatment">Medication/Treatment <code>*</code></label>
                                            <textarea name="medication_treatment" id="medication_treatment" class="form-control no-resize" placeholder="Medication/Treatment" required></textarea>
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