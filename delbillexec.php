<?php
include 'db.php';
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	mysqli_query($con, "DELETE from coommercial_bill WHERE id='$id'");
		 echo '<script>alert("Successfully Deleted!")</script>';
		 echo "<script>windows: location='rbilling.php'</script>";
?>