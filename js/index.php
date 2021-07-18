<script type="text/javascript">
	 function notification()
  {

    $("#notification").load("notification.php");//load notification.php on id notification
    refresh();
  }


$(document).ready(function(){

 // setInterval(function(){
        
 //        $("#messagenotification").load("message/messagenotification.php");
 //        refresh();
          
 //      });
      
  //create a new WebSocket object.

var wsUri = "ws://localhost:80/project/server/server.php";
  websocket = new WebSocket(wsUri);
var msg1=$('#chat');
  websocket.onopen = function(ev) { // connection is open
     //notify user
     seen();
     

    msg1.append("Connected! " +  '<br>');

  }



  
  var wsUri = "ws://localhost:5000/project/server/server.php";
  websocket = new WebSocket(wsUri);
  websocket.onopen = function(ev) { // connection is open
     $('#msg1').append('connected');
  }
  //#### Message received from server?
  websocket.onmessage = function(ev) {
    var msg = JSON.parse(ev.data); //PHP sends Json data
    var type = msg.type; //message type
    var umsg = msg.message; //message text
    var ucode = msg.code;//code
    var mcode = msg.messageid;//message code

    if((ucode == '<?php echo $user_id ?>') || (mcode == '<?php echo $user_id ?>'))
    {
      
    if((type == 'usermsg')&& (umsg!='typingend') && (umsg!='typing') && (umsg!='seenxyzseen'))
    {
       
      $('#msg1').append(umsg);
      if((mcode=='<?php echo $user_id ?>') || (ucode=='<?php echo $user_id ?>'))
      {
        notification();//call notification function
      }
    }
  }
  };

  websocket.onerror = function(ev){
};
  websocket.onclose   = function(ev){
};
});
</script>