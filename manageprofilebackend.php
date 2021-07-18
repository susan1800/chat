<?php
$updateresult="";
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
            $sql1 = "UPDATE userprofile set profilepc=\"$randomimage\" where id=$user_id";
           if(mysqli_query($con,$sql1))
            {
                  if (is_uploaded_file($_FILES['profilepc']['tmp_name'])) {
                 copy($_FILES['profilepc']['tmp_name'],"profilepic/$randomcode".$_FILES['profilepc']['name']);
                    }
                    $updateresult="update successfully";
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
            $updateresult="update successfully";
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
                $updateresult="update successfully";
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
                    $updateresult="update successfully";
                    $bio="";
                }
            }
            else
            {

             $sql= "INSERT INTO userprofile(profilepc,id, bio , fblink , instalink) VALUES(' ' , '$user_id', '$bio','',' ')";
                if(mysqli_query($con, $sql))
                         {
                            $updateresult="update successfully";
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
                    $updateresult="update successfully";
                    $fblink="";
                }
            }
            else
            {

             $sql= "INSERT INTO userprofile(profilepc,id, bio , fblink , instalink) VALUES('' , '$user_id',' ','$fblink',' ')";
                if(mysqli_query($con, $sql))
                         {
                            $updateresult="update successfully";
                            $fblink="";
                         }
        }

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
                    $updateresult="update successfully";
                     $instalink="";
                }
            }
            else
            {

             $sql= "INSERT INTO userprofile(profilepc,id, bio , fblink , instalink) VALUES('' , '$user_id',' ','','$instalink')";
                if(mysqli_query($con, $sql))
                         {
                            $updateresult="update successfully";
                            $instalink="";
                            // echo"<script>update successfully</script>";
                         }
        }

        }
        
    }
    if($updateresult=="update successfully")
    {
        $hiddenvalue="sdgserdf";
        $updateresult="dxfvbsrfd";
        $name="";
        $fblink="";
        $instalink="";
        $bio="";
        $image="";
        echo "<script>alert('update successfully');</script>";
        
        
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
            if(empty($profilepic))
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
 <form  method="post" enctype='multipart/form-data'>
        <div class="box">
            <?php echo"<img src='$profilepicture'>";?>
            <input type="file" name="profilepc" id="profilepc" accept="image/*">
            <label for="profilepc">update picture</label>
            <input type="text" name="uname" placeholder="User Name"><?php echo ""?>
            <input type="text" name="bio" placeholder="Something about you"><?php echo ""?>
            <input type="text" name="fblink" placeholder="Facebook link"><?php echo ""?>
            <input type="text" name="instalink" placeholder="instagram link"><?php echo ""?>
            <input type="hidden" name="hiddenvalue" value="submit">
            <!-- <input type="text" name="" placeholder="Gender"> -->
            <button type="reset" style="float: left;margin: 10px 0 0 18.2%;" class="manageprofilebutton">CANCEL</button>
            <button type="submit" style="float: right;margin: 10px 18.2% 0 0;" class="manageprofilebutton">DONE</button>
        </div>
    </form>
    </center>
  </div>

</div>