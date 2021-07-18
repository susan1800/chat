
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


<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
	<link rel="stylesheet" type="text/css" href="css/profile.css">
  <link rel="stylesheet" type="text/css" href="css/modal.css">
	<style type="text/css">

</style>
</head>
<body>
	<?php
				$imageresult="";
				$fblinkresult="";
				$instalinkresult="";
				$bioresult="";
				$nameresult="";
                $hiddenvalue=$_POST['hiddenvalue'];
                if($hiddenvalue=="submit")
                {
                $hiddenvalue="gdfhgv";
                $image=$_FILES['profilepc']['name'];
                $name=$_POST['uname'];
                $fblink=$_POST['fblink'];
                $instalink=$_POST['instalink'];
                $bio=$_POST['bio'];
              if(!empty($image))
              {
              // echo "$image";
              $sql="SELECT * FROM userprofile where profilepc='$image'";
              $result   = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) >0) 
              {
              while($row = mysqli_fetch_assoc($result)) 
               {
                $randomcode=rand(0,99999999);
                $randomimage=$randomcode.$image;
                $sql="SELECT * FROM userprofile where profilrpc='$image'";
                $result   = mysqli_query($con, $sql);
               }
            }
            else
            {
                $randomimage=$image;
                $randomcode='';
            }
            $sql = "SELECT * from userprofile where id='$user_id'";
           $result   = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) >0) 
              {

              	 while($row = mysqli_fetch_assoc($result)) 
               {
               	$unlink=$row['profilepc'];
               	if(empty($profilepc))
               	{
               		$unlink="profilepic/".$unlink;
               		unlink($unlink);
               	}
               }



            $sql1 = "UPDATE userprofile set profilepc=\"$randomimage\" where id=$user_id";
           if(mysqli_query($con,$sql1))
            {
                  if (is_uploaded_file($_FILES['profilepc']['tmp_name'])) {
                 copy($_FILES['profilepc']['tmp_name'],"profilepic/$randomcode".$_FILES['profilepc']['name']);
                    }
                    $imageresult="update successfully";
                    $image="";
                }
            }
            else
            {

             $sql= "INSERT INTO userprofile(profilepc,id, bio , fblink , instalink) VALUES('$randomimage' , '$user_id',' ',' ',' ')";
                if(mysqli_query($con, $sql))
                         {
                         
                if (is_uploaded_file($_FILES['profilepc']['tmp_name'])) {
                 copy($_FILES['profilrpc']['tmp_name'],"profilepic/$randomcode".$_FILES['profilepc']['name']);
            }
            $imageresult="update successfully";
            $image="";

        }

        }

        }


        if(!empty($name))
              {
              // echo "$image";
              
            $sql = "UPDATE usertable set name=\"$name\" where id=$user_id";
           if(mysqli_query($con,$sql))
            {
                $nameresult="update successfully";
                $name="";
            }
    }
    if(!empty($bio))
    {
        $sql = "SELECT * from userprofile where id='$user_id'";
           $result   = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) >0) 
              {
                $sql1 = "UPDATE userprofile set bio=\"$bio\" where id=$user_id";
                if(mysqli_query($con,$sql1))
                {
                    $bioresult="update successfully";
                    $bio="";
                }
            }
            else
            {

             $sql= "INSERT INTO userprofile(profilepc,id, bio , fblink , instalink) VALUES(' ' , '$user_id', '$bio','',' ')";
                if(mysqli_query($con, $sql))
                         {
                            $bioresult="update successfully";
                            $bio="";
                         }
        }
    }
    if(!empty($fblink))
    {
        $split=str_split($fblink);
        $len=strlen('https://www.facebook.com');
        $check='';
        for($i=0;$i<$len;$i++)
        {
             $check=$check.$split[$i];
        }
        if($check=="https://www.facebook.com")
        {
            $sql = "SELECT * from userprofile where id='$user_id'";
           $result   = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) >0) 
              {
                $sql1 = "UPDATE userprofile set fblink=\"$fblink\" where id=$user_id";
                if(mysqli_query($con,$sql1))
                {
                    $fblinkresult="update successfully";
                    $fblink="";
                }
            }
            else
            {

             $sql= "INSERT INTO userprofile(profilepc,id, bio , fblink , instalink) VALUES('' , '$user_id',' ','$fblink',' ')";
                if(mysqli_query($con, $sql))
                         {
                            $fblinkresult="update successfully";
                            $fblink="";
                         }
        }

        }
        else
        {
        	 $fblinkresult="invalid link";
        }
        
    }
    if(!empty($instalink))
    {
        $split=str_split($fblink);
        $len=strlen('https://www.instagram.com');
        $check='';
        for($i=0;$i<$len;$i++)
        {
             $check=$check.$split[$i];
        }
        if($check=="https://www.instagram.com")
        {
            $sql = "SELECT * from userprofile where id='$user_id'";
           $result   = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) >0) 
              {
                $sql1 = "UPDATE userprofile set instalink=\"$instalink\" where id=$user_id";
                if(mysqli_query($con,$sql1))
                {
                    $instalinkresult="update successfully";
                     $instalink="";
                }
            }
            else
            {

             $sql= "INSERT INTO userprofile(profilepc,id, bio , fblink , instalink) VALUES('' , '$user_id',' ','','$instalink')";
                if(mysqli_query($con, $sql))
                         {
                            $instalinkresult="update successfully";
                            $instalink="";
                            // echo"<script>update successfully</script>";
                         }
        }

        }
        else
        {
        	 $instalinkresult="invalid link";
        }
        
    }
}   
        $profilepicture='';
        $sql1="SELECT profilepc from userprofile where id='$user_id'";
        $result1   = mysqli_query($con, $sql1);
              if (mysqli_num_rows($result1) >0) 
              {
                while($row = mysqli_fetch_assoc($result1)) 
                {
                    $profilepicture=$row['profilepc'];
                }

              }
              else
              {
              	echo "string";
              }
            if(empty($profilepicture))
            {
                $sql1="SELECT * from usertable where id='$user_id'";
                $result1   = mysqli_query($con, $sql1);
              if (mysqli_num_rows($result1) >0) 
              {
                while($row = mysqli_fetch_assoc($result1)) 
                {
                    $gender=$row['gender'];
                }
                if($gender=="1")
                    {
                        $profilepicture="m.png";
                    }
                    elseif($gender=="0")
                    {
                        $profilepicture="f.png";
                    }
                    else
                    {
                        $profilepicture="";
                    }
              }
              
        }
        $profilepicture="profilepic/".$profilepicture;
?>
	<div class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <a href="setting.php"><span class="close">&times;</span></a>
	<center>
		
			
<div class="box">
 <form  method="post" enctype='multipart/form-data'>
        
            <?php echo"<img src='$profilepicture'>";?>
            <input type="file" name="profilepc" id="profilepc" accept="image/*">
            <label for="profilepc">update picture</label><?php echo "<div class='imageresult'><i>$imageresult</i></div>"?>
            <input type="text" name="uname" placeholder="User Name"><?php echo "<div class='result'><i>$nameresult</i></div>"?>
            <input type="text" name="bio" placeholder="Something about you"><?php echo "<div class='result'><i>$bioresult</i></div>"?>
            <input type="text" name="fblink" placeholder="Facebook link"><?php echo "<div class='result'><i>$fblinkresult</i></div>"?>
            <input type="text" name="instalink" placeholder="instagram link"><?php echo "<div class='result'><i>$instalinkresult</i></div>"?>
            <input type="hidden" name="hiddenvalue" value="submit">
            <!-- <input type="text" name="" placeholder="Gender"> -->
            <button type="reset" style="float: left;margin: 10px 0 0 18.2%;" class="manageprofilebutton">Reset</button>
            <button type="submit" style="float: right;margin: 10px 18.2% 0 0;" class="manageprofilebutton">DONE</button>
        
    </form>
    </div>
    </center>
    <div id="notification"></div>
  
  <br><br>
  </div>
 

</div>
