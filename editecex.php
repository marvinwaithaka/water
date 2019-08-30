<?php
include 'db.php';
$owner_id =$_REQUEST['id'];
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
	$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
	$barangay= isset($_POST['address']) ? $_POST['address'] : '';
	$meterno= isset($_POST['mi']) ? $_POST['mi'] : '';

	mysqli_query($con, "UPDATE owners SET id ='$id', lname ='$lname',
		 fname ='$fname', address='$barangay', mi='$meterno' WHERE id = '$owner_id'");
		 echo '<script>alert("Successfully Updated!")</script>';
		 header('location: rclients.php');
?>		 