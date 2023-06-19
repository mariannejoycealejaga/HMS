<?php
require_once ("../include/initialize.php");
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

	case 'photos' :
	doupdateimage();
	break;

 
	}
 
	function doInsert(){
		if(isset($_POST['save'])){
			
  		if ($_POST['POSITION_NAME'] == ""  OR $_POST['POSITION_DESC'] == "" OR $_POST['DEPT_ID'] == "none") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$position = New Position();
			// $position->USERID 			= $_POST['user_id'];
			$position->PositionCode 		= $_POST['POSITION_NAME']; 
			$position->Description			= $_POST['POSITION_DESC']; 
			$position->departmentid			= $_POST['DEPT_ID'];
			$position->create();

						// $autonum = New Autonumber(); 
						// $autonum->auto_update(2);

			message("New [". $_POST['POSITION_NAME'] ."] created successfully!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){

			$position = New Position(); 
			$position->PositionCode 	= $_POST['POSITION_NAME']; 
			$position->Description		= $_POST['POSITION_DESC']; 
			$position->departmentid		= $_POST['DEPT_ID'];
			$position->update($_POST['POSITION_ID']);

			  message("[". $_POST['POSITION_NAME'] ."] has been updated!", "success");
			redirect("index.php");
		}
	}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$position = New User();
		// 	$cposition->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$position = New Position();
	 		 	$position->delete($id);
			 
			message("Position already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	 
?>