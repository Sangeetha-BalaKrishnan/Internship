<?php
session_start();
	unset($_SESSION['uid']);
	if (!isset($_SESSION['uid'])) 
	{
	session_destroy();
	header('Location: login.html');
	}
	else{
		echo "Error: " . $res . "<br>" . mysqli_error($con);
		
	}

?>