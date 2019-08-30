<?php
include 'db.php';
			 		$id = isset($_POST['id']) ? $_POST['id'] : '';
					$username= isset($_POST['username']) ? $_POST['username'] : '';				
					$password= isset($_POST['password']) ? $_POST['password'] : '';
					$lname= isset($_POST['last_name']) ? $_POST['last_name'] : '';
					$fname= isset($_POST['first_name']) ? $_POST['first_name'] : '';
				
$query = mysqli_query($con,"SELECT username FROM usersids WHERE username='$username'");

  if (mysqli_num_rows($query) != 0)
  {
       echo '<script>alert("Error! Username Already Exists!")</script>';
       header('location: users.php');
      die();
  }

$sql = "INSERT INTO  usersids (id,username, password, last_name, first_name) 
		 VALUES ('$id','$username','$password','$lname','$fname')";
	
	if ($con->query($sql) === TRUE) {
		 echo '<script>alert("Successfully Added!")</script>';
		 header('location: users.php');	
	}
	else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}

?>