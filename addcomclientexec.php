<?php
include 'db.php';
	
	$account_id = isset($_POST['id']) ? $_POST['id'] : '';
	$account = isset($_POST['account']) ? $_POST['account'] : '';
	$barangay= isset($_POST['address']) ? $_POST['address'] : '';
	$meterno = isset($_POST['mi']) ? $_POST['mi'] : '';

	mysqli_query($con, "INSERT INTO  commercial_owners (id, account, address, mi)
		 VALUES ('$account_id','$account','$barangay','$meterno')");
				
				echo '<script>alert("Successfully Added!")</script>';
				header('location: cclients.php');
?>