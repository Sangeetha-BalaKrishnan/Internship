<?php 
session_start();
if (!isset($_SESSION['uid'])) {
header('Location: login.html');

}
?>
<html>
<head>
<frameset cols="250,*" frameborder="2" name="framename" border="0" frameborder="0">
	<frame src="Link.php" name="second" scrolling="no">
	<frame src="welcome.php" name="three">
	</frameset>
</head>
</html>
