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
		$event_name = $_POST['event_name'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_location = $_POST['event_location'];
		$event_description = $_POST['event_description'];

				
		$valid = true;
		if (empty($event_name) || empty($event_date) || empty($event_time) || empty($event_location) || empty($event_description)) {
			$valid = false; }

		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE event  set event_name = ?, event_date = ?, event_time = ?, event_location = ?, event_description = ? WHERE ID = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($event_name,$event_date,$event_time,$event_location,$event_description,$ID));
			Database::disconnect();
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT event_name,event_date,event_time,event_location,event_description FROM event where ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($ID));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$event_name = $data['event_name'];
		$event_date = $data['event_date'];
		$event_time = $data['event_time'];
		$event_location = $data['event_location'];
		$event_description = $data['event_description'];
		Database::disconnect();
	}
?>

<h3>Imran's Office: Update an Event</h3>
<p><a href="imr_office.html" class="btn btn-primary">Home</a></p>
<div class="control-group">
    <label class="control-label">event_name</label>
    <div class="controls">
        <input ID="event_name" type="text"  placeholder="event_name" value="<?php echo !empty($event_name)?$event_name:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">event_date</label>
    <div class="controls">
        <input ID="event_date" type="text"  placeholder="event_date" value="<?php echo !empty($event_date)?$event_date:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">event_time</label>
    <div class="controls">
        <input ID="event_time" type="text"  placeholder="event_time" value="<?php echo !empty($event_time)?$event_time:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">event_location</label>
    <div class="controls">
        <input ID="event_location" type="text"  placeholder="event_location" value="<?php echo !empty($event_location)?$event_location:'';?>" required>
    </div>
</div>
<div class="control-group">
    <label class="control-label">event_description</label>
    <div class="controls">
        <input ID="event_description" type="text"  placeholder="event_description" value="<?php echo !empty($event_description)?$event_description:'';?>" required>
    </div>
</div>
