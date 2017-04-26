<?php 
	session_start();
			if(!isset($_SESSION["e_id"])){ // if "user" not set,
			session_destroy();
			header('Location: login3.php');     // go to login page
		
		exit;
		}
		$sessionid = $_SESSION['e_id'];

	error_reporting(E_ALL);
	require 'database.php';
	// if values were passed, validate and insert
	if (isset($_POST['insert'])) {			
		// get values
        $id = $_POST['id'];
		$event_name = $_POST['event_name'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_location = $_POST['event_location'];
		$event_description = $_POST['event_description'];
        
		//echo "Id: ".$id;
		//echo "<br>name: ".$fullname;
		//echo "<br>employee_name: ". $employee_name;
		//echo "<br>Pass: ".$password_hash;
		
		$valid = true;
		if (empty($event_name) || empty($event_date) || empty($event_time) || empty($event_location)|| empty($event_description)) {
			$valid = false;
		} 
		echo "<br>Valid: ".$valid;
		// insert record
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO event (event_name, event_date, event_time, event_location, event_description) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($event_name, $event_date, $event_time, $event_location, $event_description));
			Database::disconnect();
		}
	}
?>