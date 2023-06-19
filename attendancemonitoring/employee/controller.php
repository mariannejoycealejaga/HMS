<?php
require_once ("../include/initialize.php");
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break; 
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

	case 'checkid' :
	Check_EmployeeID();
	break;
 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){


		if ($_POST['EmployeeID'] == "" OR $_POST['Firstname'] == "" OR $_POST['Lastname'] == ""
			OR $_POST['Middlename'] == "" OR $_POST['PositionID'] == "none"  OR $_POST['Address'] == "" 
			OR $_POST['ContactNo'] == "") {
			$messageStats = false;
			message("All fields are required!","error");
			redirect('index.php?view=add');
		}else{	

			$birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$age = date_diff(date_create($birthdate),date_create('today'))->y;

			if ($age < 15){
			message("Invalid age. 15 years old and above is allowed.", "error");
			redirect("index.php?view=add");

				}else{
					$emp = New Employee(); 
					$emp->EmployeeID 		= $_POST['EmployeeID'];
					$emp->Firstname			= $_POST['Firstname']; 
					$emp->Lastname			= $_POST['Lastname'];
					$emp->Middlename 	    = $_POST['Middlename'];
					$emp->PositionID		= $_POST['PositionID']; 
					$emp->Address			= $_POST['Address']; 
					$emp->BirthDate	 		= $birthdate;
					$emp->Age			    = $age;
					$emp->Gender 			= $_POST['optionsRadios']; 
					$emp->ContactNo			= $_POST['ContactNo'];
					$emp->EmployeeStatus	= $_POST['EmployeeStatus'];
					$emp->create();

								// $autonum = New Autonumber();  `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `POSITION_ID`, `AY`, `SEMESTER`
								// $autonum->auto_update(2);

					message("New employee created successfully!", "success");
					redirect("index.php");

				}
				
			}
		 }
		}


	function doEdit(){
	if(isset($_POST['save'])){

		if ($_POST['EmployeeID'] == "" OR $_POST['Firstname'] == "" OR $_POST['Lastname'] == ""
		OR $_POST['Middlename'] == "" OR $_POST['PositionID'] == "none"  OR $_POST['Address'] == "" 
		OR $_POST['ContactNo'] == "") {
			$messageStats = false;
			message("All fields are required!","error");
			redirect('index.php?view=add');
		}else{	

			$birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$age = date_diff(date_create($birthdate),date_create('today'))->y;
		 	if ($age < 15){
		       message("Invalid age. 15 years old and above is allowed.", "error");
		       redirect("index.php?view=view&id=".$_POST['EmployeeID']);

		    }else{

		  // echo  $_POST['optionsRadios']; 
		    	$emp = New Employee(); 
				$emp->EmployeeID 		= $_POST['IDNO'];
				$emp->Firstname			= $_POST['Firstname']; 
				$emp->Lastname			= $_POST['Lastname'];
				$emp->Middlename 	    = $_POST['Middlename'];
				$emp->PositionID		= $_POST['PositionID']; 
				$emp->Address			= $_POST['Address']; 
				// $emp->BirthDate	 	= date_format(date_create($_POST['BirthDate']),'Y-m-d');  
				$emp->BirthDate	 		= $birthdate;
				$emp->Age			    = $age;
				$emp->Gender 			= $_POST['optionsRadios']; 
				$emp->ContactNo			= $_POST['ContactNo'];
				$emp->EmployeeStatus	= $_POST['EmployeeStatus'];

				$emp->empupdate($_POST['EmployeeID']);

		 

				message("Employee has been updated!", "success");
				redirect("index.php?view=view&id=".$_POST['EmployeeID']);
	    	}


		}
  	
	 
	}

} 

	function doDelete(){
		
		if (isset($_POST['selector'])==''){
		message("Select the records first before you delete!","error");
		redirect('index.php');
		}else{

		$id = $_POST['selector'];
		$key = count($id);

		for($i=0;$i<$key;$i++){

			$subj = New Employee();
			$subj->delete($id[$i]);

		
				// $id = 	$_GET['id'];

				// $subj = New Employee();
	 		//  	$subj->delete($id);
			 
		
		}
			message("Employee(s) already Deleted!","success");
			redirect('index.php');
		}

		
	}
	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photo/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photo/" . $myfile);
		 	
					 

						$emp = New Employee();
						$emp->EmPhoto	= $location;
						$emp->empupdate($_POST['EmployeeID']);
						redirect("index.php?view=view&id=". $_POST['EmployeeID']);
						 
							
					}
			}
			 
		}

	function Check_EmployeeID(){

	  
		// $emp = New Employee();  
		// $res = $emp->single_EmployeeID($_POST['IDNO']);

		$sql = "SELECT * FROM tblemployee WHERE EmployeeID='" .$_POST['IDNO']. "'";
		$res = mysql_query($sql) or die(mysql_error());
		$maxrow = mysql_num_rows($res);
		if ($maxrow > 0) { 
			# code...
			echo "Employee ID already in use!"; 
		}
   

	}
 
?>