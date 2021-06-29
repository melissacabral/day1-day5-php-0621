<?php 
function convert_date( $timestamp ){
	$date = new DateTime( $timestamp );
	return $date->format('l, F j, Y');
}

echo  convert_date('next year');
 ?>