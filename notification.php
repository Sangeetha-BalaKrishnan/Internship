<?php 
session_start();
if (!isset($_SESSION['uid'])) {
header('Location: login.html');

}

$conn =  mysqli_connect("localhost","root","","slotbooking")or die("Unable to Connect");

$sql = "SELECT * FROM slots WHERE `S.No` = (SELECT MAX( `S.No` ) FROM slots ) and `Booked` = NO ";
$result = mysqli_query($conn,$sql);
?>
<html>
<head>
<body >
<center>
	<h2>Time Slots  By the Students </h2>
	<table border="1" cellspacing=2 , cellpadding =10 id ="thistable">
		<thead>
			<td> User Name </td>
			<td> Date </td>
			<td> Timings </td>
			<td> Selection </td>
		</thead>
		  <?php
			$value = 0;
			while( $row = mysqli_fetch_array( $result ) )
			{
				$name = $row['Username'];
				$date = $row['Date1'];
				$timing = $row['Timing1'];
		
				echo
				"<tr>
				<td >{$row['Username']}</td>
				<td >{$row['Date1']}</td>
				<td >{$row['Timing1']}</td>
				<td><button onClick = '". $value = 1  ." '> Confirm </button>
				<button onClick = '". $value = 1  ." '>Cancel</button></td> 
				</tr>\n";
			}

 ?>
	</table>
	<?php
		if($value = 1){
		if($date != 0){
		$query = "INSERT INTO alumini VALUES ('$date', '$timing', '$name');";
		$results = mysqli_query($conn,$query);
		$query1="UPDATE `slots` SET `Booked` = 'Yes' WHERE `S.No` = (SELECT MAX( `S.No` ) FROM slots ) ;";
		$results = mysqli_query($conn , $query1);
		$query2 = "DELETE FROM `slots` WHERE `Booked` = NO";
		$results = mysqli_query($conn , $query2);
		}
		}
		else
		{	
			$query3 ="DELETE * from `slots` WHERE `S.No` = (SELECT MAX( `S.No` ) FROM slots )";
			$results = mysqli_query($conn ,$query3 );
		}
	?>
	
</body>
</html>
