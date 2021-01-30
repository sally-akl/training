const socket = io('http://localhost:3000/');

var sender = $("input[name='sender']").val();
var receiver =  $("input[name='receiver']").val();
var viewer_type = $("input[name='viewer_type']").val();
var viewer_type_in= $("input[name='viewer_type_in']").val();
socket.emit("beginChat",{sender:sender});

$(".attachment_img").on("change",function(e)
{
  console.log("enter thereeee");
  var submit_form_url = $("input[name='submit_form_img_url']").val();
  var sender_img = $("input[name='sender_img']").val();
  var sender_name = $("input[name='sender_name']").val();

  var date = new Date();
  var month = parseInt(date.getMonth())+1;
  var hour = parseInt(date.getHours())+1;
  var minutes = parseInt(date.getMinutes())+1;
  var date_str = date.getFullYear()+"-"+month+"-"+date.getDate()+" "+hour+" : "+minutes;
  $(".chat_text_box").val("");


  var file = e.target.files[0];
  var img  = URL.createObjectURL(file);
  var fd = new FormData();
  fd.append('image', file);
  fd.append('sender',sender);
  fd.append('receiver',receiver);
  fd.append('booking',$("input[name='booking']").val());

  $.ajax({
            url: submit_form_url,
            type: "POST",
            data: fd,

            success: function (response) {

              console.log(response);
              var html = "";
              if(viewer_type_in == "dashboard")
              {
                html = '<div class="chat-message-left pb-4">';
                html +='<div>';
                html +='<img src="'+sender_img+'" class="rounded-circle mr-1" alt="'+sender_name+'" width="40" height="40">';
                html +='<div class="text-muted small text-nowrap mt-2">'+date_str+'</div>';
                html +='</div>';
                html +='<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">';
                html +='<div class="font-weight-bold mb-1">'+sender_name+'</div>';
                html += '<img src="'+img+'" alt="">';
                html +='</div>';
                html +='</div>';
              }
              else
              {
                html = '<div class="user-msg">';
                html += '<div class="msg-content">';
                html += '<img src="'+img+'" alt="">';
                html += '<span>'+date_str+'<small><i class="fas fa-check-double"></i></small></span>';
                html +='</div>';
                html +='</div>';
              }

              $(".chat-messages").append(html);
              socket.emit("message" , {sender:sender , receiver:receiver,msg:$("input[name='main_img_url']").val()+response,img:sender_img,sender_name:sender_name,date:date_str,viewer_type:viewer_type,viewer_type_in:viewer_type_in,send_type_att:"image"});

            },
          error : function( data )
          {

          },
          cache: false,
          contentType: false,
          processData: false
  });




});

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
    if(viewer_type_in == "dashboard")
    {
      html = '<div class="chat-message-left pb-4">';
      html +='<div>';
      html +='<img src="'+sender_img+'" class="rounded-circle mr-1" alt="'+sender_name+'" width="40" height="40">';
      html +='<div class="text-muted small text-nowrap mt-2">'+date_str+'</div>';
      html +='</div>';
      html +='<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">';
      html +='<div class="font-weight-bold mb-1">'+sender_name+'</div>';
      html += message;
      html +='</div>';
      html +='</div>';
    }
    else
    {
      html = '<div class="user-msg">';
      html += '<div class="msg-content">';
      html += '<p>'+message+'</p>';
      html += '<span>'+date_str+'<small><i class="fas fa-check-double"></i></small></span>';
      html +='</div>';
      html +='</div>';
    }

    $(".chat-messages").append(html);
    socket.emit("message" , {sender:sender , receiver:receiver,msg:message,img:sender_img,sender_name:sender_name,date:date_str,viewer_type:viewer_type,viewer_type_in:viewer_type_in,send_type_att:"text"});
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
    console.log(data.viewer_type_in);

    var sent_msg_is = data.msg;
    if(data.send_type_att == "image")
    {
       console.log(data.msg);
       sent_msg_is = data.msg;
    }

    var html = "";
    if(data.viewer_type_in != "dashboard")
    {
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
      if(data.send_type_att != "image")
        html += sent_msg_is;
      if(data.send_type_att == "image")
         html += '<img src="'+sent_msg_is+'" alt="">';

      html +='</div>';
      html +='</div>';
    }
    else
    {
       if(data.viewer_type == "trainer")
       {
         html = '<div class="coach-msg d-flex">';
         html += '<img src="'+data.img+'" class="coach-msg-img align-self-center" alt="">';
         html += '<div class="msg-content align-self-center">';
         if(data.send_type_att != "image")
           html += '<p>'+sent_msg_is+'</p>';
         if(data.send_type_att == "image")
            html += '<img src="'+sent_msg_is+'" alt="">';
         html += '<span>'+data.date+'</span>';
         html +='</div>';
         html +='</div>';
       }
       else{

         html = '<div class="user-msg">';
         html += '<div class="msg-content">';
         if(data.send_type_att != "image")
            html += '<p>'+sent_msg_is+'</p>';
         if(data.send_type_att == "image")
            html += '<img src="'+sent_msg_is+'" alt="">';
         html += '<span>'+data.date+'<small><i class="fas fa-check-double"></i></small></span>';
         html +='</div>';
         html +='</div>';

       }

    }
    $(".chat-messages").append(html);
  }

});
