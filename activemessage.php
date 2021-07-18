<ul id="myMenu3">
			<?php
			include "database/connection.php";
			session_start();
			$messageid=$_GET['messageid'];
			$user_id=$_SESSION['user_id'];

			$combine=$user_id.$messageid;
			$combine1=$messageid.$user_id;
			// echo "$combine1 $combine <br><br>";
			$sql="SELECT * from messagedetails where m_id='$combine'";
				$result   = mysqli_query($con, $sql);
			  if (mysqli_num_rows($result) >0){
			  	$message="yes";
			  	$combine_code=$combine;
			  }else{$message="no";}
			  
		 	$sql="SELECT * from messagedetails where m_id='$combine1'";
				$result   = mysqli_query($con, $sql);
			  if (mysqli_num_rows($result) >0) {
			  	$message1="yes";
			  	$combine_code=$combine1;
			  }else{$message1="no";}

			  if(($message=="no") && ($message1=="no")){
			  	$sql="SELECT * from usertable where id='$messageid'";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
		   			$id=$row['id'];
		   			$gender=$row['gender'];
		   			if($id==$user_id){continue;}
		   			$status=$row['status'];
		   			if($status=='1'){
		   				$status='online';
		   				$color='green';
		   			}elseif ($status=='0') {
		   				$status='offline';
		   				$color='orange';
		   			}else{continue;}
		   			$name=$row['name'];
					$profilepic='';
			$sql1="SELECT profilepc from userprofile where id='$id'";
			$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) {
			  	while($row = mysqli_fetch_assoc($result1)){
			   		$profilepic=$row['profilepc'];
			   	}
			  }
			if(empty($profilepic)){
				$sql1="SELECT * from usertable where id='$id'";
				$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0){
			  	while($row = mysqli_fetch_assoc($result1)){
			   		$gender=$row['gender'];
			   	}
			   	if($gender=="1"){$profilepic="m.png";}elseif($gender=="0"){$profilepic="f.png";}else{$profilepic="";}
			  } 
		}

		$profilepic="profilepic/".$profilepic;
		   			echo "<li><a href='message.php?messageid=$id' >
				<img src='$profilepic' alt='$profilepic'>
				<div>
					<h2>$name</h2>
					<h3>
						<span class='status $color'></span>
						$status 
					</h3>
				</div>
				</li></a>";
			}
			}	
		}
			$sql0="SELECT * from messagedetails ORDER BY `datetimes` desc";
			$result0 = mysqli_query($con, $sql0);
			if (mysqli_num_rows($result0) > 0){
				$i=1;
				$k=1;
				$code=array();
				while($row = mysqli_fetch_assoc($result0)){
		   			$mid=$row['m_id'];
		   			$id1=$id2='';
		   			$split= str_split($mid);
		   			for($j=0;$j<15;$j++){
		   				$id1=$id1.$split[$j];
		   			}
		   			for($j=15;$j<30;$j++){
		   				$id2=$id2.$split[$j];
		   			}
		   			$skip="";
		   			for($j=1;$j<$k;$j++){
		   				if($code[$j]==$mid){
		   					$skip="skip";
		   					break;
		   				}else{$skip="";}
		   			}
		   			if($skip=="skip"){continue;}
		   			if(($id1==$user_id)){
		   		$sql="SELECT * from usertable where id='$id2'";
					$result = mysqli_query($con, $sql);
					if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
		   			$gender=$row['gender'];
		   			$status=$row['status'];
		   			if($status=='1'){
		   				$status='online';
		   				$color='green';
		   			}elseif ($status=='0') {
		   				$status='offline';
		   				$color='orange';
		   			}else{continue;}
		   			$name=$row['name'];
					$messagesql="SELECT numb from messagedetails where m_id='$mid' AND id='$user_id'";
					$messageresult   = mysqli_query($con, $messagesql);
					  if (mysqli_num_rows($messageresult) >0) {
					  	$num='';
					  	while($row = mysqli_fetch_assoc($messageresult)) {
				   			$num=$row['numb'];	
					  }
					  }else {$num='';}
					  if($num>0){
					  	$background="#bfbfbf";
					  	$padding='5px';
					  } else{
					  	$background="";
					  	$num='';
					  	$padding='0px';
					  }
		   			$profilepic='';
				$sql1="SELECT profilepc from userprofile where id='$id2'";
				$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0){
			  	while($row = mysqli_fetch_assoc($result1)){
			   		$profilepic=$row['profilepc'];
			   	}
			  }
			if(empty($profilepic)){
				$sql1="SELECT * from usertable where id='$id2'";
				$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) {
			  	while($row = mysqli_fetch_assoc($result1)) {
			   		$gender=$row['gender'];
			   	}
			   	if($gender=="1"){$profilepic="m.png";}elseif($gender=="0"){$profilepic="f.png";}else{$profilepic="";}
			  }
				}
				$profilepic="profilepic/".$profilepic;
		   		echo "<li><a href='message.php?messageid=$id2' >
				<img src='$profilepic' alt='$profilepic'>
				<div>
					<h2>$name<span style='float:right; text-align:right;background:blue; border-radius:50%; padding:$padding; margin-left:10px;'>$num</span></h2>
					<h3><span class='status $color'></span>$status</h3>
				</div>
				</li></a>";
			$i++;
			}
			}
		   }
		   	elseif(($id2==$user_id)){
		   	$sql="SELECT * from usertable where id='$id1'";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
		   			$gender=$row['gender'];
		   			$status=$row['status'];
		   			if($status=='1'){
		   				$status='online';
		   				$color='green';
		   			}elseif ($status=='0') {
		   				$status='offline';
		   				$color='orange';
		   			}else{continue;}
		   			$name=$row['name'];
		   				$messagesql="SELECT numb from messagedetails where m_id='$mid' AND id='$user_id'";
					$messageresult   = mysqli_query($con, $messagesql);
					  if (mysqli_num_rows($messageresult) >0) {
					  	$num='';
					  	while($row = mysqli_fetch_assoc($messageresult)) {
				   			$num=$row['numb'];
					  }
					  }else{$num='';}
					  if($num>0){
					  	$background="#bfbfbf";
					  	$padding='5px';
					  }else{
					  	$background="";
					  	$num='';
					  	$padding='0px';
					  }
		   			$profilepic='';
				$sql1="SELECT profilepc from userprofile where id='$id1'";
				$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) {
			  	while($row = mysqli_fetch_assoc($result1)) {
			   		$profilepic=$row['profilepc'];
			   	}

			  }
			if(empty($profilepic)){
				$sql1="SELECT * from usertable where id='$id1'";
				$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) {
			  	while($row = mysqli_fetch_assoc($result1)) {
			   		$gender=$row['gender'];
			   	}
			   	if($gender=="1"){$profilepic="m.png";}elseif($gender=="0"){$profilepic="f.png";}else{$profilepic="";}
			  } 
		}
			$profilepic="profilepic/".$profilepic;
		   	echo "<li style='background:$background;'><a href='message.php?messageid=$id1' >
				<img src='$profilepic' alt='$profilepic'>
				<div>
					<h2>$name<span style='float:right; text-align:right;background:blue; border-radius:50%; padding:$padding; margin-left:10px;'>$num</span></h2>
					<h3><span class='status $color'></span>$status </h3>
				</div>
				</li></a>";
			$i++;
			}
		}
	}
	$code[$k]=$mid;
	$k++;
	}
}
?>