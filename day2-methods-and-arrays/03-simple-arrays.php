<?php require('config.php'); 

//create a list of pizza toppings
$pizza_toppings = array( 'Mushrooms', 'Onions', 'Bell Peppers' );

//add something to the list
$pizza_toppings[] = 'Fresh Basil';

//randomize the values
shuffle( $pizza_toppings );

//add something to the list (after shuffle so it's always last)
$pizza_toppings[] = 'Roasted tomatoes';

//count all the toppings
$total = count( $pizza_toppings );
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simple Array Example</title>
	
	<!-- just a simple css framework for display -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
</head>
<body>
	<h1>Your Pizza Order:</h1>
	<h2>Number of toppings: <?php echo $total; ?></h2>

	<p>the first item is: <?php echo $pizza_toppings[0]; ?></p>

	
	<ul class="toppings">
		<?php 
		foreach( $pizza_toppings AS $item ){
			echo "<li>$item</li>";
		}	
		?>			
	</ul>


	<pre>
		<!-- UGLY! just for devs -->
<?php print_r( $pizza_toppings ); ?>
	</pre>


</body>
</html>