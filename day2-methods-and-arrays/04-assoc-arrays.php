<?php require('config.php'); 
//make a pizza with multiple attributes
$pizza = array(
			//key 		=> value
			'crust' 	=> 'Crispy Thin Crust',
			'sauce'		=> 'Red Sauce',
			'size'		=> '14-inch',
			'cheese'	=> 'Mozarella',
		);

//add one more item
$pizza['dip'] = 'Jalapeno Ranch';

//edit a value
$pizza['cheese'] = '3-cheese blend';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Associative Array Example</title>
	
	<!-- just a simple css framework for display -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
</head>
<body>
<h1>Your Pizza</h1>

<ul class="pizza">
	<?php 
	foreach( $pizza AS $key => $value ){
		echo "<li>$key: <b>$value</b></li>";
	} 
	?>
</ul>

<pre><?php print_r($pizza); ?></pre>


</body>
</html>