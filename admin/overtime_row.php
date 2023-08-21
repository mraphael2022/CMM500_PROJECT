//https://www.sourcecodester.com/php-project
//https://www.codecademy.com/learn
//https://www.geeksforgeeks.org/web-development-projects/
//https://stackoverflow.com/
//https://bootstrap.com/docs/5.3/getting-started/introduction/

<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, overtime.id AS otid FROM overtime LEFT JOIN employees on employees.id=overtime.employee_id WHERE overtime.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>