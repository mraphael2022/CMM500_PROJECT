//https://www.sourcecodester.com/php-project
//https://www.codecademy.com/learn
//https://www.geeksforgeeks.org/web-development-projects/
//https://stackoverflow.com/
//https://bootstrap.com/docs/5.3/getting-started/introduction/

<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$empid = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE employees SET photo = '$filename' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to update photo first';
	}

	header('location: employee.php');
?>