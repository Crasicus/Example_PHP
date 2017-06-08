<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form action="signin.php" method="post">
<fieldset>
<?php
$id = $_GET['id'];

// Query Awaiting Arrivial
		$q = "SELECT ID, schoolUsername, deviceType, problemDetails FROM StudentForm WHERE ID=$id ORDER BY ID ASC";
				
		require ('../sql_connection.php'); // Connect to DB.
		
		// Run query.
		$r = @mysqli_query ($dbc, $q);
		
		//echo '<div style="height:150px;overflow:auto;">';
		
		echo '<div id="scrolling">';
		
		if ($r) {	
						
			while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
				
			$schoolUsername = $row['schoolUsername'];
			$deviceType = $row['deviceType'];
			$problemDetails = $row['problemDetails'];
			
			echo "<p>Username: $schoolUsername</p>";
			echo "<p>Device: $deviceType</p>";
			echo "<p>Details: $problemDetails</p>";
				
			}
						
		} else {
			echo '<p>fail.</p>';
		}
		
		echo '</div>';
		
		mysqli_close($dbc);
?>

<p><label>Presented With: <br />
<select name="presentedWith" multiple required>
  <option value="Case">Case</option>
  <option value="Ethernet Adapter">Ethernet Adapter</option>
  <option value="Network Cable">Network Cable</option>
  <option value="Power Supply">Power Supply</option>
</select></label></p>

<p><label>Work Required: <br />
<select name="workRequired" multiple required>
  <option value="Anti-Virus">Anti-Virus</option>
  <option value="BCM Registration">BCM Registration</option>
  <option value="Call Dell Engineer">Call Dell Engineer</option>
  <option value="Hardware">Hardware</option>
  <option value="Network Setup">Network Setup</option>
  <option value="Virus Cleaning">Virus Cleaning</option>
  <option value="Other">Other</option>
</select></label></p>

<p><label>Notes:<br />
<textarea name="notes" rows="4" cols="100"></textarea></label></p>

<p><label>Signed in by: <select name="signedInBy" required>
	<option value="" disabled selected>Select Technician</option>
    <option value="JDB">JDB</option>
    <option value="JLS">JLS</option>
    <option value="JPHC">JPHC</option>
    <option value="PLD">PLD</option>
    <option value="OCB">OCB</option>
    <option value="RF">RF</option>
    <option value="RMD">RMD</option>
    <option value="SR">SR</option>
</select></label></p>

</fieldset>

<p><input type="submit" name="signIn" value="SIGN IN" /></p>

</form>

</body>
</html>