<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KSC Device Registration</title>
</head>

<body>

<?PHP
		echo '<p>Awaiting Arrivial</p>';
		
		// Query Awaiting Arrivial
		$q = "SELECT ID, schoolUsername, deviceType, problemDetails, signedInTime FROM StudentForm WHERE status=1 ORDER BY ID ASC";
				
		require ('../sql_connection.php'); // Connect to DB.
		
		// Run query.
		$r = @mysqli_query ($dbc, $q);
		
		//echo '<div style="height:150px;overflow:auto;">';
		
		echo '<div id="scrolling">';
		
		if ($r) {
			echo '<table align="centre" cellspacing="3" cellpadding="3" width="75%">
			<tr><td class="header" align="left"><b>Username</b></td><td class="header" align="left"><b>Device</b></td><td class="header" align="left"><b>Details</b></td><td class="header" align="left"><b>Registered</b></td></tr>';
			
			while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
				echo '<tr><td align="left"><a href="signin.php?id='.$row['ID'].'">' . $row['schoolUsername'] . '</a></td><td align="left"><a href="signin.php?id='.$row['ID'].'">' . $row['deviceType'] . '</a></td><td align="left"><a href="signin.php?id='.$row['ID'].'">' . $row['problemDetails'] . '</a></td><td align="left"><a href="singin.php?id='.$row['ID'].'">' . $row['signedInTime'] . '</a></td></tr>';
			}
			
			echo '</table>';
			
		} else {
			echo '<p>fail.</p>';
		}
		
		echo '</div>';
		
		mysqli_close($dbc);
		
		echo '<br />';
		

		echo '<p>In Que</p>';
		
		// Query In Que
		$q = "SELECT schoolUsername, deviceType, problemDetails, signedInTime FROM StudentForm WHERE status=2 ORDER BY ID ASC";
				
		require ('../sql_connection.php'); // Connect to DB.
		
		// Run query.
		$r = @mysqli_query ($dbc, $q);
		
		//echo '<div style="height:150px;overflow:auto;">';
		
		echo '<div id="scrolling">';
		
		if ($r) {
			echo '<table align="centre" cellspacing="3" cellpadding="3" width="75%">
			<tr><td class="header" align="left"><b>Device</b></td><td class="header" align="left"><b>Details</b></td><td class="header" align="left"><b>Signed In</b></td><td class="header" align="left"><b>Status</b></td></tr>';
			
			while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
				echo '<tr><td align="left">' . $row['schoolUsername'] . '</td><td align="left">' . $row['deviceType'] . '</td><td align="left">' . $row['problemDetails'] . '</td><td align="left">' . $row['signedInTime'] . '</td></tr>';
			}
			
			echo '</table>';
			
		} else {
			echo '<p>fail.</p>';
		}
		
		echo '</div>';
		
		mysqli_close($dbc);
		
		echo '<br />';
		
		
		echo '<p>Awaiting Collection</p>';
		
		// Query Awaiting Collection
		$q = "SELECT schoolUsername, deviceType, problemDetails, signedInTime FROM StudentForm WHERE status=3 ORDER BY ID ASC";
				
		require ('../sql_connection.php'); // Connect to DB.
		
		// Run query.
		$r = @mysqli_query ($dbc, $q);
		
		//echo '<div style="height:150px;overflow:auto;">';
		
		echo '<div id="scrolling">';
		
		if ($r) {
			echo '<table align="centre" cellspacing="3" cellpadding="3" width="75%">
			<tr><td class="header" align="left"><b>Device</b></td><td class="header" align="left"><b>Details</b></td><td class="header" align="left"><b>Signed In</b></td><td class="header" align="left"><b>Status</b></td></tr>';
			
			while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
				echo '<tr><td align="left">' . $row['schoolUsername'] . '</td><td align="left">' . $row['deviceType'] . '</td><td align="left">' . $row['problemDetails'] . '</td><td align="left">' . $row['signedInTime'] . '</td></tr>';
			}
			
			echo '</table>';
			
		} else {
			echo '<p>fail.</p>';
		}
		
		echo '</div>';
		
		mysqli_close($dbc);
?>

</body>
</html>