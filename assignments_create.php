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
		$assignment = $_POST['assignment'];
		$employee_name = $_POST['employee_name'];
		$status = $_POST['status'];
		$manager_review = $_POST['manager_review'];
		$comments = $_POST['comments'];
        
		//echo "Id: ".$id;
		//echo "<br>name: ".$fullname;
		//echo "<br>employee_name: ". $employee_name;
		//echo "<br>Pass: ".$password_hash;
		
		$valid = true;
		if (empty($assignment) || empty($employee_name) || empty($status) || empty($manager_review)|| empty($comments)) {
			$valid = false;
		} 
		echo "<br>Valid: ".$valid;
		// insert record
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO assignments (assignment, employee_name, status, manager_review, comments) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($assignment, $employee_name, $status, $manager_review, $comments));
			Database::disconnect();
		}
	}
?>