<?php 
session_start();
if (!isset($_SESSION['uid'])) {
header('Location: login.html');

}

$conn =  mysqli_connect("localhost","root","","slotbooking")or die("Unable to Connect");

$sql = "SELECT * FROM slots  ";
$result = mysqli_query($conn,$sql);
?>
<html>
<head>
<body >
<center>
	<h2>Time Schedule </h2>
	<table border="1" cellspacing=2 , cellpadding =10 id ="thistable">
		<thead>
			<td> User Name </td>
			<td> Date </td>
			<td> Timings </td>
		</thead>
		  <?php
			$value = 0;
			while( $row = mysqli_fetch_array( $result ) )
			{
				echo
				"<tr>
				<td >{$row['Username']}</td>
				<td >{$row['Date1']}</td>
				<td >{$row['Timing1']}</td>
				</tr>\n";
			}

 ?>
	</table>
	
</body>
</html>
