 function notification()
  {

    $("#notification").load("notification.php");
    refresh();
  }


$(document).ready(function(){
      
  //create a new WebSocket object.
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
    var mcode = msg.messageid;

    // dom=document.getElementById("msg1").style;
    // dom.color='red';

    if((ucode == '<?php echo $user_id ?>') || (mcode == '<?php echo $user_id ?>'))
    {
      
    if((type == 'usermsg')&& (umsg!='typingend') && (umsg!='typing') && (umsg!='seenxyzseen'))
    {
       
      // refresh();
      $('#msg1').append(umsg);
      if((mcode=='<?php echo $user_id ?>') || (ucode=='<?php echo $user_id ?>'))
      {
        notification();
      }
    }
  }
  };

  websocket.onerror = function(ev){
};
  websocket.onclose   = function(ev){
};
});