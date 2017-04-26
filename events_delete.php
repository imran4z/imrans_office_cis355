<?php 
	session_start();
			if(!isset($_SESSION["e_id"])){ // if "user" not set,
			session_destroy();
			header('Location: login3.php');     // go to login page
		
		exit;
		}
		$sessionid = $_SESSION['e_id'];

	require 'database.php';
    
	if (isset($_POST['delete'])) {
		// keep track post values
		$id = $_POST['id'];
		
        $valid = true;
		if (empty($id)) { $valid = false; } 
        
		// delete data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM event WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            Database::disconnect();
		}
	} 
?>
