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
	
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: events_list.html");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM event where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<div style="margin-top: 5%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <h3>Imran's Office: Event Details</h3>        
    <p>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
    </p>
	<div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">event_name</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['event_name'];?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">event_date</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['event_date'];?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">event_time</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['event_time'];?>
                </label>
            </div>
        </div>
    </div>
    
	<div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">event_location</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['event_location'];?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">event_description</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['event_description'];?>
                </label>
            </div>
        </div>
    </div>
	
    <div class="form-actions">
        <a class="btn" href="events_list.html">Back</a>
    </div>    
</div>