<?php
require_once(LIB_PATH.DS.'database.php');
class Employee {
	protected static  $tblname = "tblemployee";

	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	function listofemployee(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
		return $cur;
	}
	function find_employee($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE EmployeeID = {$id} OR Lastname = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}

	function find_all_employee($lname="",$Firstname="",$mname=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE Lastname = '{$lname}' AND Firstname= '{$Firstname}' AND MNAME='{$mname}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 
	function single_employee($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where EmployeeID= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	function select_employee($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where ID= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	function empAuthentication($U_USERNAME,$h_pass){
		global $mydb;
		$mydb->setQuery("SELECT * FROM `tblemployee` WHERE `EmployeeID`='".$U_USERNAME."'");
		$cur = $mydb->executeQuery();
		if($cur==false){
			die(mysql_error());
		}
		$row_count = $mydb->num_rows($cur);//get the number of count
		 if ($row_count == 1){
		 $employee_found = $mydb->loadSingleResult();
		 	$_SESSION['EmployeeID']   	= $employee_found->EmployeeID; 
		 	// $_SESSION['ACC_USERNAME'] 	= $employee_found->ACC_USERNAME;
		 	// $_SESSION['ACC_PASSWORD'] 	= $employee_found->ACC_PASSWORD; 
			$_SESSION['Firstname']		= $employee_found->Firstname; 
			$_SESSION['Lastname']		= $employee_found->Lastname; 
			$_SESSION['MI']				= $employee_found->Middlename; 
			$_SESSION['Address']		= $employee_found->Address;  
			$_SESSION['PositionCode']	= $employee_found->PositionCode;  
		   return true;
		 }else{
		 	return false;
		 }
	}

	 
	/*---Instantiation of Object dynamically---*/
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  global $mydb;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	echo $mydb->setQuery($sql);
	
	 if($mydb->executeQuery()) {
	    $this->id = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE EmployeeID=". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

   public function empupdate($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE ID=". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id=0) {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE EmployeeID=". $id;
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
?>