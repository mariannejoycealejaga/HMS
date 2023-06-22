<?php
include("adformheader.php");
include("dbconnection.php");
include("date_helper.php");
if (isset($_GET[delid])) {
    $sql = "DELETE FROM patient WHERE patientid='$_GET[delid]'";
    $qsql = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        echo "<script>alert('patient record deleted successfully..');</script>";
    }
}
?>
    <div class="container-fluid">
        <div class="block-header">
            <h2>View OPD records</h2>

        </div>

        <div class="card">
        <div > <a href='opd_print_records.php?editid=$rs[patientid]' class='btn btn-sm btn-raised g-bg-cyan'>Print OPD Records</a></div>

            <section >
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                    <tr>
                        <th width="15%" height="36">
                            <div align="center">Patient Name</div>
                        </th>
                        <th width="10%">
                            <div align="center">Consultation Date</div>
                        </th>
                        <th width="10%">
                            <div align="center">Diagnosis</div>
                        </th>
                        <th width="10%">
                            <div align="center">Address</div>
                        </th>
                        <th width="10%">
                            <div align="center">Contact No.</div>
                        </th>
                        <th width="10%">
                            <div align="center">Present Illness</div>
                        </th>
                        <th width="10%">
                            <div align="center">Physical Examination</div>
                        </th>
                        <th width="10%">
                            <div align="center">Medication Treatment</div>
                        </th>
                        
                        <!-- <th width="17%">
                            <div align="center">Action</div>
                        </th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT b.patientname, b.address, b.mobileno, a.appointment_date, a.diagnosis, a.history_of_present_illness, a.physical_examination, a.medication_treatment FROM emergency_room_patients a INNER JOIN patient b ON a.patient_case_no=b.patientid";
                    // $sql = "SELECT * FROM emergency_room_patients INNER JOIN patient ON patient.id=emergency_room_patients.patient_case_no WHERE patient.status='Active'";
                    $qsql = mysqli_query($con, $sql);
                    while ($rs = mysqli_fetch_array($qsql)) {
                        echo "<tr>
                        <td>$rs[patientname]</td>
                        <td>$rs[appointment_date]</td>
                        <td>$rs[diagnosis]</td>
                        <td>$rs[address]</td>
                        <td>$rs[mobileno]</td>
                        <td>$rs[history_of_present_illness]</td>
                        <td>$rs[physical_examination]</td>
                        <td>$rs[medication_treatment]</td>
        
        
        <td align='center'>";
                        if (isset($_SESSION[adminid])) {
                            echo "<a href='admin_emergency_room.php.php?id=$rs[id]' class='btn btn-sm btn-raised g-bg-cyan'>Edit</a>
                            <a href='admin_view_er_patients.php?id=$rs[id]' class='btn btn-sm btn-raised g-bg-blush2'>Delete</a>
                            <a href='admin_print_OPD.php?patientid=$rs[patientid]' class='btn btn-sm btn-raised'>Print Report</a>";
                        }
                        echo "</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </section>

        </div>
    </div>
<?php
include("adformfooter.php");
?>