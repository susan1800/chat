
<style>

</style>

<?php
include "../database/dbconnect.php";
session_start();
$id=$_SESSION['user_id'];

$sql="SELECT * from user where status='1'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
{
while($row = mysqli_fetch_assoc($result)) 
   {
   	$userid=$row['user_id'];
   	if($id==$userid)
   	{
   		continue;
   	}
   	$name=$row['firstname']." ".$row['lastname'];
echo "<br><a href='home.php?messageid=$userid' style='text-decoration:none; color:black; background:#bfbfbf; padding:10px;  '>$name</a> <br><br>";

}
}
?>


