<?php
include 'db.php';
	$account_id = isset($_POST['id']) ? $_POST['id'] : '';
	mysqli_query($con, "DELETE from commercial_owners WHERE id='$account_id'");

	 echo '<script>alert("Successfully Deleted!")</script>';
	header('location: cclients.php');			
?>