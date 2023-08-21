//https://www.sourcecodester.com/php-project
//https://www.codecademy.com/learn
//https://www.geeksforgeeks.org/web-development-projects/
//https://stackoverflow.com/
//https://bootstrap.com/docs/5.3/getting-started/introduction/

<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, attendance.id as attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>