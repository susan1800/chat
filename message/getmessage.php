<?php
$messagecode=$messageid.$user_id;
$messagecode1=$user_id.$messageid;


$sql = "SELECT * FROM message where m_id='$messagecode'";
 $result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
    $i=1;
    $message = array();
    $code = array();
    $align=array();
   while($row = mysqli_fetch_assoc($result)) 
   {
    $message[$i]=base64_decode($row['message']);
    $code[$i]=$row['u_id'];
    $SN =$row['SN'];

   
    // echo "$message[$i]";
    if($code[$i]!=$user_id)
    {
        $align[$i] = "left";
        
    }
    else
    {
        $align[$i] = "right";
        
    }
    
    $i++; 
}
  
}
$sql = "SELECT * FROM message where m_id='$messagecode1'";
 $result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) 
{
    $i=1;
    $message = array();
    $code = array();
    $align=array();
   while($row = mysqli_fetch_assoc($result)) 
   {
    $message[$i]=base64_decode($row['message']);
    $code[$i]=$row['u_id'];
    $SN=$row['SN'];
    $br[$i]="";
    if(strlen($message[$i])>40)
    {
        
        $br[$i]='<br>';
    }
    if(strlen($message[$i])>80)
    {
        
        $br[$i]='<br><br>';
    }
   
    // echo "$message[$i]";
    if($code[$i]!=$user_id)
    {
        $align[$i] = "left";
        $color[$i] ="#bfbfbfbf";
        $marginl[$i]="0px";
        $marginr[$i]="20%";
    }
    else
    {
        $align[$i] = "right";
        $color[$i] ="blue";
        $marginl[$i]="20%";
        $marginr[$i]="0px";
    }    
    $i++; 
} 
}
?>