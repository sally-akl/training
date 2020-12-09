const socket = io('http://localhost:3000/');

var sender = $("input[name='sender']").val();
var receiver =  $("input[name='receiver']").val();
var viewer_type = $("input[name='viewer_type']").val();
socket.emit("beginChat",{sender:sender});

$(".chat_text_box").on('change keyup paste mouseup', function() {
    socket.emit("Typing" , {sender:sender , receiver:receiver});
});
$( ".chat_text_box" ).blur(function() {
     socket.emit("stopTyping" , {sender:sender , receiver:receiver});
});
$(".send_btn").on("click",function(){
    var message = $(".chat_text_box").val();
    var submit_form_url = $("input[name='submit_form_url']").val();
    var sender_img = $("input[name='sender_img']").val();
    var sender_name = $("input[name='sender_name']").val();
    var date = new Date();
    var month = parseInt(date.getMonth())+1;
    var hour = parseInt(date.getHours())+1;
    var minutes = parseInt(date.getMinutes())+1;
    var date_str = date.getFullYear()+"-"+month+"-"+date.getDate()+" "+hour+" : "+minutes;
    $(".chat_text_box").val("");
    formData = new FormData();
    formData.append('sender',sender);
    formData.append('receiver',receiver);
    formData.append('msg',message);
    formData.append('booking',$("input[name='booking']").val());
    $.ajax({
              url: submit_form_url,
              type: "POST",
              data: formData,
              async: false,
              dataType: 'json',
              success: function (response) {
              },
            error : function( data )
            {

            },
            cache: false,
            contentType: false,
            processData: false
    });
    var html = "";

    html = '<div class="chat-message-left pb-4">';
    html +='<div>';
      if(viewer_type == "trainer")
        html +='<img src="'+sender_img+'" class="rounded-circle mr-1" alt="'+sender_name+'" width="40" height="40">';
      else
        html +='<span class="avatar avatar-xl" style="width: 3rem;height: 3rem;font-size: 1rem;">'+sender_img+'</span>';
    html +='<div class="text-muted small text-nowrap mt-2">'+date_str+'</div>';
    html +='</div>';
    html +='<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">';
    html +='<div class="font-weight-bold mb-1">'+sender_name+'</div>';
    html += message;
    html +='</div>';
    html +='</div>';

    $(".chat-messages").append(html);
    socket.emit("message" , {sender:sender , receiver:receiver,msg:message,img:sender_img,sender_name:sender_name,date:date_str,viewer_type:viewer_type});
});
socket.on("Typing" , function(data){
  if(data.receiver == sender)
     $(".is_typing").css("display","block");
});
socket.on("stopTyping" , function(data){
  if(data.receiver == sender)
    $(".is_typing").css("display","none");
});
socket.on("message" , function(data){
  if(data.receiver == sender)
  {
    console.log(data.viewer_type);
    var html = "";
    html = '<div class="chat-message-right pb-4">';
    html +='<div>';
      if(data.viewer_type == "trainer")
        html +='<img src="'+data.img+'" class="rounded-circle mr-1" alt="'+data.sender_name+'" width="40" height="40">';
      else
        html +='<span class="avatar avatar-xl" style="width: 3rem;height: 3rem;font-size: 1rem;">'+data.img+'</span>';
    html +='<div class="text-muted small text-nowrap mt-2">'+data.date+'</div>';
    html +='</div>';
    html +='<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">';
    html +='<div class="font-weight-bold mb-1">'+data.sender_name+'</div>';
    html += data.msg;
    html +='</div>';
    html +='</div>';
    $(".chat-messages").append(html);

  }

});
