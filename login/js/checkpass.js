       function checkpass()
{
    var pass;
  pass = document.getElementById("pass").value;
  var len= pass.length
  if(len<8)
  {
    if(len==0)
    {
        document.getElementById('msg').innerHTML= ' ';
        return true;
    }
    else
    {
        document.getElementById('msg').innerHTML= 'password less than 8 character';
        return false;
    }

  }
  else
  {
    document.getElementById('msg').innerHTML= ' ';
    return true;
  }
}
function checksubmit()
{
    var x=document.getElementById("pass").value;
            if((x==""))
            {
                return false;
            }
            else if(x.length<8)
            {
                return false;
            }
            else if(x.length>12)
            {
                return false;
            }
            else
            {
                return true;
            }
}