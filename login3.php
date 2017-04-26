<?php
// Start or resume session, and create: $_SESSION[] array
session_start(); 
require 'database.php';
if ( !empty($_POST)) { // if $_POST filled then process the form
	// initialize $_POST variables
	$username = $_POST['username']; // username is email address
	$password = $_POST['password'];
	$passwordhash = MD5($password);
	// echo $password . " " . $passwordhash; exit();
	// robot 87b7cb79481f317bde90c116cf36084b
		
	// verify the username/password
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM staff WHERE email = ? AND password = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($username,$passwordhash));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	if($data) { // if successful login set session variables
		echo "success!";
		$_SESSION['e_id'] = $data['id'];
		$sessionid = $data['id'];
		Database::disconnect();
		header("Location: employee_list2.html?id=$sessionid ");
		// javascript below is necessary for system to work on github
		//echo "<script type='text/javascript'> document.location = 'employee_list2.html'; </script>";
		//exit();
	}
	else { // otherwise go to login error page
		Database::disconnect();
		header("Location: login_error.html");
	}
} 
// if $_POST NOT filled then display login form, below.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body background="https://newevolutiondesigns.com/images/freebies/white-wallpaper-24.jpg">
    <div class="container">

		<div class="span10 offset1">
			
			<div class="row">
				<h3>Employee Login</h3>
			</div>

			<form class="form-horizontal" action="login3.php" method="post">
								  
				<div class="control-group">
					<label class="control-label">Username (Email)</label>
					<div class="controls">
						<input name="username" type="text"  placeholder="me@email.com" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="password" required> 
					</div>	
				</div> 

				<div >
					<button type="submit" class="btn btn-success">Sign In</button>
					&nbsp; &nbsp;
					<a class="btn btn-primary" href="e_create.php">Add New Employee</a>
				</div>
				
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>