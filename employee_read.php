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
		header("Location: employee_list2.html");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM staff where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<div style="margin-top: 5%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <h3>Imran's Office: Employee Details</h3>
    <p>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
    </p>
	
	<div>
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $data['filecontent'] ).'"/>'; 
		?>
	</div>
	
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">Full Name</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['fname']; ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['title']; ?>
                </label>
            </div>
        </div>
    </div>
	<div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['email']; ?>
                </label>
            </div>
        </div>
    </div>
	<div class="form-horizontal" >
        <div class="control-group">
            <label class="control-label">Filename</label>
            <div class="controls">
                <label class="checkbox">
                    <?php echo $data['filename']; ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a class="btn" href="employee_list2.html">Back</a>
    </div>
</div>