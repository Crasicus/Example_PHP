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
<title>Untitled Document</title>
</head>

<body>

<?php include("../sql_connection.php"); ?>
<?php include("includes/header.php"); ?>


<form action="handle_work_form.php" method="post">
<fieldset><legend>Enter your information in the form below</legend>

<p><label>Job ID: </label></p>

<p><label>School Username: </label></p>

<p><label>School Password: </label></p>

<p><label>Device Username: </label></p>

<p><label>Device Password: </label></p>

<p><label>House: </label></p>

<p><label>Details of Problem:</label></p>

<p><label>Work Required:</label></p>

<p><label>Notes:</label></p>

<p><label>Signed In By:</label></p>

<p><label>Work Carried Out:<br />
<textarea name="workDone" rows="4" cols="100"></textarea></label></p>

<p><label>Work Done By: <br />
<select name="workBy" multiple>
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

<p><input type="submit" name="update" value="Save" /><input type="submit" name="update" value="Save and Email" /></p>

</form>

</body>
</html>