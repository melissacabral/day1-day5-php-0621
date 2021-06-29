<?php 
require('config.php'); 

//pre-define all values
$name = '';
$email = '';
$phone = '';
$reason = '';
$message = '';

//custom function for making the dropdown "stick"
function selected( $thing1, $thing2 ){
	if( $thing1 == $thing2 ){
		echo 'selected';
	}
}

//parse the form if they submitted it
if( isset($_POST['did_submit']) ){
//sanitize all fields
$name 		= filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
$email 		= filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
$phone 		= filter_var( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT );
$reason 	= filter_var( $_POST['reason'], FILTER_SANITIZE_STRING );
$message 	= filter_var( $_POST['message'], FILTER_SANITIZE_STRING );

//validate fields that need it
$valid = true;
$errors = array();

//name is blank or longer than 30 chars
if( $name == '' OR strlen( $name ) > 30 ){
	$valid = false;
	$errors['name'] = 'Please provide a name that is less than 30 characters long.';
}
//invalid email (blank included)
if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
	$valid = false;
	$errors['email'] = 'The email provided is invalid.';
}
//reason is not on the list of valid reasons
$valid_reasons = array( 'support', 'bug report', 'hi' );
if( ! in_array( $reason, $valid_reasons ) ){
	$valid = false;
	$errors['reason'] = 'Please choose a valid reason from the dropdown.';
}	
//message is longer than 384000 chars
if( strlen( $message ) > 350000 ){
	$valid = false;
	$errors['message'] = 'Your message is too long.';
}

//if everything is valid, send a message, show positive feedback
if( $valid ){
	//send mail
	$to = 'mcabral@platt.edu';
	$subject = 'Someone sent you a message from your website';
	// \r is a single line break (return)
	$body = "Name: $name \r";
	$body .= "Phone: $phone \r";
	$body .= "Email: $email \r";
	$body .= "Message: $message";

	$headers = "Reply-to:$email";

	$did_send = mail( $to, $subject, $body, $headers );

	if( $did_send ){
		$feedback = 'Thank you for your message. I\'ll get back to you shortly';
		$feedback_class = 'success';
	}else{
		$feedback = 'There was a problem trying to send your message. Try again later';
		$feedback_class = 'error';
	}	
}else{
	//if not, show a detailed error
	$feedback = 'Your message could not be sent. Please fix the following: ';
	$feedback_class = 'error';
}

} //end form parser
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Us</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
<style type="text/css">
	.contact-form{
		max-width:40em;
	}

	.feedback{
		margin:1em 0;
		padding:.5em;
		background-color: #FBF3D7;
	}
	.error{
		background-color: #FBD7E3;			
	}
	.success{
		background-color: #C4F9CA;			
	}
</style>
</head>
<body>
<div class="container contact-form">
	<h1>Contact Us</h1>

	<?php 
	//if there's feedback, show it
	if( isset( $feedback ) ){
	?>
		<div class="feedback <?php echo $feedback_class; ?>">
			<h2><?php echo $feedback; ?></h2>
			
			<?php if( ! empty( $errors ) ){ ?>
			<ul>
				<?php foreach( $errors as $error ){ ?>
				<li><?php echo $error; ?></li>
				<?php } ?>
			</ul>
			<?php } ?>

		</div>			
	<?php } //end if feedback ?>

	<?php 
	// $_SERVER['PHP_SELF'] will point the form to THIS file, even if we change the name of this file
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
		<label>Your Name</label>
		<input type="text" name="name" value="<?php echo $name; ?>">

		<label>Email Address</label>
		<input type="email" name="email" value="<?php echo $email; ?>">

		<label>Phone Number</label>
		<input type="tel" name="phone" value="<?php echo $phone; ?>">

		<label>How can we help you?</label>
		<select name="reason">
			<option value="support" <?php selected( $reason, 'support' ); ?>>I need customer support.</option>
			<option value="bug report" <?php selected( $reason, 'bug report' ); ?>>I'm reporting a bug.</option>
			<option value="hi" <?php selected( $reason, 'hi' ); ?>>I just wanted to say Hi!</option>
		</select>

		<label>Message</label>
		<textarea name="message"><?php echo $message ?></textarea>

		<input type="submit" value="Send Message">
		<input type="hidden" name="did_submit" value="1">
	</form>
</div>
<?php include('includes/debug-output.php'); ?>
</body>
</html>