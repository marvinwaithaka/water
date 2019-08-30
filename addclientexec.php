<?php
include 'db.php';
	
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
	$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
	$barangay= isset($_POST['address']) ? $_POST['address'] : '';
	$meterno = isset($_POST['mi']) ? $_POST['mi'] : '';

	mysqli_query($con, "INSERT INTO  owners (id,lname,fname,address,mi) 
		 VALUES ('$id','$lname','$fname','$barangay','$meterno')"); 
				
				echo '<script>alert("Successfully Added!")</script>';
				header('location: rclients.php');
?>