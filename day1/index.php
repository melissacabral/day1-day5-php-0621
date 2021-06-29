<?php 
//define some variables
$drink = 'Coffee';
$food = 'Oatmeal';

//concatenate two vars together
//$breakfast = $drink . ' and ' . $food;

$breakfast = "$drink and $food";

//define a constant
define('WEB_ADDRESS', 'http://localhost/melissa/php/melissa-php-0621/');

?>
<!DOCTYPE html>
<html>
<head>
	<title>First day of PHP class!</title>
	<style>
		h1{
			color:orange;
		}
		.main-menu{
			background-color: yellow;
		}
	</style>
</head>
<body>
	<h1><?php echo 'Hello World'; ?></h1>
	
	<?php include('includes/nav.php'); ?>


	<p>no PHP just yet</p>

	<!-- this is a public comment -->

	<h2><?php
	//this is a single-line comment 	
	# alternate style single-line comment	
	echo 'another token of PHP here'; 
	echo '<br> second echo on a new line';
	?></h2>

	<p>I ate <?php echo $breakfast; ?> for breakfast.</p>

</body>
</html>