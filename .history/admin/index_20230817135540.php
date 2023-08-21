<?php
  session_start();
  //This checks if the session variable 'admin' is set. If it is set, it means the administrator 
  //is already logged in, and they are redirected to the 'home.php' page using the 
  //header('location:home.php'); statement.
  if(isset($_SESSION['admin'])){
    header('location:home.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box"> //ontains the main content of the login page
  	<div class="login-logo"> //
  		<b>Admin Login</b>
  	</div>
  //A form is presented where administrators can input their username and password to log in.
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your session</p>
	<!--form data is submitted to the 'login.php' script using the action 
	attribute of the <form> element.-->
    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="input Username" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="input Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
    	</form>
  	</div>
  	<?php
	<!--an error message is stored in the session variable 'error', it is 
	displayed within a red callout box. This message might be related to 
	login failures or other issues.-->
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
			//The unset($_SESSION['error']); statement removes the error 
			//message from the session after it is displayed.
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>