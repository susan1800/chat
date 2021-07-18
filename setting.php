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
    die(header('Location: login/index.php'));
}




?>




<!DOCTYPE html>
<html>
<head>
	<title>setting page</title>
	<link rel="stylesheet" type="text/css" href="css/setting.css">
    <link rel="stylesheet" type="text/css" href="css/viewprofile.css">
    
</head>
  <style type="text/css">
.modal {

  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
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
.close {
  
  color: crimson;
  float: right;
  font-size: 34px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
  function messagenotification(){
  // alert("dfghb");
    setInterval(function(ev){
        $("#messagenotification").load("message/messagenotification.php");
        refresh();

      });
    // alert("dfghb");
  }
</script>
<?php 
include "js/index.php";
?>
<body onload="messagenotification()">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 
	<div class="container">
        <div class="navbar">
  <a  href="homepage.php"><i class="fa fa-fw fa-home"></i> Home</a>
  
  <a href="#" class="active"><i class="fa fa-fw fa-gear"></i> setting</a>
  <a href=' <?php echo "viewprofile.php?id=$user_id";?>'><i class="fa fa-fw fa-user"></i> profile</a>
  <a  href="message.php"><i class="fa fa-fw fa-msg"></i> Message <i id="messagenotification"></i></a>
  <a href="logout.php" class="right"><i class="fa fa-fw fa-mars"></i> Log out</a>
</div>
        <div class="vertical-menu">
        </div>


        <div class="vertical-menu">
        <a href="manageprofile.php">Manage Profile</a>
        <a href="#" id="myBtn1" onmouseover="module(1)">View Profile</a>
        <!-- profile2.html -->
        <a href="chpass.php">Change Password</a>
        <!-- chkpass.html -->
        <a href="logout.php">SignOut</a>
 
    </div>










<div id="myModal1" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close1 close">&times;</span>
    <div class="card">
  <?php
$sql="SELECT * from usertable where id='$user_id'";
$result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) 
      {
      while($row = mysqli_fetch_assoc($result))
      {
        $name=$row['name'];
        $gender=$row['gender'];
      }
}
$profilepicview='';
    $sql1="SELECT * from userprofile where id='$user_id'";
    $result1   = mysqli_query($con, $sql1);
        if (mysqli_num_rows($result1) >0) 
        {
          while($row = mysqli_fetch_assoc($result1)) 
          {
            $profilepicview=$row['profilepc'];
            $bioview=$row['bio'];
            $fblinkview=$row['fblink'];
            $instalinkview=$row['instalink'];
          }

        }
     
        $sql1="SELECT * from usertable where id='$user_id'";
        $result1   = mysqli_query($con, $sql1);
        if (mysqli_num_rows($result1) >0) 
        {
          while($row = mysqli_fetch_assoc($result1)) 
          {
            $gender=$row['gender'];
            $dob=$row['dob'];
            getdate();
          }

           if(empty($profilepicview))
      {
          if($gender=="1")
            {
              $profilepicview="m.png";
            }
            elseif($gender=="0")
            {
              $profilepicview="f.png";
            }
            else
            {
              $profilepicview="";
            }
        }
        if($gender=="1")
            {
              $gender="Male";
            }
            elseif($gender=="0")
            {
              $gender="Female";
            }
            else
            {
              $gender="Other";
            }
      }
        
    
    $profilepicview="profilepic/".$profilepicview;

echo"
<div class='card'>
  <img src='$profilepicview' alt='John' style='width:100%'>
  <h1>$name</h1>
  <p class='title'>$bioview </p>
  <p class='title'>Sex : $gender</p>
  <p class='title'>Age : $dob  (milauna baki)</p>
  <div style='margin: 24px 0;'>  ";

if(!empty($fblinkview))
{
  echo "<a href='$fblinkview' target='blank'><i class='fa fa-facebook'></i></a>";
}


if(!empty($instalinkview))
{
  echo "<a href='$instalinkview' target='blank'><i class='fa fa-instagram'></i></a>";
}
    
     
  echo"</div>";

 echo "<a href='message.php'><button class='viewprofilebutton'> Message</button></a>";
 echo "</div>";
?>
</div>
  </div>

</div>












<!-- <script src="js/module.js"></script> -->
<!-- <script src="js/checkpassword.js"></script> -->
<script type="text/javascript">
function module(x)
  {
  
    // Get the modal
var modal = document.getElementById("myModal"+x);

// Get the button that opens the modal
var btn = document.getElementById("myBtn"+x);

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close"+x)[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
}
</script>




<div id="notification"></div>
</body>
</html>