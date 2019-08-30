<?php
include 'db.php';
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	mysqli_query($con, "DELETE from owners WHERE id='$id'");

	 echo '<script>alert("Successfully Deleted!")</script>';
	 header('location:rclients.php');			
?>