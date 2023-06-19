<?php
require_once ("../../include/initialize.php");
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
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
 
 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){


		if ($_POST['EmployeeID'] == "Select" OR $_POST['Position'] == "Select" OR $_POST['PartyList'] == ""
			OR $_POST['RunningDate'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
 
				$candidate = New Candidate(); 
				$candidate->EmployeeID 		= $_POST['EmployeeID'];
				$candidate->Position		= $_POST['Position']; 
				$candidate->PartyList		= $_POST['PartyList']; 
				$candidate->RunningDate	 	= date_format(date_create($_POST['RunningDate']),'Y-m-d');  
				$candidate->create();


				$emp = New Employee(); 
				$emp->Cand_Status 		= 'Candidate'; 
				$emp->update($_POST['EmployeeID']);

							// $autonum = New Autonumber();  `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
							// $autonum->auto_update(2);

				message("New Candidate created successfully!", "success");
				redirect("index.php"); 
		 }
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){

		if ($_POST['Position'] == "Select" OR $_POST['PartyList'] == ""
			OR $_POST['RunningDate'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
 
				$candidate = New Candidate(); 
				// $candidate->EmployeetID 		= $_POST['EmployeeID'];
				$candidate->Position		= $_POST['Position']; 
				$candidate->PartyList		= $_POST['PartyList']; 
				$candidate->RunningDate	 	= date_format(date_create($_POST['RunningDate']),'Y-m-d');  
				$candidate->update($_POST['CandidateID']);

							// $autonum = New Autonumber();  `SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`
							// $autonum->auto_update(2);

				message("Candidate has been updated!", "success");
				redirect("index.php"); 
		 }
 
		   
	}

} 

	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","error");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$candidate = New Candidate();
		// 	$candidate->delete($id[$i]);

		
		// 		// $id = 	$_GET['id'];

		// 		// $subj = New Employee();
	 // 		//  	$subj->delete($id);
			 
		
		// }
 
		
				$id = 	$_GET['canid'];

				$candidate = New Candidate();
				$candidate->delete($id);
			 
		 
				$emp = New Employee(); 
				$emp->Cand_Status 		= ''; 
				$emp->update($_GET['empid']);

			message("Candidate already Deleted!","success");
			redirect('index.php');
		// }

		
	}
 
 
?>