<?php
//It checks if a POST request with the parameter 'employeeid' is received. 
	if(isset($_POST['employee'])){
		$output = array('error'=>false);
//It includes two external files: 'conn.php' (for database connection) 
//and 'timezone.php' (for handling timezones).
		include 'conn.php';
		include 'timezone.php';
//It fetches the employee ID and attendance status from the POST data.
		$employee = $_POST['employee'];
		$status = $_POST['status'];
//SQL query to retrieve employee information based on the provided employee ID.
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
//If the employee is found in the database, it checks if the employee has already 
//timed in for the current day ($date_now). If they have, it will output an error message 
//that they have timed in for today.
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];
			$date_now = date('Y-m-d');
			//chk if the employee has already timed in for the day.
			if($status == 'in'){
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have timed in for today';
				}
				else{
					//get the employee's schedule and calculate whether it is a late or early log 
					$sched = $row['schedule_id'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM schedules WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
					//insert into attendance table for clocking in
					$sql = "INSERT INTO attendance (employee_id, date, time_in, status) VALUES ('$id', '$date_now', NOW(), '$logstatus')";
					if($conn->query($sql)){
						$output['message'] = 'Time in: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
				//check if employee has already timed in for the day
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'Cannot Timeout. No time in.';
				}
				else{
					//Employee has already timed in or out.
					$row = $query->fetch_assoc();
					if($row['time_out'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'You have timed out for today';
					}
					else{
						//update the attendance record for time out
						$sql = "UPDATE attendance SET time_out = NOW() WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Time out: '.$row['firstname'].' '.$row['lastname'];
						//calculate hours worked
							$sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();
							
							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in']){
								$time_out = $srow['time_out'];
							}
							//This calculates the hours and minutes worked
							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4){
								$int = $int - 1;
							}
							//After updating the time out, the script calculates the total hours worked for the 
							//employee using the time_in and time_out values.
							//It then updates the num_hr field in the attendance table with the calculated value.
							$sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$row['uid']."'";
							$conn->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Employee ID not found';
		}
		
	}
	
	echo json_encode($output);

?>