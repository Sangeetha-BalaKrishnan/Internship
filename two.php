<html>
<body bgcolor="#dddddd">
<h3 style="color:Aqua">Date:<B id ="CurrentDate"></B> <br/>
Day:<B id="CurrentDay"></B>
</h3>
<h3 align="right"><a href="Logout.php"><button>Logout</button></a></h3>
<?php
$date = $time = "";
$dateErr = $dateTimeErr = $timeErr = "";
date_default_timezone_set('Asia/Kolkata');
		$today = date('Y-m-d');
		$NewDate = date('Y-m-d', strtotime(' + 7 days'));
		$CurrentDate = date($_POST["date_slot"]);
		
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
  if (empty($_POST["date_slot"])) {
		$dateErr = "Date is Required";
	}
	else{
		
		if($CurrentDate < $NewDate)
		{
			if($CurrentDate > $today){
				$date=test_input($_POST["date_slot"]);
			}
			else{
				$dateTimeErr ="inavlid date";
			}
		}
		
		else {
			$dateTimeErr = "The Slot Can be Booked a One a Week in advance";
		}

	}
  if (empty($_POST["slot"])) {
		$timeErr = "time is Required";
	}
	else{
		$time = test_input($_POST["slot"]);
	}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<center>
<h2>Alumini Time Schedule</h2>
<p>Student Booking Slots For Alumini</p>
<br>
<br>
<form method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table border=2, cellpadding=15,height=100,width=100 >
	<tr >
		<td>Set the Date<td>
		<input type="date" id="date_slot" name="date_slot">
		<?php 
		if($dateErr != NULL){
				echo "<script>alert('$dateErr')</script>";
		}
		if($dateTimeErr != NULL){
				echo "<script>alert('$dateTimeErr')</script>";
		}
		
		?>
		
		</td></td>
	</tr>
	<tr>
		<td>Set the time
		<td>
			<input type="radio" name="slot" value="1pm-2pm">1pm-2pm<br>
			<input type="radio" name="slot" value="4pm-5pm">4pm-5pm<br>
			<input type="radio" name="slot" value="6pm-7pm">6pm-7pm <br>
			<?php 
			if($timeErr != NULL){
				echo "<script>alert('$timeErr')</script>";
			}
			?>
			
		</td>
		</td>
	</tr>
	<tr>
		<td colspan = 2>
		<input type="submit" id="submit" value="submit"/>
		</td>
	</tr>
</table>
</form>
<?php
	$conn =  mysqli_connect("localhost","root","","slotbooking")or die("Unable to Connect");
	$uid = $_SESSION['uid'];
	$Date_slot = $_POST['date_slot'];
	$timing = $_POST['slot'];
	$query ="SELECT Booked FROM slots WHERE `S.No` = (SELECT MAX( `S.No` ) FROM slots ) ";
 	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result))
	{
		$Booked=$row['Booked'];
	}
	if(($CurrentDate < $NewDate)&&($CurrentDate > $today))
	{
		if(($Date_slot != 0)&&($timing != 0))
		{	
			if($Booked != "NO")
			{
				echo"<script>alert('Previous Booked Slot has not been Confirmed yet');</script>";
	
			}
			else
			{	
				$result = mysqli_query($conn ,"SELECT Student FROM alumini WHERE Student = $uid");
				$count=mysqli_num_rows($result);
				if($count <= 2)
				{
					$sql = "INSERT INTO Slots (`Username`, `Date1`, `Timing1`) VALUES ('$uid','$Date_slot','$timing' );";
					if (mysqli_query($conn, $sql)) 
					{	
						echo "<script>alert('Successfully The slot is allocated for the alumini')</script>";
					}
					else 
					{
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}
				else
				{
					echo "<script>alert('You have already Allocated Two schedules')</script>";
				}
			}
		}
	}
	
?>

<script>
	var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yy =  today.getFullYear();
		var today = dd +'/'+mm+'/'+yy;
		var day = new Date();
		var weekday = new Array(7);
		weekday[0] =  "Sunday";
		weekday[1] = "Monday";
		weekday[2] = "Tuesday";
		weekday[3] = "Wednesday";
		weekday[4] = "Thursday";
		weekday[5] = "Friday";
		weekday[6] = "Saturday";
			document.getElementById("CurrentDate").innerHTML = today;
			document.getElementById("CurrentDay").innerHTML= weekday[day.getDay()];
    
</script>
</body>
</html>


