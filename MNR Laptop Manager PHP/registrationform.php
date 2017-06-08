<?PHP
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
header ("Location: login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KSC Device Registration</title>
</head>

<body>

<?php include("includes/header.php"); ?>


<?php

// Check for form submission.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$errors = array(); // Initialize an error array.
	
	// Check for username.
	if (empty($_SESSION['schoolUsername'])) {
		session_start();
		session_destroy();
		header('Location: ../login.php');
		exit;
	} else {
		$schoolUsername = $_SESSION['schoolUsername'];
	}
	
	// Check for password.
		if (empty($_SESSION['schoolPassword'])) {
		session_start();
		session_destroy();
		header('Location: ../login.php');
		exit;
	} else {
		$schoolPassword = $_SESSION['schoolPassword'];
	}
	
	// Check for device type.
	if (empty($_POST['deviceType'])) {
		$errors[] = 'Please select your Device Type.';
	} else {
	$deviceType = $_REQUEST['deviceType'];
	}
	
	// Check for device username.
	if ((!empty($_REQUEST['deviceUsername'])) AND (!empty($_REQUEST['deviceUsernameNA']))) {
		$errors[] = "Please enter a Device Username OR tick Not Applicable.";
	} elseif ((empty($_REQUEST['deviceUsername'])) AND (empty($_REQUEST['deviceUsernameNA']))) {
		$errors[] = "Please enter a Device Username OR tick Not Applicable.";
	} elseif ((!empty($_REQUEST['deviceUsername'])) AND (empty($_REQUEST['deviceUsernameNA']))) {
		$deviceUsername = $_REQUEST['deviceUsername'];
	} elseif ((empty($_REQUEST['deviceUsername'])) AND (!empty($_REQUEST['deviceUsernameNA']))) {
		$deviceUsername = "No Username";
	}
	
	// Check for device Password.
	if ((!empty($_REQUEST['devicePassword'])) AND (!empty($_REQUEST['devicePasswordNA']))) {
		$errors[] = "Please enter a Device Password OR tick Not Applicable.";
	} elseif ((empty($_REQUEST['devicePassword'])) AND (empty($_REQUEST['devicePasswordNA']))) {
		$errors[] = "Please enter a Device Password OR tick Not Applicable.";
	} elseif ((!empty($_REQUEST['devicePassword'])) AND (empty($_REQUEST['devicePasswordNA']))) {
		$devicePassword = $_REQUEST['devicePassword'];
	} elseif ((empty($_REQUEST['devicePasswod'])) AND (!empty($_REQUEST['devicePasswordNA']))) {
		$devicePassword = "No Password";
	}
	
	// Check for house.
	if (empty($_POST['house'])) {
		$errors[] = 'Please select your House.';
	} else {
		$house = $_REQUEST['house'];
	}

	// Check for comments.
	if (empty($_POST['problemDetails'])) {
		$problemDetails = NULL;
	} else {
		$problemDetails = trim($_POST['problemDetails']);
	}
	
	if (empty($errors)) { // If everything is OK.
	
		// Register device is database.
		
		require ('../sql_connection.php'); // Connect to DB.
		
		// Make query.
		$q = "INSERT INTO StudentForm (schoolUsername, schoolPassword, deviceType, deviceUsername, devicePassword, house, problemDetails) 
		VALUES ('$schoolUsername', '$schoolPassword', '$deviceType', '$deviceUsername', '$devicePassword', '$house', '$problemDetails')";
		
		// Run query.
		$r = @mysqli_query ($dbc, $q);
		if ($r) {
			
			$registered = $_SERVER['REQUEST_TIME'];
			$email = $schoolUsername . '@kings-school.co.uk';
			
			//define the receiver of the email
			$to = "$email";
			//define the subject of the email
			$subject = "Your $deviceType has been registered"; 
			//define the message to be sent. Each line should be separated with \n
			$message = "Please bring your $deviceType to the IT Office with it's power supply so that the issue can be looked at by a technician."; 
			//define the headers we want passed. Note that they are separated with \r\n
			$headers = "From: deviceregistration@kings-school.co.uk";
			//send the email
			$mail_sent = @mail( $to, $subject, $message, $headers );
			
			
			session_start();
			$_SESSION['registered'] = "<p>Your $deviceType has been registered. <br /> Please bring your $deviceType to the IT Office with it's power supply so that the issue can be looked at by a technician.</p>";
			header('Location: ../profile.php');
			
			//$Message = urlencode("<p>Your $deviceType has been registered. <br />
			//Please bring your $deviceType to the IT Office so that the issue can be looked at by a technician.</p>");
			//header("Location:profile.php?Message=".$Message);
			//die;
			
			//header('Location: ../profile.php');
									
			//echo "<p>Your $deviceType has been registered. <br />
			//Please bring your $deviceType to the IT Office so that the issue can be looked at by a technician.</p>";
				
		} else {
			echo '<h1>System Error</h1>
				<p class="error">Your device could not be registered due to a system error. We appologise for any inconvenience. </p>';
				
				// Debugging message.
				//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
				
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close database connection.
		
		exit();
		
	} else { // Report the errors.
	
	echo '<h1>Error!</h1>
	<p class=error>The following error(s) occoured:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '<p>Please try again.</p>';
	}
}
	
?>


<form action="registrationform.php" method="post">
<fieldset><legend>Enter your information in the form below</legend>

<?php 
$schoolUsername = $_SESSION['schoolUsername'];
echo "<p><label>School Username: </label>$schoolUsername</p>";
?>

<p><label>Device Type: <select name="deviceType" required>
	<option value="" disabled selected>Select your device</option>
  	<optgroup label="Computer">
        <option value="Desktop Computer">Desktop Computer</option>
    	<option value="Laptop">Laptop</option>
    	<option value="Macbook">Macbook</option>
  	</optgroup>
  	<optgroup label="Phone">
    	<option value="androidPhone">Android Phone</option>
        <option value="blackberryPhone">Blackberry Phone</option>
    	<option value="iPhone">iPhone</option>
        <option value="windowsPhone">Windows Phone</option>
        <option value="otherPhone">Other Phone</option>
  	</optgroup>
    <optgroup label="Tablet">
    	<option value="androidTablet">Android Tablet</option>
        <option value="blackberryTablet">Blackberry Tablet</option>
    	<option value="iPad">iPad</option>
        <option value="windowsTablet">Windows Tablet</option>
        <option value="otherTablet">Other Tablet</option>
  	</optgroup>
</select></label></p>

<p><label>Device Username: <input type="text" name="deviceUsername" size="20" maxlength="40" /></label> <br />
<input type="checkbox" name="deviceUsernameNA" value="None">Not Applicable</p>

<p><label>Device Password: <input type="password" name="devicePassword" size="20" maxlength="40" /></label> <br />
<input type="checkbox" name="devicePasswordNA" value="None">Not Applicable</p>

<p><label>House: <select name="house" required>
	<option value="" disabled selected>Select your house</option>
	<option value="Bailey">Bailey</option>
    <option value="Broughton">Broughton</option>
    <option value="Carlyon">Carlyon</option>
    <option value="Galpins">Galpins</option>
    <option value="Grange">Grange</option>
    <option value="Harvey">Harvey</option>
    <option value="Jervis">Jervis</option>
    <option value="Linacre">Linacre</option>
    <option value="Luxmoore">Luxmoore</option>
    <option value="Marlowe">Marlowe</option>
    <option value="Meister Omers">Meister Omers</option>
    <option value="Mitchinsons">Mitchinsons</option>
    <option value="School House">School House</option>
    <option value="Tradescant">Tradescant</option>
    <option value="Walpole">Walpole</option>
</select></label></p>

<p><label>Details of problem:<br />
<textarea name="problemDetails" rows="4" cols="100"></textarea></label></p>
</fieldset>

<p><input type="submit" name="submit" value="Submit" /></p>

</form>

</body>
</html>