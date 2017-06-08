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
$schoolUsername = $_SESSION['schoolUsername'];
echo "<p>Welcome <b>$schoolUsername</b>.</p>";

if(!empty($_SESSION['registered'])) {
	$message = $_SESSION['registered'];
    echo "$message";
	unset($_SESSION['registered']);
}

echo '<p>These are your currently signed in devices.</p>';
?>


<?PHP
		// Make query.
		$q = "SELECT deviceType, problemDetails, signedInTime, CASE WHEN status = 1 THEN 'Bring to IT Office' END AS statusText FROM StudentForm WHERE schoolUsername = '$schoolUsername' AND status != 0 ORDER BY ID ASC";
				
		require ('../sql_connection.php'); // Connect to DB.
		
		// Run query.
		$r = @mysqli_query ($dbc, $q);
		
		if ($r) {
			echo '<table align="centre" cellspacing="3" cellpadding="3" width="75%">
			<tr><td class="header" align="left"><b>Device</b></td><td class="header" align="left"><b>Details</b></td><td class="header" align="left"><b>Signed In</b></td><td class="header" align="left"><b>Status</b></td></tr>';
			
			while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
				echo '<tr><td align="left">' . $row['deviceType'] . '</td><td align="left">' . $row['problemDetails'] . '</td><td align="left">' . $row['signedInTime'] . '</td><td align="left">' . $row['statusText'] . '</td></tr>';
			}
			
			echo '</table>';
			
		} else {
			echo '<p>fail.</p>';
		}
		
		mysqli_close($dbc);
?>

</body>
</html>