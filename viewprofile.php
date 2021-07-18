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
    header('Location: ../project/login/index.php');
}


$profileid=$_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/viewprofile.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<?php 
include "js/index.php";
?>
</head>
<body>


<?php
$sql="SELECT * from usertable where id='$profileid'";
$result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) 
      {
      while($row = mysqli_fetch_assoc($result))
      {
        $name=$row['name'];
        $gender=$row['gender'];
      }
}
    $profilepic='';
    $bio="";
    $sql1="SELECT * from userprofile where id='$profileid'";
    $result1   = mysqli_query($con, $sql1);
        if (mysqli_num_rows($result1) >0) 
        {
          while($row = mysqli_fetch_assoc($result1)) 
          {
            $profilepic=$row['profilepc'];
            $bio=$row['bio'];
            $fblink=$row['fblink'];
            $instalink=$row['instalink'];
          }

        }
     
        $sql1="SELECT * from usertable where id='$profileid'";
        $result1   = mysqli_query($con, $sql1);
        if (mysqli_num_rows($result1) >0) 
        {
          while($row = mysqli_fetch_assoc($result1)) 
          {
            $gender=$row['gender'];
            $dob=$row['dob'];
            $date=date('Y-m-d');

          }

           if(empty($profilepic))
      {
          if($gender=="1")
            {
              $profilepic="m.png";
            }
            elseif($gender=="0")
            {
              $profilepic="f.png";
            }
            else
            {
              $profilepic="";
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
        
    
    $profilepic="profilepic/".$profilepic;

echo"
<div class='card'>
<p><a href='homepage.php'><button class='viewprofilebutton'>back to home</button></a></p>
  <img src='$profilepic' alt='John' style='width:100%'>
  <h1>$name</h1>
  <p class='title'>$bio </p>
  <p class='title'>Sex : $gender</p>
  <p class='title'>Age : $dob $date</p>
  <div style='margin: 24px 0;'>  ";

if(!empty($fblink))
{
  echo "<a href='$fblink' target='blank'><i class='fa fa-facebook'></i></a>";
}


if(!empty($instalink))
{
  echo "<a href='$instalink' target='blank'><i class='fa fa-instagram'></i></a>";
}
    
     
  echo"</div>";
 if($profileid!=$user_id)
 {
  $href="message.php?messageid=$profileid";
 }
 else
 {
  $href='message.php';
 }
 echo "<a href='$href'><button class='viewprofilebutton'> Message</button></a>";
 echo "</div>";
?>



<div id="notification"></div>


</body>
</html>
