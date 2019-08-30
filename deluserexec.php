<?php
include 'db.php';
	$id = $_POST['id'];
	mysqli_query($con, "DELETE FROM usersids WHERE id='$id'");
	
		 echo '<script>alert("Successfully Deleted!")</script>';
		 header('location:users.php');				
?>