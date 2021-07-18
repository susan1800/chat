<?php
include "database/connection.php";
session_start();
$user_id=$_SESSION['user_id'];
if(!empty($user_id))
{
	$sql = "UPDATE usertable set status=\"0\" where id=$user_id";
	 if(mysqli_query($con,$sql))
	 {
	 	// echo "dfhgdbfx";
	}
}





session_destroy();
die(header('Location: login/index.php'));
?>