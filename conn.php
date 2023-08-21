//i learnt some of the codes on //https://www.sourcecodester.com/php-project
//https://www.codecademy.com/learn
//https://www.geeksforgeeks.org/web-development-projects/
//https://stackoverflow.com/

<?php
	$conn = new mysqli('localhost', 'root', '', 'apsystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	// 'root' is d username for accessing the database.

//'' (empty string) represents the password for the database user.
//'apsystem' is the name of the database to which you want to connect.
//if ($conn->connect_error) {
//This line starts a conditional statement to check if there was an error in establishing 
//the database connection.
//die("Connection failed: " . $conn->connect_error);
//If the connection to the database was unsuccessful, this line terminates the script execution
 //and displays an error message.
//"Connection failed: " is a text message indicating the reason for the failure.
//$conn->connect_error retrieves the specific error message provided by the database server.
//Overall, this code snippet attempts to connect to a MySQL database named 'apsystem' using the 
//provided username and an empty password. If the connection fails, an error message is displayed,
// providing information about the cause of the failure.
//It's important to ensure that you have the correct database credentials (localhost, username, 
//password, and database name) and that your MySQL server is running before using this code. 
//Additionally, using an empty password (as shown in the example) is not recommended for security 
//reasons.






?>