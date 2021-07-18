<?php
if(!empty($user_message) && !empty($user_code) && !empty($message_code))
    {
                $user_message_encode = base64_encode ($user_message);//encode the user message
                $combinemessagecode = $message_code.$user_code;//generate message is combining two user id and message id
                $combinemessagecode1 = $user_code.$message_code;//generate message is combining two user id and message id
                
                $sql1="SELECT * from message where m_id='$combinemessagecode1'";
                $result1 = mysqli_query($con, $sql1);
                if (mysqli_num_rows($result1) > 0) 
                {
                    $message="result1";
                }


                $sql ="SELECT * from message where m_id='$combinemessagecode'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) 
                {
                    $message="result";
                }

                if($message=="result1")
                {
                    $combinecode=$combinemessagecode1;
                    
                }
                elseif ($message=="result") {
                    $combinecode=$combinemessagecode;
                    
                }
                else
                {
                    $combinecode=$combinemessagecode1;
                }
                $date = date("Y-m-d G:i:s");

                     if(($user_message!="typing") && ($user_message!="typingend") && ($user_message!="seenxyzseen"))
                {
                
                
                     $sql = "INSERT INTO message(message,m_id,u_id) VALUES ('$user_message_encode' , '$combinecode','$user_code')";
                     if(mysqli_query($con, $sql))
                     {

                    echo "Record inserted successfully";




                    
                    $sql1 = "SELECT * FROM messagedetails where m_id='$combinecode' AND id='$message_code'";
                     $result = mysqli_query($con, $sql1);
                    if (mysqli_num_rows($result) > 0) 
                    {
                    while($row = mysqli_fetch_assoc($result)) 
                       {
                        $id=$row['numb'];
                       }

                       if(!empty($id))
                       {
                        $id=$id+1;
                       }
                       else
                       {
                        $id=1;
                       }
                       $sql0="UPDATE messagedetails set numb=\"$id\" , datetimes=\"$date\" where m_id='$combinecode' AND id='$message_code'";
                       if(mysqli_query($con,$sql0))
                       {
                        //upgrade details of message when user send message
                       }
                       else
                   {
                    
                    $id='1';
                    $sql1 = "INSERT INTO messagedetails (m_id,id,datetimes,numb) VALUES ('$combinecode','$message_code','$date','$id;')";
                     if(mysqli_query($con, $sql1))
                     {
                        
                   }//insert details of message when user send message
                   }

                    }
                     else
                   {
                    
                    $id='1';
                    $sql1 = "INSERT INTO messagedetails (m_id,id,datetimes,numb) VALUES ('$combinecode','$message_code','$date','$id;')";
                     if(mysqli_query($con, $sql1))
                     {
                        //insert details of message when user send message
                   }
                   else{
                    
                   }
               }

                }
                    else
                    {
                    echo "Could not insert record: ". mysqli_error($con);
                    } 
                }
                else
                {
                     $sql1 = "SELECT * FROM messagedetails where m_id='$combinecode'";
                     $result = mysqli_query($con, $sql1);
                    if (mysqli_num_rows($result) > 0) 
                    {
                    while($row = mysqli_fetch_assoc($result)) 
                       {
                       }


                    
                    $sql0="UPDATE messagedetails set numb=\"0\" where m_id='$combinecode' AND id='$user_code'";
                       if(mysqli_query($con,$sql0))
                       {
                        //upgrade message details if user seen the message
                        
                        

                       }
                   }
                     
                }
                
            }
    else
    {
        
    }
?>