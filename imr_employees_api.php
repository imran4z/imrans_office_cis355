<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>

<body background="https://newevolutiondesigns.com/images/freebies/white-wallpaper-24.jpg">
    <div class="container">
	<div style="margin-top: 3%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">	
	<br>
	  <h2>To Go Back</h2>
	  <p>Select a page from the dropdown menu.</P>
                                        
	  <div class="dropdown">
		<button class="btn btn-info" type="button" id="menu1" data-toggle="dropdown">Imran's Office Pages
		<span class="caret"></span></button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
		  <li role="presentation"><a role="menuitem" tabindex="-1" href="imr_office.html">Home</a></li>
		  <li role="presentation"><a role="menuitem" tabindex="-1" href="employee_list2.html">Employees</a></li>
		  <li role="presentation"><a role="menuitem" tabindex="-1" href="events_list.html">Events</a></li>
		  <li role="presentation"><a role="menuitem" tabindex="-1" href="assignments_list.html">Assignments</a></li>
		</ul>
	  </div>	
	</div>
</body>

<br>
<br>
<br>
<br>

<?php
session_start();
		if(!isset($_SESSION["e_id"])){ // if "user" not set,
		session_destroy();
		header('Location: login3.php');     // go to login page
	
	exit;
	}
	$sessionid = $_SESSION['e_id'];
/* ---------------------------------------------------------------------------
 * filename    : imr_employees_api.php
 * author      : Imran Khan
 * description : Returns JSON object of all the events in the events_list file
 * ---------------------------------------------------------------------------
 */
	include 'database.php';
	
	$pdo = Database::connect();
	if($_GET['id']) 
		$sql = "SELECT * from staff WHERE id=" . $_GET['id']; 
	else
		$sql = "SELECT * from staff";
	$arr = array();
	foreach ($pdo->query($sql) as $row) {
	
		array_push($arr, $row['fname'] . ", ". $row['title'] . ", ". $row['email'] . ", ". $row['filename'] . ", ". $row['filesize'] . ", ". $row['filetype' . ", ". $row['filecontent']]);
		
	}
	Database::disconnect();
	echo '{"employee_information":' . json_encode($arr) . '}';
?>
<br>
<br>