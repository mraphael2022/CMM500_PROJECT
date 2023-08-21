//https://www.sourcecodester.com/php-project
//https://www.codecademy.com/learn
//https://www.geeksforgeeks.org/web-development-projects/
//https://stackoverflow.com/
//https://bootstrap.com/docs/5.3/getting-started/introduction/

//session_start is used to manage user session across pages
//d code defines a login page with the following elements:
//A login box with a logo and placeholders for displaying the current date and time.
//A form to track employee attendance, including a dropdown menu to select the attendance 
//status (Time In/Time Out) and an input field for entering the employee's ID.
//A "Sign In" button to submit the attendance form.
//Alert divs for displaying success and error messages.
<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Enter Employee ID</h4>

    	<form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
              <option value="out">Time Out</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
    	</form>
  	</div>
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		
</div>
	
  //this code provides functionality for tracking employee attendance through a web page. 
<?php include 'scripts.php' ?> //the content of a file named "scripts.php." It's likely that the "scripts.php" 
//file contains important PHP code or includes other scripts needed for the functionality of this page. 
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    //This sets up an interval that updates the date and time on the page every 100 milliseconds 
    //(10 times per second). It uses the Moment.js library to format and display the current date 
    //and time in the designated HTML elements with IDs date and time.
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);
//This attaches a submit event handler to the form with the ID attendance. When the form is 
//submitted, it prevents the default form submission behavior (e.g., navigating to another page) 
//using e.preventDefault();. Instead, it captures the form data, serializes it, and sends it to 
//the server using an AJAX POST request.

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    //AJAX request using jQuery. It sends the serialized form data to the server-side script 
    //"attendance.php" using the HTTP POST method. It specifies that the expected response 
    //will be in JSON format.
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      // it shows an alert with the error message. If the request is successful,
      // it shows a success alert with a success message and clears the input field with 
      //the ID employee.
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });
    
});
</script>
</body>
</html>