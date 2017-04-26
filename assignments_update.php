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
	
    $ID = null;
	if (!empty($_GET['ID'])) { 
        $ID = $_REQUEST['ID']; 
    }
	
	// if data was entered by the user
	if (isset($_POST['update'])) {
		// get values
        $ID = $_POST['ID'];
		$assignment = $_POST['assignment'];
		$employee_name = $_POST['employee_name'];
		$status = $_POST['status'];
		$manager_review = $_POST['manager_review'];
		$comments = $_POST['comments'];

				
		$valid = true;
		if (empty($assignment) || empty($employee_name) || empty($status) || empty($manager_review) || empty($comments)) {
			$valid = false; }

		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE assignments  set assignment = ?, employee_name = ?, status = ?, manager_review = ?, comments = ? WHERE ID = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($assignment,$employee_name,$status,$manager_review,$comments,$ID));
			Database::disconnect();
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT assignment,employee_name,status,manager_review,comments FROM assignments where ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($ID));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$assignment = $data['assignment'];
		$employee_name = $data['employee_name'];
		$status = $data['status'];
		$manager_review = $data['manager_review'];
		$comments = $data['comments'];
		Database::disconnect();
	}
?>

<h3>Imran's Office: Update an Event</h3>
<p><a href="imr_office.html" class="btn btn-primary">Home</a></p>
<div class="control-group">
    <label class="control-label">assignment</label>
    <div class="controls">
        <input ID="assignment" type="text"  placeholder="assignment" value="<?php echo !empty($assignment)?$assignment:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">employee_name</label>
    <div class="controls">
        <input ID="employee_name" type="text"  placeholder="employee_name" value="<?php echo !empty($employee_name)?$employee_name:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">status</label>
    <div class="controls">
        <input ID="status" type="text"  placeholder="status" value="<?php echo !empty($status)?$status:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">manager_review</label>
    <div class="controls">
        <input ID="manager_review" type="text"  placeholder="manager_review" value="<?php echo !empty($manager_review)?$manager_review:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">comments</label>
    <div class="controls">
        <input ID="comments" type="text"  placeholder="comments" value="<?php echo !empty($comments)?$comments:'';?>" required>
    </div>
</div>
