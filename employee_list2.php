
<div style="margin-top: 3%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <div style="font-weight: bold; font-size: 2em; margin-bottom: 3%;">
        This is Imran's Office: Employees List
    </div>
    <div style="font-size: 1em;">
        <a href="e_create.php" class="btn btn-success">Create</a>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
		<a href="logout.php" class="btn btn-warning">Logout</a> 
		<a href="imr_employees_api.php"class="btn btn-info">API/Json</a> &nbsp;&nbsp;&nbsp;
        <table class="table table-striped table-bordered" style="margin-top: 2%">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Title</th>
					<th>Email</th>
					<th>File Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbody">
			
<?php 
	session_start();
		if(!isset($_SESSION["e_id"])){ // if "user" not set,
		session_destroy();
		header('Location: login3.php');     // go to login page
	
	exit;
	}
	$sessionid = $_SESSION['e_id'];

    include 'database.php';
    $pdo = Database::connect();
    $sql = 'SELECT * FROM staff ORDER BY fname ASC';
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td width="20%">'. $row['fname'] . '</td>';
        echo '<td width="20%">'. $row['title'] . '</td>';
		echo '<td width="10%">'. $row['email'] . '</td>';
		echo '<td width="20%">'. $row['filename'] . '</td>';
        echo '<td width="50%">';
        echo '<a class="btn" href="employee_read.html?id='.$row['id'].'">Read</a>';
        echo '&nbsp;';
        echo '<a class="btn btn-success" href="employee_update.html?id='.$row['id'].'">Update</a>';
        echo '&nbsp;';
        echo '<a class="btn btn-danger" href="employee_delete.html?id='.$row['id'].'">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    Database::disconnect();
?>
            </tbody>
        </table>

    </div>
</div>