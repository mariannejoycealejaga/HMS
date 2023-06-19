<?php

include("header.php");
include("dbconnection.php");
?>

<!-- Content -->
<div id="content">

    <!-- Intro -->
    <section class="p-t-b-150">
        <div class="container">
            <div class="intro-main">
                <div class="row">

<div class="container-fluid">
	<div class="block-header">
		<h2>Patient Record Table</h2><br><br><br><br>
	</div>

<div class="card">
	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">

			<thead>
				<tr>

					<td><strong>Patient detail</td>
					<td><strong>Registration Date &  Time</td>
					<td><strong>Address</td>
					<td><strong>Contact No.</td>
					<td><strong>Department</td>
					<td><strong>Doctor</td>
					<td><strong>Appointment Reason</td>
					<td><strong>Status</td>
					<td><strong><div align="center">Action</div></td>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql ="SELECT * FROM appointment WHERE (status='Approved' OR status='Active')";
				if(isset($_SESSION[patientid]))
				{
					$sql  = $sql . " AND patientid='$_SESSION[patientid]'";
				}
				if(isset($_SESSION[doctorid]))
				{
					$sql  = $sql . " AND doctorid='$_SESSION[doctorid]'";			
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
					$qsqlpat = mysqli_query($con,$sqlpat);
					$rspat = mysqli_fetch_array($qsqlpat);


					$sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
					$qsqldept = mysqli_query($con,$sqldept);
					$rsdept = mysqli_fetch_array($qsqldept);

					$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
					$qsqldoc = mysqli_query($con,$sqldoc);
					$rsdoc = mysqli_fetch_array($qsqldoc);
					echo "<tr>

					<td>&nbsp;$rspat[patientname]</td>		 
					<td>&nbsp;$rs[appointmentdate]&nbsp;$rs[appointmenttime]</td> 
          <td>&nbsp;$rspat[address]</td>
          <td>&nbsp;$rspat[mobileno]</td>
					<td>&nbsp;$rsdept[departmentname]</td>
					<td>&nbsp;$rsdoc[doctorname]</td>
					<td>&nbsp;$rs[app_reason]</td>
					<td>&nbsp;$rs[status]</td>
					<td><div align='center'>";
					if($rs[status] != "Approved")
					{
						if(!(isset($_SESSION[patientid])))
						{
							echo "<a href='appointmentapproval.php?editid=$rs[appointmentid]' class='btn btn-raised g-bg-cyan>Approve</a><hr>";
						}
						echo "  <a href='viewappointment.php?delid=$rs[appointmentid]' class='btn btn-raised g-bg-blush2'>Delete</a>";
					}
					else
					{
						echo "<a style='margin-left:5px;' class='btn btn-raised' href='patientreport.php?patientid=$rs[patientid]&appointmentid=$rs[appointmentid]'>View </a>";
            echo "<a style='margin-left:5px; background-color:red; color: white; padding: 14px 48px;' href='editpatientreport.php?patientid=$rs[patientid]&appointmentid=$rs[appointmentid]'>Edit</a>";
          }

					echo "</center></td></tr>";
				}
				?>
			</tbody>
		</table>
	</section>

  </div>
    </div>
</div>
</section>
</div>



<?php
include("footer.php");
?>
