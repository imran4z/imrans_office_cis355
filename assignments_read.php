<?php 

session_start();
		if(!isset($_SESSION["e_id"])){ // if "user" not set,
		session_destroy();
		header('Location: login3.php');     // go to login page
	
	exit;
	}
	$sessionid = $_SESSION['e_id'];\

error_reporting(E_ALL);
	require 'database.php';
	
    $id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: assignments_list.html");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM assignments where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<div style="margin-top: 5%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <h3>Imran's Office: Assignments Details</h3>
    <p>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
    </p>
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">assignment</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['assignment']; ?>
                </label>
            </div>
        </div>
    </div>
	
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">employee_name</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['employee_name']; ?>
                </label>
            </div>
        </div>
    </div>
	
	<div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">status</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['status']; ?>
                </label>
            </div>
        </div>
    </div>
	
	<div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">manager_review</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['manager_review']; ?>
                </label>
            </div>
        </div>
    </div>
	
	<div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">comments</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['comments']; ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a class="btn" href="assignments_list.html">Back</a>
    </div>
</div>