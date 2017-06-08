<?PHP
session_start();
if ((isset($_SESSION['login']) && $_SESSION['login'] = '1')) {
header ("Location: profile.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KSC Device Registration</title>
</head>

<body>

<form action="login.php" method="post">

<?php # Script handle_login.php

if (($_REQUEST['schoolUsername'] == "mnr") AND ($_REQUEST['schoolPassword'] == "************")) {
	
$schoolUsername = $_REQUEST['schoolUsername'];
$schoolPassword = $_REQUEST['schoolPassword'];

$_SESSION['schoolUsername'] = $_REQUEST['schoolUsername'];
$_SESSION['schoolPassword'] = $_REQUEST['schoolPassword'];

$_SESSION['login'] = "1";

header("Location:profile.php");

}elseif  (($_REQUEST['schoolUsername'] == "") OR ($_REQUEST['schoolPassword'] == "")){

}else{
	session_destroy();
	echo '<p id="error">Incorrect Login</p>';
	//header ("Location: login.php");
}

?>

<p><label>Username: <input type="text" name="schoolUsername" size="20" maxlength="40" required/></label></p>

<p><label>Password: <input type="password" name="schoolPassword" size="20" maxlength="40" required/></label></p>

<p><input type="submit" name="Login" value="Login" /></p>

</form>



</body>
</html>