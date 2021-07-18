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
$messageid=$_GET['messageid'];
?>
<script src="js/search.js"></script>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/message.css">
</head>
<body onload='seen()' >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script language="javascript" type="text/javascript">
	code1 = '<?php echo $user_id ?>';


	
	
$(document).ready(function(){

	function refreshmessage()
			{
				var set = setInterval(function(){
				
				$("#autodata").load("activemessage.php?messageid=<?php echo $messageid ?>"+'#autodata');
				refresh();
					
			});

			setTimeout(function(){
					clearInterval(set);
				},300);
			}

	function notification()
	{
		$("#notification").load("notification.php");
		refreshmessage();
	}

			function seen()
			{
				var seen='seenxyzseen';
		 var msg = {
			message: seen,
			code : '<?php echo $user_id ?>',
			messageid: '<?php echo $messageid ?>'
			};
			//convert and send data to server
			websocket.send(JSON.stringify(msg));
			}

			

	//create a new WebSocket object.
	//var wsUri = "ws://localhost:9000/demo/server.php";
	var wsUri = "ws://localhost/project/server/server.php";
	websocket = new WebSocket(wsUri);
var msg1=$('#chat');
	websocket.onopen = function(ev) { // connection is open
		 //notify user
		 seen();
		 

		msg1.append("Connected! " +  '<br>');

	}
	var wsUri = "ws://localhost:5000/project/server/server.php";
	websocket = new WebSocket(wsUri);
var msg1=$('#chat');
	websocket.onopen = function(ev) { // connection is open
		 //notify user
		 seen();
		 

		msg1.append("Connected! " +  '<br>');

	}

	$('#send-btn').click(function(){ //use clicks message send button
		var mymessage = $('#message').val(); //get message text
		
		if((mymessage == "") || (mymessage == " ") || (mymessage == "  ") || (mymessage == "   ") || (mymessage == "    ")){ //emtpy message?
			// alert("Enter Some message Please!");
			return false;
		}
		


		//prepare json data
		var msg = {
		message: mymessage,
		code : '<?php echo $user_id ?>',
		messageid: '<?php echo $messageid ?>'
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
		
	});





	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var umsg = msg.message; //message text
		var ucode = msg.code;//code
		var mcode = msg.messageid;
		var aa='<?php echo $messageid ?>'

		// if(aa='')
		// {

		// 	alert("dghbxd");
		// 	if((ucode == '<?php //echo $user_id ?>') || (mcode == '<?php //echo $user_id ?>'))
  //   {
      
  //   if((type == 'usermsg')&& (umsg!='typingend') && (umsg!='typing') && (umsg!='seenxyzseen'))
  //   {
       
  //     // refresh();
  //     $('#msg1').append(umsg);
  //     if((mcode=='<?php //echo $user_id ?>') || (ucode=='<?php //echo $user_id ?>'))
  //     {
  //       notification();
  //     }
  //   }
  // }
		// }



		if(ucode == code1)
		{
			var classes="me";
			// $name=$username;
		}
		else
		{
			var classes="you";
		// $name=$username;
		}
		if(((ucode == '<?php echo $user_id ?>') && (mcode == '<?php echo $messageid ?>')) || ((mcode == '<?php echo $user_id ?>') && (ucode == '<?php echo $messageid ?>')))
		{
			
		if((type == 'usermsg'))
		{
			if((umsg!='typingend') && (umsg!='typing') && (umsg!='seenxyzseen'))
			{
			
			
			
			
			
			msg1.append('<li class="'+classes+'"><div class="entete"><span class="status "></span></div><div class="message">'+umsg+'</div></li>');
			document.getElementById("msg0").innerHTML='';
			refreshmessage();
			if(mcode=='<?php echo $user_id ?>')
			{

			notification();
		}
			seen();

			if($ucode == '<?php echo $user_id ?>')
			{
				$('#message').val('');
			}
			
	}
			
		}
		if((umsg=='typing') && (ucode=='<?php echo $messageid ?>'))
			{
				document.getElementById("msg0").innerHTML='typing...';
				
			}
			if((umsg=='typingend')&& (ucode=='<?php echo $messageid ?>'))
			{
				document.getElementById("msg0").innerHTML='';
				
			}
			if((umsg=='seenxyzseen') && (ucode=='<?php echo $messageid ?>'))
			{
				document.getElementById("msg0").innerHTML='seen';
			
			}
	}



	if((ucode == '<?php echo $user_id ?>') || (mcode == '<?php echo $user_id ?>'))
		{
			if((type == 'usermsg'))
		{
			if((umsg!='typingend') && (umsg!='typing') && (umsg!='seenxyzseen'))
			{
			// msg1.append('<li class="'+classes+'"><div class="entete"><span class="status "></span></div><div class="message">'+umsg+'</div></li>');
			notification();
			refreshmessage();
	}
}
			
	}

		

		//User hits enter key 
	$( "#message" ).on( "keydown", function( event ) {
	  if(event.which==13){
		
		// send_message();
		var mymessage = $('#message').val(); //get message text

		if(mymessage == ""){ //emtpy message?
			// alert("Enter Some message Please!");
			return false;
		}

		//prepare json data
		var msg = {
		message: mymessage,
		code : '<?php echo $user_id ?>',
		messageid: '<?php echo $messageid ?>'

		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	}
	});

	

		// $('#message').val(''); //reset text
		$('#msg')[0].scrollTop = $('#msg')[100].scrollHeight; //scroll message 
	};

	websocket.onerror	= function(ev){
	msg1.append("Error Occurred - "+ev.data + '<br>');

};
	websocket.onclose 	= function(ev){
	msg1.append("Connection Closed" + '<br>');
};
});
function onkey()
	{
		var mymessage = $('#message').val();
		// alert("xb");
		if(mymessage.length > 0)
		{

		var msg = {
		message: 'typing',
		code : '<?php echo $user_id ?>',
		messageid: '<?php echo $messageid ?>'

		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	}
	if(mymessage.length==0)
		{

		var msg = {
		message: 'typingend',
		code : '<?php echo $user_id ?>',
		messageid: '<?php echo $messageid ?>'

		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	}
	}


</script>
<div id="notification" style="width: 0px;"></div>
<div id="container">

<div class="navbar">
  <a  href="homepage.php"><i class="fa fa-fw fa-home"></i> Home</a>
  
  <a href="setting.php"><i class="fa fa-fw fa-gear"></i> setting</a>
  <a href=' <?php echo "viewprofile.php?id=$user_id";?>'><i class="fa fa-fw fa-user"></i> profile</a>
  <a class="active" href="#"><i class="fa fa-fw fa-msg"></i> Message </a>
  <a href="logout.php" class="right"><i class="fa fa-fw fa-mars"></i> Log out</a>
</div>
	
	<aside>
		<header>
			<input type="text" id="mySearch3" onkeyup="myFunction(3)" placeholder="Search.." title="Type in a category">

		</header>
		






		<div id="autodata">
		<ul id="myMenu3">
			<?php

			$combine=$user_id.$messageid;
			$combine1=$messageid.$user_id;
			$sql="SELECT * from messagedetails where m_id='$combine'";
				$result   = mysqli_query($con, $sql);
			  if (mysqli_num_rows($result) >0){
			  	$message="yes";
			  	$combine_code=$combine;
			  }
			  else{$message="no";}
			  
		 	$sql="SELECT * from messagedetails where m_id='$combine1'";
				$result   = mysqli_query($con, $sql);
			  if (mysqli_num_rows($result) >0) {
			  	$message1="yes";
			  	$combine_code=$combine1;
			  }
			  else{$message1="no";}

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
		   			}
		   			elseif ($status=='0') {
		   				$status='offline';
		   				$color='orange';
		   			}
		   			else{continue;}
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
			   	if($gender=="1"){$profilepic="m.png";}
			   		elseif($gender=="0"){$profilepic="f.png";}
			   		else{$profilepic="";}
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
		   				}
		   				else{$skip="";}
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
		   			}
		   			elseif ($status=='0') {
		   				$status='offline';
		   				$color='orange';
		   			}
		   			else{continue;}
		   			$name=$row['name'];
					$messagesql="SELECT numb from messagedetails where m_id='$mid' AND id='$user_id'";
					$messageresult   = mysqli_query($con, $messagesql);
					  if (mysqli_num_rows($messageresult) >0) {
					  	$num='';
					  	while($row = mysqli_fetch_assoc($messageresult)) {
				   			$num=$row['numb'];	
					  }
					  }
					  else {$num='';}
					  if($num>0){
					  	$background="#bfbfbf";
					  	$padding='5px';
					  }
					  else{
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
			   	if($gender=="1"){$profilepic="m.png";}
			   	elseif($gender=="0"){$profilepic="f.png";}
			   	else{$profilepic="";}
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
		   			}
		   			elseif ($status=='0') {
		   				$status='offline';
		   				$color='orange';
		   			}
		   			else{continue;}
		   			$name=$row['name'];
		   				$messagesql="SELECT numb from messagedetails where m_id='$mid' AND id='$user_id'";
					$messageresult   = mysqli_query($con, $messagesql);
					  if (mysqli_num_rows($messageresult) >0) {
					  	$num='';
					  	while($row = mysqli_fetch_assoc($messageresult)) {
				   			$num=$row['numb'];
					  }
					  }
					  else{$num='';}
					  if($num>0){
					  	$background="#bfbfbf";
					  	$padding='5px';
					  }
					  else{
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
			   	if($gender=="1"){$profilepic="m.png";}
			   		elseif($gender=="0"){$profilepic="f.png";}
			   		else{$profilepic="";}
			  } 
		}
			$profilepic="profilepic/".$profilepic;
		   	echo "<li style='background:$background;'><a href='message.php?messageid=$id1'>
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



</ul>
</div>







</aside>

			
	<main>
		<header>
			<?php
			$sql="SELECT name,gender from usertable where id='$messageid'";
	$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) 
			{
	while($row = mysqli_fetch_assoc($result)) 
		   	{
		   		$name=$row['name'];
		   		$gender=$row['gender'];
		   	}
		   }
		   else
		   {
		   	$name='';
		   }
		   if(!empty($messageid))
		   {
		   $profilepicture='';
		$sql="SELECT * from userprofile where id='$messageid'";
		$result   = mysqli_query($con, $sql);
			  if (mysqli_num_rows($result) >0) 
			  {
			  	while($row = mysqli_fetch_assoc($result)) 
			   	{
			   		$profilepicture=$row['profilepc'];
			   	}

			  }
			if(empty($profilepicture))
			{
				$sql="SELECT * from usertable where id='$messageid'";
				$result   = mysqli_query($con, $sql);
			  if (mysqli_num_rows($result) >0) 
			  {
			  	while($row = mysqli_fetch_assoc($result)) 
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
	}
			?>
			<img src='<?php echo "$profilepicture"; ?>' alt=''>
			<div>
				<h2><?php echo $name; ?></h2>
			</div>
		</header>
		
		<ul id="chat">
<?php


if(empty($messageid))
{
	echo"<div class='center'> Welcome TO message  </div>";
				exit();
}

include 'message/getmessage.php';



for($j=1;$j<$i;$j++)
{
	
	if($align[$j]=="right")
	{
		$class="me";
	}
	if($align[$j]=="left")
	{
		$class="you";
	}
	echo"<li class='$class'>
				<div class='message'>
					$message[$j]
				</div></li>";

}
?>
<div id="msg"></div>





			
		</ul><div id="msg0"></div><div id="seen" style="float: right;"></div>

		<footer>
			<textarea placeholder="Type your message" wrap="physical" style="overflow: hidden;" id="message" onkeyup ="onkey()" ></textarea>
			<button style="float: right;" id="send-btn">Send</button>
			<!-- <input type="text" id="message" onkeyup="onkeypress();"> -->
		</footer>
	</main>
</li>
</div>

</body>

</html>