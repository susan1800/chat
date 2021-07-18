<?php require_once "database/process.php"; ?>
<?php 
$user_id=$_SESSION['user_id'];
$password = $_SESSION['password'];
if($user_id != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE id = '$user_id'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($code != "0"){
            if($code != 0){
                die(header('Location: login/user-otp.php'));
            }
        }
    }
}else{
    header('Location: login/index.php');
}




?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<?php 
include "js/index.php";
?>


<?php
$oldpass=$_POST['pass1'];
$passresult="";
	$color="red";
	$passmessage="";
if(!empty($oldpass))
{
	
	$sql="SELECT password from usertable where id='$user_id'";
	$result   = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >0) 
     {
        while($row = mysqli_fetch_assoc($result)) 
        {
			$pass=$row['password'];
			if(password_verify($oldpass, $pass)){
				$newpass=$_POST['pass2'];
				$encpass = password_hash($newpass, PASSWORD_BCRYPT);
				$sql1 = "UPDATE usertable set password=\"$encpass\" where id=$user_id";
           if(mysqli_query($con,$sql1))
            {
            	$passresult="pssword update successfully  !!!";
            	$color="green";
            }
            else
            {
            	$passresult="error while updating password";
            }

				$passmessage="";
            
			}
			else
			{
				$passmessage="old password not match";
				$passresult="error while updating password";
			}
			
			// echo "";

		}
	}
	
}
?>





<!DOCTYPE html>
<html>
<head>
	<title>setting page</title>
    
</head>
<body>
  <style type="text/css">
.modal {

  display: all; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
  background-image: url(backgroundimage/setting.png);
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 30%; /* Could be more or less, depending on screen size */
  height: auto;
}

/* The Close Button */
.close a {
  
  color: crimson;
  float: right;
  font-size: 34px;
  font-weight: bold;
  color: red;
}

.close:hover a,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>








<link rel="stylesheet" type="text/css" href="css/chpass.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/checkpass.js"></script>



<div  class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class=" close"><a href="setting.php" style="text-decoration: none;">&times;</a></span>
      <div class="container_chpass">
      	<?php echo " <div style='color: $color;''><i>$passresult </i></div>"; ?>
<h3>Set Password</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >

 <div class="passwordbuttom">old Password </div>
<input type = "password" id = "initial" size = "10" name="pass1" onkeyup="return myFunction()" /><i><div style="float: right; color: red; font-size: 0.8em;"><?php echo "$passmessage"; ?></div></i>
<br/><br/>
<div class="passwordbuttom"> Confirm Password </div>
<input type="password" id = "second" size = "10" name="pass2" onkeyup="return myFunction()" /><i><div id="details" style="float: right; color: red; font-size: 0.8em;"></div></i>
<br/><br/>
<p>
<input type="reset" name = "reset"/> 
<t>
<input type="submit" name = "submit"/ onclick="return checksubmit()">
</t>
</p>
</form>
</div>
<script type="text/javascript">
//Set submit button onsubmit property to the event handler

</script>

  </div>

</div>
<div id="notification"></div>
</body>
</html>
