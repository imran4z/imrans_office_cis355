<div style="margin-top: 5%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <div style="font-weight: bold; font-size: 2em; margin-bottom: 3%;">
        Imran's Office: Events 
    </div>
    <div style="font-size: 1em;">
        <a href="events_create.html" class="btn btn-success">Create</a>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
        <table class="table table-striped table-bordered" style="margin-top: 2%">
            <thead>
                <tr>
                    <th>event_name</th>
					<th>event_date</th>
                    <th>event_time</th>
                    <th>event_location</th>
                    <th>event_description</th>
					<th></th>

                </tr>
            </thead>
            <tbody>
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
    $sql = 'SELECT * FROM event ORDER BY event_name ASC';
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
		echo '<td width="15%">'. $row['event_name'] . '</td>';
        echo '<td width="15%">'. $row['event_date'] . '</td>';
        echo '<td width="10%">'. $row['event_time'] . '</td>';
		echo '<td width="15%">'. $row['event_location'] . '</td>';
        echo '<td width="10%">'. $row['event_description'] . '</td>'; 
        echo '<td width="20%"><div width="100%">';
        
        echo '<a class="btn" href="events_read.html?id='.$row['ID'].'"">Read</a>';
        echo '<a class="btn btn-success" href="events_update.html?id='.$row['ID'].'"">Update</a>';
        echo '<a class="btn btn-danger" href="events_delete.html?id='.$row['ID'].'"">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    Database::disconnect();
?>
            </tbody>
        </table>
    </div>
</div>