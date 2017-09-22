<?php
session_start();
$uid=$_SESSION["uid"]=$_POST['uid'];
$pwd=$_SESSION["pwd"]=$_POST['pwd'];
$conn =  mysqli_connect("localhost","root","","slotbooking")or die("Unable to Connect");
/*if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
*/
$sql="SELECT * FROM login where Username='$uid' and Password='$pwd'";
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);
if($count!=0){
	
	$query ="SELECT Role FROM login WHERE Username='$uid' ";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result))
	{
			$role=$row['Role'];
	}
	if($role == "Student")
	{
		 $_SESSION['uid']=$uid;
		 echo "<script>window.open('Main Page.php','_self')</script>"; 
	}
	else if($role == "Admin")
	{
		 $_SESSION['uid']=$uid;
		 echo "<script>window.open('alumini.php','_self')</script>"; 
	}
}
else
{
	
	$_SESSION['errMsg'] = "Invalid username or password";
	if(!empty($_SESSION['errMsg'])) 
	{
		$Message=$_SESSION['errMsg'];
		echo "<script type='text/javascript'>alert('$Message');</script>";		
	}
	unset($_SESSION['errMsg']);
	echo"<script>self.location = 'http://localhost/Internship/login.html';
</script>";
		
}

?>