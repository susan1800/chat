
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
    header('Location: /login/index.php');
}

?>


<link rel="stylesheet" href="css/homepage.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





<aside>
		<header>
			<input type="text" id="mySearch0" onkeyup="myFunction(0)" placeholder="Search.." title="Type in a category">
		</header>

<ul id="myMenu0">
			<?php
			$sql="SELECT * from usertable";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) 
			{
				$i=1;
				$id=array();
				$status=array();
				// $color=array();
				$name=array();
				while($row = mysqli_fetch_assoc($result)) 
		   		{
		   			$id[$i]=$row['id'];
		   			if($id[$i]==$user_id)
		   			{
		   				continue;
		   			}
		   			$status[$i]=$row['status'];
		   			if($status[$i]=='1')
		   			{
		   				$status[$i]='online';
		   				$color[$i]='green';
		   			}
		   			elseif ($status[$i]=='0') {
		   				$status[$i]='offline';
		   				$color[$i]='orange';
		   			}
		   			else
		   			{
		   				continue;
		   			}
		   				$name[$i]=$row['name'];
		   				if($status[$i]=='online')
		   			
		   			{
		   				$profilepic='';
		$sql1="SELECT profilepc from userprofile where id='$id[$i]'";
		$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) 
			  {
			  	while($row = mysqli_fetch_assoc($result1)) 
			   	{
			   		$profilepic=$row['profilepc'];
			   	}

			  }
			if(empty($profilepic))
			{
				$sql1="SELECT * from usertable where id='$id[$i]'";
				$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) 
			  {
			  	while($row = mysqli_fetch_assoc($result1)) 
			   	{
			   		$gender=$row['gender'];
			   	}
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
			  
		}
		$profilepic="profilepic/".$profilepic;

		   			echo "<li><a href='viewprofile.php?id=$id[$i]' >
				<img src='$profilepic' alt='avatar'>
				<div>
					<h2>$name[$i]</h2>
					<h3>
						<span class='status $color[$i]'></span>
						$status[$i]
					</h3>
				</div>
				</li></a>";
		}
			$i++;
		}
		echo "</ul></aside>";
		echo "<main><header>
			<input type='text' id='mySearch1' onkeyup='myFunction(1)' placeholder='Search..' title='Type in a category'>
		</header><ul id='myMenu1'>";
		for($j=1; $j<$i; $j++)
	{
		$profilepic='';
		$sql1="SELECT profilepc from userprofile where id='$id[$j]'";
		$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) 
			  {
			  	while($row = mysqli_fetch_assoc($result1)) 
			   	{
			   		$profilepic=$row['profilepc'];
			   	}

			  }
			if(empty($profilepic))
			{
				$sql1="SELECT * from usertable where id='$id[$j]'";
				$result1   = mysqli_query($con, $sql1);
			  if (mysqli_num_rows($result1) >0) 
			  {
			  	while($row = mysqli_fetch_assoc($result1)) 
			   	{
			   		$gender=$row['gender'];
			   	}
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
			  
		}
		$profilepic="profilepic/".$profilepic;
		echo "
			<li><a href='viewprofile.php?id=$id[$j]'>
				<img src='$profilepic' alt='avatar'>
				<div>
					<h2>$name[$j]</h2>
					<h3>
						<span class='status $color[$j]'></span>
						$status[$j] 
					</h3>
				</div>
			</li></a>";
	}
	echo "</ul></main>";
	}
			?>



		<script>
function myFunction(x) {
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch"+x);
  filter = input.value.toUpperCase();
  ul = document.getElementById("myMenu"+x);
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>