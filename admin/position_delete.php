//https://www.sourcecodester.com/php-project
//https://www.codecademy.com/learn
//https://www.geeksforgeeks.org/web-development-projects/
//https://stackoverflow.com/
//https://bootstrap.com/docs/5.3/getting-started/introduction/

<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM position WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: position.php');
	
?>