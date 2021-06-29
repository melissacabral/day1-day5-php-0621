<?php 
//start or resume the active session
session_start(); 

//if the user still has a valid cookie, use it to rebuild the session
if( isset( $_COOKIE['is_logged_in'] ) ){
	$_SESSION['is_logged_in'] = $_COOKIE['is_logged_in'];
}

//security check! if not logged in, kill the script
if( ! isset($_SESSION['is_logged_in']) OR ! $_SESSION['is_logged_in'] ){
	die( 'You must be logged in to view this' );
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>SECRET PAGE</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
</head>
<body>
	<a href="login.php?action=logout" class="button">Log Out</a>
	<h1>SECRET STUFF</h1>
	You are logged in to view this

</body>
</html>