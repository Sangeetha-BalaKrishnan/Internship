<?php 
session_start();
if (!isset($_SESSION['uid'])) {
header('Location: Login.html');
}
?>
<html>
<body>
<center><br><br><br>
	<table cellpadding=10>
	<tr>
	<td><a href="notification.php" target="three"><button>Notification</button></a>
	</td>
	</tr>
	<tr>
	<td><a href="Booked_Slots.php" target ="three"><button>Slots</button></a></td>
	</tr>
	<tr>
	<td><a href="Logout.php" target ="_parent"><button>Logout</button></a></td>
	</tr>
	</table>
</body>
</html>