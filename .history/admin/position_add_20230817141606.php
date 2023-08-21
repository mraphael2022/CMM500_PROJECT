<?php
	include 'includes/session.php';
//	The script checks if the 'add' parameter is set in a POST request, 
//indicating that the form to add a new position has been submitted.

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$rate = $_POST['rate'];
//The script retrieves the 'title' and 'rate' values from the POST data.
//The script constructs an SQL query to insert the new position details into 
//the 'position' table in the database.
//If the query execution is successful ($conn->query($sql)), a success message 
//is stored in the session.
//If the query fails, the error message from the database is stored in the session.
		$sql = "INSERT INTO position (description, rate) VALUES ('$title', '$rate')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	//Regardless of the success or failure of the database operation, the script redirects
	// the user back to the 'position.php' page.
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: position.php');

?>