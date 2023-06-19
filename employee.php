<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE employees SET  ='$_POST[employeename]',mobileno='$_POST[mobilenumber]',address='$_POST[address]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',status='$_POST[select]',education='$_POST[education]',experience='$_POST[experience]' WHERE employeeid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('employee record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO employees (employeename,mobileno,address,departmentid,loginid,status,education,experience) values('$_POST[employeename]','$_POST[mobilenumber]','$_POST[address]','$_POST[select3]','$_POST[loginid]','Active','$_POST[education]','$_POST[experience]'";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Employee record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM employees WHERE employeeid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2> Add New Employee </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">


				<form method="post" action="" name="frmemp" onSubmit="return validateform()" style="padding: 10px">


					
					<div class="form-group"><label>Employee Name</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="employeename" id="employeename" value="<?php echo $rsedit[employeename]; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Mobile Number</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>"/>
				</div>
				</div>

				<div class="form-group"><label>Address</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="address" id="address" value="<?php echo $rsedit[address]; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Department</label> 
						<div class="form-line">
					<select  name="select3" id="select3" class="form-control show-tick">
						<option value="">Select</option>
						<?php
						$sqldepartment= "SELECT * FROM department WHERE status='Active'";
						$qsqldepartment = mysqli_query($con,$sqldepartment);
						while($rsdepartment=mysqli_fetch_array($qsqldepartment))
						{
							if($rsdepartment[departmentid] == $rsedit[departmentid])
							{
								echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
							}
							else
							{
								echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
							}

						}
						?>
					</select>
				</div>
			</div>

					<div class="form-group"><label>Login ID</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="loginid" id="loginid" value="<?php echo $rsedit[loginid]; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Education</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="education" id="education" value="<?php echo $rsedit[education]; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Experience</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="experience" id="experience" value="<?php echo $rsedit[experience]; ?>"/>
				</div>
				</div>


					
					<div class="form-group">
					<label>Status</label> 
					<div class="form-line">
					<select class="form-control show-tick" name="select" id="select">
						<option value="" selected="" hidden>Select</option>
						<?php
						$arr= array("Active","Inactive");
						foreach($arr as $val)
						{
							if($val == $rsedit[status])
							{
								echo "<option value='$val' selected>$val</option>";
							}
							else
							{
								echo "<option value='$val'>$val</option>";
							}
						}
						?>
					</select>
								</div>
							</div>                            

					<div class="col-sm-12">
					<input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" />
				
						</div>
					</div>



				</form>
			</div>
		</div>
	</div>
</div>
<?php include("adfooter.php"); ?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmemp.employeename.value == "")
	{
		alert("Employee name should not be empty..");
		document.frmemp.employeename.focus();
		return false;
	}
	else if(!document.frmemp.employeename.value.match(alphaspaceExp))
	{
		alert("Employee name not valid..");
		document.frmemp.employeename.focus();
		return false;
	}
	else if(document.frmemp.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmemp.mobilenumber.focus();
		return false;
	}
	else if(!document.frmemp.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmemp.mobilenumber.focus();
		return false;
	}
	if(document.frmemp.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmemp.address.focus();
		return false;
	}
	else if(!document.frmemp.address.value.match(alphaspaceExp))
	{
		alert("Address not valid..");
		document.frmemp.address.focus();
		return false;
	}
	else if(document.frmemp.select3.value == "")
	{
		alert("Department ID should not be empty..");
		document.frmemp.select3.focus();
		return false;
	}
	else if(document.frmemp.loginid.value == "")
	{
		alert("Loginid should not be empty..");
		document.frmemp.loginid.focus();
		return false;
	}
	else if(!document.frmemp.loginid.value.match(numericExpression))
	{
		alert("loginid not valid..");
		document.frmemp.loginid.focus();
		return false;
	}
	else if(document.frmemp.education.value == "")
	{
		alert("Education should not be empty..");
		document.frmemp.education.focus();
		return false;
	}
	else if(!document.frmemp.education.value.match(alphaExp))
	{
		alert("Education not valid..");
		document.frmemp.education.focus();
		return false;
	}
	else if(document.frmemp.experience.value == "")
	{
		alert("Experience should not be empty..");
		document.frmemp.experience.focus();
		return false;
	}
	else if(!document.frmemp.experience.value.match(numericExpression))
	{
		alert("Experience not valid..");
		document.frmemp.experience.focus();
		return false;
	}
	else if(document.frmemp.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmemp.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>