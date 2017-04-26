<?php 
	session_start();
		if(!isset($_SESSION["e_id"])){ // if "user" not set,
		session_destroy();
		header('Location: login3.php');     // go to login page
	
	exit;
	}
	$sessionid = $_SESSION['e_id'];
	
	require 'database.php';
	
    $id = null;
	if (!empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
    
	// if data was entered by the user
	if (isset($_POST['update'])) {	
		// get values
        $id = $_POST['id'];
		$fname = $_POST['fname'];
		$title = $_POST['title'];
		//$password_hash = $_POST['password_hash'];
		
		$valid = true;
		if (empty($fname) || empty($title)) {
			$valid = false;
		} 
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE staff  set fname = ?, title = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			//$password_hash = MD5($password_hash);
			$q->execute(array($fname,$title,$id));
			Database::disconnect();
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// do not select * because we do not want the server to SEND password
		$sql = "SELECT id,fname,title FROM staff where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$fname = $data['fname'];
		$title = $data['title'];
		//$password_hash = $data['password_hash'];
		Database::disconnect();
	}
?>

<h3>Imran's Office: Update Employee p</h3>
<p><a href="imr_office.html" class="btn btn-primary">Home</a></p>
<div class="control-group">
    <label class="control-label">Full Name</label>
    <div class="controls">
        <input id="fname" type="text"  placeholder="fullname" value="<?php echo !empty($fname)?$fname:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">Title</label>
    <div class="controls">
        <input id="title" type="text"  placeholder="title" value="<?php echo !empty($title)?$title:'';?>" required>
    </div>
</div>
