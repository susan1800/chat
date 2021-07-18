
<?php
include "../database/connection.php";

session_start();
$user_id=$_SESSION['user_id'];

$sql="SELECT numb from messagedetails where id='$user_id'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0)
{
	$i=0;
	$color="";
	while($row = mysqli_fetch_assoc($result))
	{
		$id=$row['numb'];
		if($id>0)
		{
			$i++;
			$color='blue;';
		}
	}
	if($i==0)
	{
		$i='';
	}
	echo "<div style='background:$color; padding:5px; border-radius:50%; float:right;'>$i";

}

?>