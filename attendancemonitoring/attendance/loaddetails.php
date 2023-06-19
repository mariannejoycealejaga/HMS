<?php
 require_once ("../include/initialize.php");

 $employeeID   = $_POST['IDNO'];
 // $I

 
if (isset($_POST['checkattendance'])) {
 	# code...  
 	  
 	$timestring = $_POST['stringtime'];
 	$dateObject = new DateTime($timestring);
    $resDate =  $dateObject->format('A');

    $insertTime =  date('h:i A',strtotime($timestring));


 
    if ($resDate=='AM') {
    	# code...  

    	$validate_verifytimeintimeout_table = validate_verifytimeintimeout($employeeID);

    	if ($validate_verifytimeintimeout_table==true) {
    		# code...

    		 $verifytimeintimeout = new VerifyTimeinTimeout();
    		 $row_verify  = $verifytimeintimeout->single_verifytimeintimeout($employeeID);


    		 $vefication = $row_verify->Verification; 

    		 // echo $vefication;  
				switch ($vefication) {
		   			case 'TimeIn': 
		   				# code... 
		   			       TIMEOUT_VERIFY_UPDATE($employeeID,$insertTime);

		   			       $r = validate_timetable($employeeID,Date('Y-m-d')); 
						   if ($r == true) {
						   	# code...
						   	// echo "true";
						   		TIMETABLEUPDATE_TIMEOUT_AM($employeeID,$insertTime);

						   }else{
						   	// echo "false"; 
								TIMETABLE_TIMEIN_AM_INSERT($employeeID,$insertTime);
						   } 
		   				break;
		   			case 'TimeOut': 

 						  
		   				# code... 
		   				  TIMEIN_VERIFY_UPDATE($employeeID,$insertTime);

		   				   $r = validate_timetable($employeeID,Date('Y-m-d')); 
						   if ($r == true) {
						   	# code...
						   	// echo "true";
						   		TIMETABLE_TIMEIN_AM_INSERT($employeeID,$insertTime);

						   }else{
						   	// echo "false"; 
								TIMETABLE_TIMEIN_AM_INSERT($employeeID,$insertTime);
						   }

		   				break;
		   			 
		   		}

    			  
    	}else{

 			
    		 TIMEIN_VERIFY_INSERT($employeeID,$insertTime);

             TIMETABLE_TIMEIN_AM_INSERT($employeeID,$insertTime);


    	}

	   
 
    }else if ($resDate=='PM') {
    	# code...

    	$validate_verifytimeintimeout_table = validate_verifytimeintimeout($employeeID);

    	if ($validate_verifytimeintimeout_table==true) {
    		# code...

    		 $verifytimeintimeout = new VerifyTimeinTimeout();
    		 $row_verify  = $verifytimeintimeout->single_verifytimeintimeout($employeeID);
    		 $vefication = $row_verify->Verification; 


				switch ($vefication) {
		   			case 'TimeIn': 
		   				# code... 

		   			       TIMEOUT_VERIFY_UPDATE($employeeID,$insertTime);

		   			       $r = validate_timetable($employeeID,Date('Y-m-d')); 
						   if ($r == true) {
						   	# code...
						   	// echo "true";
						   		// if (e) {
						   		// 	# code...
						   		// }
						   		TIMETABLEUPDATE_TIMEOUT_PM($employeeID,$insertTime);

						   }else{
						   	// echo "false"; 
								TIMETABLE_TIMEIN_PM_INSERT($employeeID,$insertTime);
						   } 
		   				break;
		   			case 'TimeOut': 

 					    
		   				# code... 
		   				  TIMEIN_VERIFY_UPDATE($employeeID,$insertTime);

		   				   $r = validate_timetable($employeeID,Date('Y-m-d')); 
						   if ($r == true) {
						   	# code...
						   	// echo "true";
						   		// TIMETABLE_TIMEIN_PM_($employeeID,$insertTime);
						   		TIMETABLEUPDATE_TIMEIN_PM($employeeID,$insertTime);

						   }else{
						   	// echo "false"; 
								TIMETABLE_TIMEIN_PM_INSERT($employeeID,$insertTime);
						   }

		   				break;
		   			 
		   		}

    			  
    	}else{
 
    		 TIMEIN_VERIFY_INSERT($employeeID,$insertTime);

             TIMETABLE_TIMEIN_PM_INSERT($employeeID,$insertTime);


    	}

    }

 
 }

if (isset($_POST['name'])) {
 	# code...
 	$sql = "SELECT * FROM `tblemployee`  e, `tblposition` p WHERE e.`PositionID`=p.`PositionID` AND EmployeeID='".$employeeID."'";
 	$mydb->setQuery($sql);
    @$cur = $mydb->loadSingleResult();

    echo @$cur->Lastname . ', ' .@$cur->Firstname ;
 }

  if (isset($_POST['position'])) {
 	# code...
 	$sql = "SELECT * FROM `tblemployee`  e, `tblposition` p WHERE e.`PositionID`=p.`PositionID` AND EmployeeID='".$employeeID."'";
 	$mydb->setQuery($sql);
    @$cur = $mydb->loadSingleResult();

    echo @$cur->Description ;
 }

 if (isset($_POST['EmployeeStatus'])) {
 	# code...
 	$sql = "SELECT * FROM `tblemployee`  e, `tblposition` p WHERE e.`PositionID`=p.`PositionID` AND EmployeeID='".$employeeID."'";
 	$mydb->setQuery($sql);
    @$cur = $mydb->loadSingleResult();

    echo @$cur->EmployeeStatus;
 }

  if (isset($_POST['img'])) {
 	# code...
 	$sql = "SELECT * FROM `tblemployee`  e, `tblposition`p WHERE e.`PositionID`=p.`PositionID` AND EmployeeID='".$employeeID."'";
 	$mydb->setQuery($sql);
    @$cur = $mydb->loadSingleResult();

    echo '<img title="profile image" id="imgprofile" class="img-hover"   src="'.web_root. 'employee/'.  @$cur->EmPhoto.'" />' ;
 }

// $Attendance_message = '<h2>Attendance Checked</h2>';
 

 function TIMEIN_VERIFY_INSERT($id,$time){
 	 if (employee_notexist($id)) return;
 	$verifytimeintimeout = New VerifyTimeinTimeout();
 	$verifytimeintimeout->EmployeeID = $id;
 	$verifytimeintimeout->TimeIn = $time;
 	$verifytimeintimeout->Verification = 'TimeIn';
 	$verifytimeintimeout->DateValidation = Date('Y-m-d');
 	$verifytimeintimeout->create();

 }

 function TIMEIN_VERIFY_UPDATE($id,$time){

 	$verifytimeintimeout = New VerifyTimeinTimeout(); 
 	$verifytimeintimeout->Verification = 'TimeIn';
 	$verifytimeintimeout->TimeIn = $time;
 	$verifytimeintimeout->DateValidation = Date('Y-m-d');
 	$verifytimeintimeout->update($id);
 	
 }

 function TIMEOUT_VERIFY_UPDATE($id,$time){

   if (validate_time_interval2($id,'TimeIn',$time)) return;

 	$verifytimeintimeout = New VerifyTimeinTimeout(); 
 	$verifytimeintimeout->TimeOut = $time;
 	$verifytimeintimeout->Verification = 'TimeOut';
 	$verifytimeintimeout->DateValidation = Date('Y-m-d');
 	$verifytimeintimeout->update($id);
 }

// `EmployeeID`, `TimeInAM`, `TimeOutAM`, `TimeInPM`, `TimeOutPM`, `AttendDate`
function TIMETABLE_TIMEIN_AM_INSERT($id,$time){
  if (employee_notexist1($id)) return;
	$timetable = New TimeTable();
	$timetable->EmployeeID = $id;
	$timetable->TimeInAM =  $time;
	$timetable->AttendDate = Date('Y-m-d'); 
	$timetable->create();  
	attendance_message();
	echo "<h2>Time-In : {$time}</h2>";
}

function TIMETABLE_TIMEIN_PM_INSERT($id,$time){
   if (employee_notexist1($id)) return;
	$timetable = New TimeTable();
	$timetable->EmployeeID = $id;
	$timetable->TimeInPM =  $time;
	$timetable->AttendDate = Date('Y-m-d'); 
	$timetable->create();
	attendance_message(); 
	echo "<h2>Time-In : {$time}</h2>";

}
 
function TIMETABLEUPDATE_TIMEIN_AM($id,$time){
	global $mydb;
 	if(time_exists($id,date('Y-m-d'),'TimeInAM')) return;
	$sql = "UPDATE `tbltimetable` SET `TimeInAM`= '{$time}' WHERE DATE(`AttendDate`) = '".Date('Y-m-d')."' AND `EmployeeID`='" .$id. "'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
    attendance_message();
	echo "<h2>Time-In : {$time}</h2>"; 
}

function TIMETABLEUPDATE_TIMEOUT_AM($id,$time){
	global $mydb;
 
	if(time_exists($id,date('Y-m-d'),'TimeOutAM')) return;

    if (validate_time_interval($id,date('Y-m-d'),'TimeInAM',$time)) return;

	$sql = "UPDATE `tbltimetable` SET `TimeOutAM`= '{$time}' WHERE DATE(`AttendDate`) = '".Date('Y-m-d')."' AND `EmployeeID`='" .$id. "'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
    attendance_message();
	echo "<h2>Time-Out : {$time}</h2>";
}
  
function TIMETABLEUPDATE_TIMEIN_PM($id,$time){
global $mydb;
     
	if(time_exists($id,date('Y-m-d'),'TimeInPM')) return; 

	$sql = "UPDATE `tbltimetable` SET `TimeInPM`= '{$time}' WHERE DATE(`AttendDate`) = '".Date('Y-m-d')."' AND `EmployeeID`='" .$id. "'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	attendance_message();
	echo "<h2>Time-iN : {$time}</h2>";

}
function TIMETABLEUPDATE_TIMEOUT_PM($id,$time){
global $mydb;
 	
 	if(time_exists($id,date('Y-m-d'),'TimeOutPM')) return;

 	if (validate_time_interval($id,date('Y-m-d'),'TimeInPM',$time)) return;

	$sql = "UPDATE `tbltimetable` SET `TimeOutPM`= '{$time}' WHERE DATE(`AttendDate`) = '".Date('Y-m-d')."' AND `EmployeeID`='" .$id. "'";
	$mydb->setQuery($sql);
	$mydb->executeQuery();
	attendance_message();
	echo "<h2>Time-Out : {$time}</h2>";
 }

 function validate_timetable($id,$date){
 	global $mydb;

 	$sql ="SELECT * FROM `tbltimetable` WHERE  `EmployeeID`='{$id}' AND  date(`AttendDate`)='{$date}'";
 	$mydb->setQuery($sql);
	$result = $mydb->executeQuery();  
 	 $maxrow = $mydb->num_rows($result);

 	 if ($maxrow > 0) {
 	 	# code...
 	 	$time_table_validate = $mydb->loadSingleResult();
 	 	return true;
 	 }else{
 	 	return false;
 	 } 
 }

  function validate_verifytimeintimeout($id){
  	global $mydb;
 	$sql ="SELECT * FROM `tblverifytimeintimeout` WHERE  `EmployeeID`='{$id}'";
 	$mydb->setQuery($sql);
	$result = $mydb->executeQuery();  
 	 $maxrow = $mydb->num_rows($result);
 	 if ($maxrow > 0) {
 	 	# code...
 		$rowverifytimeintimeout = $mydb->loadSingleResult();
 	 	return true;
 	 }else{
 	 	return false;
 	 } 
 }
 

 function time_exists($id,$date,$tfield){ 
 	global $mydb;
 	$sql ="SELECT * FROM `tbltimetable` WHERE  `EmployeeID`='{$id}' AND  date(`AttendDate`)='{$date}'";
 	$mydb->setQuery($sql);
	$result = $mydb->executeQuery();  
 	 $max = $mydb->num_rows($result);
 	$row = $mydb->loadSingleResult();
    $flag=0;
    for($i=0;$i<$max;$i++){
      if($row->$tfield!=''){
        $flag=1; 
        echo "Attendance is already checked.";
        break;
      }
    }
    return $flag;
  }

  function validate_time_interval($id,$date,$tfield,$time_now){
  	global $mydb;
   

  	$sql ="SELECT * FROM `tbltimetable`  WHERE  `EmployeeID`='{$id}' AND  date(`AttendDate`)='{$date}'";
 	$mydb->setQuery($sql); 
 	$row = $mydb->loadSingleResult();
 
 	 $tfrom= time_from($row->$tfield);
     $tto = time_to($time_now);
               
     $tinterval = round(abs($tto  - $tfrom) / 60 ,2);

	    $flag=0;
	    for($i=0;$i<$max;$i++){
	    	
	      if($tinterval < 16){
	        $flag=1;
	        echo "Attendance is already checked.";
	        break;
	      }
     }
    return $flag;

  }

  function validate_time_interval2($id,$tfield,$time_now){ 
global $mydb;

  	$sql ="SELECT * FROM `tblverifytimeintimeout`  WHERE  `EmployeeID`='{$id}'";
 	$mydb->setQuery($sql);
	$result = $mydb->executeQuery();  
 	 $max = $mydb->num_rows($result);
 	$row = $mydb->loadSingleResult();

 	 $tfrom= time_from($row->$tfield);
     $tto = time_to($time_now);
               
     $tinterval = round(abs($tto  - $tfrom) / 60 ,2);

	    $flag=0;
	    for($i=0;$i<$max;$i++){
	 
	      if($tinterval < 16){
	        $flag=1; 
	        break;
	      }


     }
    return $flag;

  }

   function employee_notexist($id){ 
   	global $mydb;

		$sql ="SELECT * FROM `tblemployee`  WHERE  `EmployeeID`='{$id}'";
		$mydb->setQuery($sql);
		$result = $mydb->executeQuery();  
		$max = $mydb->num_rows($result);
	    $flag=0; 
	 
	      if($max < 1){
	        $flag=1; 
	        echo "ID is not registered in the system";
	      } 
    return $flag;

  }
   function employee_notexist1($id){ 
global $mydb;

		$sql ="SELECT * FROM `tblemployee`  WHERE  `EmployeeID`='{$id}'";
		$mydb->setQuery($sql);
		$result = $mydb->executeQuery();  
		$max = $mydb->num_rows($result);

	    $flag=0; 
	 
	      if($max < 1){
	        $flag=1;  
	      } 
    return $flag;

  }

 function time_from($time){ 
		$dateObject = new DateTime($time);
		$resHr =  $dateObject->format('H:i'); 
	      return  strtotime($resHr);  
 }
  function time_to($time){
  		$dateObject = new DateTime($time);
		$resHr  =  $dateObject->format('H:i'); 
	    return  strtotime($resHr); 
  }

  function attendance_message(){
     echo "<h2>Attendance Checked</h2>"; 
  }

 

 ?>