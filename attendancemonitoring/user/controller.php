<?php
include("dbconnection.php");
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

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){

		if ($_POST['ACCOUNT_NAME'] == "" OR $_POST['ACCOUNT_USERNAME'] == "" OR $_POST['ACCOUNT_PASS'] == "") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	

			$sql = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='" .$_POST['ACCOUNT_USERNAME']."'";
			$result = mysql_query($sql) or die(mysql_error());
			$userresult = mysql_fetch_assoc($res);

			if ($userresult) {
				# code...
				message("Username is already taken.", "error");
				redirect('index.php?view=add');
			}else{

			$user = New User();
			// $user->USERID 		= $_POST['user_id'];
			$user->ACCOUNT_NAME 		= $_POST['ACCOUNT_NAME'];
			$user->ACCOUNT_USERNAME		= $_POST['ACCOUNT_USERNAME'];
			$user->ACCOUNT_PASSWORD		=sha1($_POST['ACCOUNT_PASS']);
			$user->ACCOUNT_TYPE			=  $_POST['ACCOUNT_ROLE'];
			$user->create();

						// $autonum = New Autonumber(); 
						// $autonum->auto_update(2);

			message("New [". $_POST['ACCOUNT_NAME'] ."] created successfully!", "success");
			redirect("index.php");

			} 
		}
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){
		// $sql = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='" .$_POST['U_USERNAME']."'";
		// 	$res = mysql_query($sql) or die(mysql_error());
		// 	$userresult = mysql_fetch_assoc($res);

		// 	if ($userresult) {
		// 		# code...
		// 		message("Username is already taken.", "error");
		// 		redirect('index.php?view=add');
		// 	}else{
		   $user = New User(); 
			$user->ACCOUNT_NAME 		= $_POST['ACCOUNT_NAME'];
			$user->ACCOUNT_USERNAME		= $_POST['ACCOUNT_USERNAME'];
			$user->ACCOUNT_PASSWORD		=sha1($_POST['ACCOUNT_PASS']);
			$user->ACCOUNT_TYPE			= $_POST['ACCOUNT_ROLE'];
			$user->update($_POST['USERID']);

			message("[". $_POST['ACCOUNT_NAME'] ."] has been updated!", "success");
			redirect("index.php");
			// }
 
			
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

		// 	$user = New User();
		// 	$user->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$user = New User();
	 		 	$user->delete($id);
			 
			message("User already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


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
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New User();
						$user->USERIMAGE 			= $location;
						$user->update($_SESSION['ACCOUNT_ID']);
						redirect("index.php?view=view&id=".$_SESSION['ACCOUNT_ID']);
						 
							
					}
			}
			 
		}
 
?>