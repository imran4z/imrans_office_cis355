<div style="margin-top: 5%; margin-bottom: 5%; margin-left: 3%; margin-right: 3%;">
    <div style="font-weight: bold; font-size: 2em; margin-bottom: 3%;">
        This is Imran's Office: Assignments List
    </div>
    <div style="font-size: 1em;">
        <a href="assignments_create.html" class="btn btn-success">Create</a>
        <a href="imr_office.html" class="btn btn-primary">Home</a>
        <table class="table table-striped table-bordered" style="margin-top: 2%">
            <thead>
                <tr>
                    <th>Assignment</th>
                    <th>Employee_Name</th>
                    <th>Status</th>
					<th>Manager_review</th>
					<th>Comments</th>
					<th></th>
                </tr>
            </thead>
            <tbody id="tbody">
<?php 

    include 'database.php';
    $pdo = Database::connect();
    $sql = 'SELECT * FROM assignments ORDER BY assignment ASC';
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td width="15%">'. $row['assignment'] . '</td>';
        echo '<td width="15%">'. $row['employee_name'] . '</td>';
		echo '<td width="15%">'. $row['status'] . '</td>';
		echo '<td width="15%">'. $row['manager_review'] . '</td>';
		echo '<td width="15%">'. $row['comments'] . '</td>';
        echo '<td width="50%">';
        echo '<a class="btn" href="assignments_read.html?id='.$row['id'].'">Read</a>';
        echo '&nbsp;';
        echo '<a class="btn btn-success" href="assignments_update.html?id='.$row['id'].'">Update</a>';
        echo '&nbsp;';
        echo '<a class="btn btn-danger" href="assignments_delete.html?id='.$row['id'].'">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    Database::disconnect();
?>
            </tbody>
        </table>
    </div>
</div>