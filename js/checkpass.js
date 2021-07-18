function myFunction() {
  var pass1 , pass2;
  pass1 = document.getElementById("initial").value;
  pass2 = document.getElementById("second").value;
  if((pass1==pass2))
  {

  	document.getElementById('details').innerHTML= 'Password is same';
  	return false;
  	
	}

else
{
	if(pass2.length<8)
  {
    if(pass2.length==0)
    {
      document.getElementById('details').innerHTML= ' ';
      return false;
    }
    else
    {
      document.getElementById('details').innerHTML= 'password less than 8 character';
      return false;
    }

  }
  else
  {
    document.getElementById('details').innerHTML= ' ';
    return true;
  }

}
}
// function checkpass()
// {
// 	var pass1;
//   pass1 = document.getElementById("initial").value;
//   var msg1=$('#check');
//   var len= pass1.length
//   if(len<8)
//   {
//   	if(pass1.length==0)
//   	{
//   		document.getElementById('check').innerHTML= ' ';
//   		return true;
//   	}
//   	else
//   	{
//   		document.getElementById('check').innerHTML= '';
//   		return false;
//   	}

//   }
//   else
//   {
//   	document.getElementById('check').innerHTML= ' ';
//   	return true;
//   }
// }
function checksubmit()
{
	var x=document.getElementById("initial").value;
  	var y = document.getElementById("second").value;
			if((y==""))
			{
				return false;
			}
			else if(y.length<8)
			{
				return false;
			}
			else if(y.length>16)
			{
				
				return false;
			}
      else if(x==y)
      {
        return false;
      }
			else
			{
				return true;
			}
}