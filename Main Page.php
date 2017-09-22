<?php 
session_start();
if (!isset($_SESSION['uid'])) {
header('Location: login.html');

}
	$conn =  mysqli_connect("localhost","root","","slotbooking")or die("Unable to Connect");
	$query ="SELECT Booked FROM slots WHERE `S.No` = (SELECT MAX( `S.No` ) FROM slots ) ";
 	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result))
	{
		$booked=$row['Booked'];
	}
	mysqli_close($conn);
	if($booked != "NO")
	{
		require "one.php";
	}
	else{
		include "two.php";
	}
	?>
	