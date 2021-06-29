<?php require('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Submission Results</title>
	
	<!-- just a simple css framework for display -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
</head>
<body>
	<div class="container">

		<?php 
		//if the user submitted everything right, show success message
		if( isset($_REQUEST['fave_color']) 
			AND isset($_REQUEST['fave_animal']) 
			AND $_REQUEST['fave_color'] != ''
			AND $_REQUEST['fave_animal'] != '' ){
			//success			
		?>
			<h1>Thank you for taking the survey</h1>
			<h3>Your answers:</h3>
			<p>Favorite Color: <?php echo $_REQUEST['fave_color']; ?></p>
			<p>Favorite Animal: <?php echo $_REQUEST['fave_animal']; ?></p>

		<?php 
		}else{
			//error
		?>
			<h1>Sorry</h1>	
			<p>Your survey was incomplete</p>
		<?php 
		} //end if/else
		?>
		<p><a href="02-post.php">Take the POST survey again</a></p>
		<p><a href="01-get.php">Take the GET survey again</a></p>
	</div>

<?php 
if(DEBUG_MODE){
	echo '<h3>GET Array</h3>';
	print_r($_GET);

	echo '<h3>POST Array</h3>';
	print_r($_POST);
} 
?>

</body>
</html>