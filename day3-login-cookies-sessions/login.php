<?php
session_start(); 
require( 'config.php' ); 

//logout logic
if( isset( $_GET['action'] ) AND $_GET['action'] == 'logout' ){
	//unset all cookies (make it expire in the past)
	setcookie( 'is_logged_in', false, time() - 99999 );

	//destroy the session
	$_SESSION = array();
	session_destroy();
}//end logout

//process the form if it was submitted
if( isset( $_POST['username'] ) ){
	//get all user submitted data (usually sanitize here)
	$username = $_POST['username'];
	$password = $_POST['password'];

	//validate - check to see if they typed the right combo
	if( $username == CORRECT_USER AND $password == CORRECT_PASSWORD ){
		//if correct, remember the user 
		$feedback = 'Success!';
		$class = 'success';

		//remember the user for one week
		//DANGER! this cookie has a terrible name and is very hackable. we'll fix it tomorrow
		setcookie( 'is_logged_in', true, time() + 60 * 60 * 24 * 7 );
		$_SESSION['is_logged_in'] = true;

		//redirect them to their profile
		header('Location:profile.php');
	}else{
		//if not, show an error message
		$feedback = 'Incorrect Username/Password combo. Try again.';
		$class = 'error';
	}
	
} //end parser
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log In to your Account</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
	<style type="text/css">
		.login{
			max-width:30em;
		}

		.feedback{
			padding:.5em;
			margin:1em 0;
		}
		.error{
			background-color: #FDD6D6;
		}
		.success{
			background-color: #D0FCCA;
		}
	</style>
</head>
<body>
	
	<div class="container login">
		<h1>Log in</h1>

		<?php 
		//show the feedback if there is any
		if( isset($feedback) ){
			echo "<div class='feedback $class'>$feedback</div>";
		} 
		?>

		<form method="post" action="login.php">
			<label>Username</label>
			<input type="text" name="username">

			<label>Password</label>
			<input type="password" name="password">

			<input type="submit" value="Log In">
		</form>
	</div>


<?php 
//begin debugger
if( DEBUG_MODE ){
	echo '<h3>DEBUG MODE IS ON</h3>';
	echo '<pre>';
	print_r( get_defined_vars() );
	echo '</pre>';
} 
//end debugger
?>
</body>
</html>