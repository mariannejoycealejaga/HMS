<?php
include("adheader.php");
include("dbconnection.php");

$current_record_id = intval($_GET['id']);

$sql = "SELECT b.patientname, a.*, c.doctorname FROM emergency_room_patients a INNER JOIN patient b ON a.patient_case_no = b.patientid INNER JOIN doctor c ON c.doctorid=a.doctor_id WHERE a.id = $current_record_id";
$qsql = mysqli_query($con, $sql);
$info = mysqli_fetch_array($qsql);


$sqldoctor = "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid  WHERE doctor.status='Active'";
$qsqldoctor = mysqli_query($con, $sqldoctor);
$doctors = [];
while ($rsdoctor = mysqli_fetch_array($qsqldoctor)) {
    array_push($doctors, $rsdoctor);
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $chief_complaint = $_POST['chief_complaint'];
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
    $sql = "UPDATE emergency_room_patients SET chief_complaint='$chief_complaint', history_of_present_illness='$history_of_present_illness', blood_pressure='$blood_pressure', respiratory_rate='$respiratory_rate', capillary_refill='$capillary_refill', temperature='$temperature', weight='weight', pulse_rate='$pulse_rate', doctor_id='$doctor_id', appointment_date='$appointment_date', physical_examination='$physical_examination', diagnosis='$diagnosis', medication_treatment='$medication_treatment' WHERE id = $current_record_id";
    if ($qsql = mysqli_query($con, $sql)) {
        echo "<script>alert('Emergency room has been successfully updated!.');</script>";
        echo "<script>location.replace('admin_view_er_patients.php');</script>";
    } else {
        echo mysqli_error($con);
    }
}
?>
    <div class="container-fluid">
        <div class="block-header">
            <h2>Edit Patient Records</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo $info['patientname']?> Patient Information </h2>
                    </div>
                    <form method="post">">
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
                                            <label for="chief_complaint">Chief Complaint <code>*</code></label>
                                            <input type="text" class="form-control" id="chief_complaint" name="chief_complaint" placeholder="Chief Complaint" value="<?php echo $info['chief_complaint'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="history_of_present_illness">History of Present Illness <code>*</code></label>
                                            <input type="text" class="form-control" id="history_of_present_illness" name="history_of_present_illness" placeholder="History of Present Illness" value="<?php echo $info['history_of_present_illness'] ?>" required>
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
                                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" value="<?php echo $info['blood_pressure'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="respiratory_rate">Respiratory Rate <code>*</code></label>
                                            <input type="text" class="form-control" id="respiratory_rate" name="respiratory_rate" placeholder="Respiratory Rate" value="<?php echo $info['respiratory_rate'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="capillary_refill">Capillary Refill <code>*</code></label>
                                            <input type="text" class="form-control" id="capillary_refill" name="capillary_refill" placeholder="Capillary Refill" value="<?php echo $info['capillary_refill'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="temperature">Temperature (°C)<code>*</code></label>
                                            <input type="text" class="form-control" id="temperature" name="temperature" placeholder="Temperature" value="<?php echo $info['temperature'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="weight">Weight (KG)<code>*</code></label>
                                            <input type="number" step="0.01" class="form-control" id="weight" name="weight" placeholder="Weight" value="<?php echo $info['weight'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="pulse_rate">Pulse Rate <code>*</code></label>
                                            <input type="number" step="0.01" class="form-control" id="pulse_rate" name="pulse_rate" placeholder="Pulse Rate" value="<?php echo $info['pulse_rate'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="doctor_id">Attending Physician <code>*</code></label>
                                            <select name="doctor_id" id="doctor_id" class="form-control show-tick" required>
                                                <option value="<?php echo "$info[doctor_id]" ?>" selected>Select Value</option>
                                                <?php
                                                $sqldoctor = "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
                                                $qsqldoctor = mysqli_query($con, $sqldoctor);
                                                foreach ($doctors as $doctor) {
                                                        echo "<option value='$doctor[doctorid]'>$doctor[doctorname] ( $doctor[departmentname] )</option>";
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
                                            <textarea name="physical_examination" id="physical_examination" class="form-control no-resize" placeholder="Physical Examination"><?php echo $info['physical_examination'] ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="diagnosis">Diagnosis <code>*</code></label>
                                            <textarea name="diagnosis" id="diagnosis" class="form-control no-resize" placeholder="Diagnosis"><?php echo $info['diagnosis'] ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="medication_treatment">Medication/Treatment <code>*</code></label>
                                            <textarea name="medication_treatment" id="medication_treatment" class="form-control no-resize" placeholder="Medication/Treatment"  required><?php echo $info['medication_treatment'] ?></textarea>
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