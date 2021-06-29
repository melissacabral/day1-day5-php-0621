<?php require('config.php'); 

//pre-define all variables to avoid notices
$name = '';
$email = '';
$phone = '';
$reason = '';
$message = '';
$errors = array();
$feedback = '';
$feedback_class = '';

//function to help with sticky dropdown
function selected( $choice, $expected ){
	if( $choice == $expected ){
		echo 'selected';
	}
}

//parse the form if submitted
if( isset($_POST['did_submit']) ){
//sanitize all fields
$name 	 = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
$email 	 = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
$phone 	 = filter_var( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT );
$reason  = filter_var( $_POST['reason'], FILTER_SANITIZE_STRING );
$message = filter_var( $_POST['message'], FILTER_SANITIZE_STRING );

//validate
$valid = true;

//username is blank or longer than 50 chars
if( $name == '' OR strlen( $name ) > 50 ){
$valid = false;
$errors['name'] = 'Provide a name that is shorter than 50 characters.';
}

//invalid email (blank is invalid)
if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
$valid = false;
$errors['email'] = 'Your email address is invalid.';
}

//reason is not on the list of valid reasons
$valid_reasons = array( 'support', 'bug report', 'hi' );
if( ! in_array( $reason, $valid_reasons ) ){
$valid = false;
$errors['reason'] = 'Please choose a valid reason from the dropdown';
}

//message is blank or too long
if( $message == '' OR strlen( $message ) > 500 ){
$valid = false;
$errors['message'] = 'Provide a message that is shorter than 500 characters';
}

//if valid, send an email and show user feedback
if( $valid ){
//TODO: send the email
$feedback = 'Thank you for your message. I\'ll get back to you';
$feedback_class = 'success';
}else{
$feedback = 'There was a problem. Fix the following:';
$feedback_class = 'error';
}

}//end parser
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
<div class="container contact-form">
<h1>Contact Us</h1>

<?php if( isset( $feedback ) ){ ?>
<div class="feedback <?php echo $feedback_class; ?>">
	<h2><?php echo $feedback; ?></h2>

	<?php if( ! empty( $errors ) ){ ?>
	<ul>
		<?php foreach( $errors AS $error ){
			echo "<li>$error</li>";
		} ?>
	</ul>
	<?php } //end if errors ?>

</div>
<?php } //end if feedback ?>

<form action="contact.php" method="post">
	<label>Your Name *</label>
	<span class="hint">Fewer than 50 chars</span>
	<input type="text" name="name" value="<?php echo $name; ?>" placeholder="Your Name Here">


	<label>Email Address *</label>
	<input type="email" name="email" value="<?php echo $email; ?>">

	<label>Phone Number</label>
	<input type="tel" name="phone" value="<?php echo $phone; ?>">

	<label>How can we help you?</label>
	<select name="reason">
		<option>Choose One</option>
		<option value="support" <?php selected( $reason, 'support' ); ?>>I need customer support.</option>
		<option value="bug report" <?php selected( $reason, 'bug report' ); ?>>I'm reporting a bug.</option>
		<option value="hi" <?php selected( $reason, 'hi' ); ?>>I just wanted to say Hi!</option>
	</select>

	<label>Message *</label>
	<textarea name="message"><?php echo $message; ?></textarea>

	<input type="submit" value="Send Message">
	<input type="hidden" name="did_submit" value="1">
</form>
</div>
<?php include('includes/debug-output.php'); ?>
</body>
</html>