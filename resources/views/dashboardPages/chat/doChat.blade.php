@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')   
    <style>
    #progress-wrp {
      border: 1px solid #0099CC;
      padding: 1px;
      position: relative;
      height: 30px;
      border-radius: 3px;
      margin: 10px;
      text-align: left;
      background: #fff;
      box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
    }

    #progress-wrp .progress-bar {
      height: 100%;
      border-radius: 3px;
      background-color: #f39ac7;
      width: 0;
      box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
    }

    #progress-wrp .status {
      top: 3px;
      left: 50%;
      position: absolute;
      display: inline-block;
      color: #000000;
    }
    </style>
    <div class="content-wrapper">
        <div class="p-3 p-md-4">
            <div class="wrapper">
                <div class="wrapper-title">
                    <span>Chat with <b>{{ucfirst($to_chat->firstname)}} {{ucfirst($to_chat->lastname)}}</b></span>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
            				<div class="modal-body">

            					<section class="message">
                                    <div class="chat-box">
                                        <div class="chat-body inner-scroll chat-body">
                                            @foreach($chatHistory as $key=>$value)
                                                @if($value->type == "file")
                                                <div class="message-block" data-id="{{$value->id}}">
                                                    <div class="media-thumb sm rounded-circle">
                                                        @if($value['getUsers']->image != "")
                                                        <img src="{{$value['getUsers']->image}}">
                                                        @else
                                                        <img src="{{url('assets/avatar.jpg')}}">
                                                        @endif
                                                    </div>
                                                    <div class="message-body">
                                                        <div class="messageTime">{{date_format(date_create($value->created_at),"h:m:s A")}}</div>
                                                        <div class="userName">{{ucfirst($value['getUsers']->firstname)}} {{ucfirst($value['getUsers']->lastname)}}</div>
                                                        <div class="messageContent">
                                                            <div class="messageText">
                                                                <span style="font-size: 40px;"><a href="{{$value->path}}"><i style="color:white;" class="material-icons-outlined">get_app</i></a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="message-block" data-id="{{$value->id}}">
                                                    <div class="media-thumb sm rounded-circle">
                                                        @if(isset($value['getUsers']->image) && $value['getUsers']->image != "")
                                                        <img src="{{$value['getUsers']->image}}">
                                                        @else
                                                        <img src="{{url('assets/avatar.jpg')}}">
                                                        @endif
                                                    </div>
                                                    <div class="message-body">
                                                        <div class="messageTime">{{date_format(date_create($value->created_at),"h:m:s A")}}</div>
                                                        <div class="userName">{{ucfirst($value['getUsers']->firstname)}} {{ucfirst($value['getUsers']->lastname)}}</div>
                                                        <div class="messageContent">
                                                            <div class="messageText">
                                                                <span>{{$value->message}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach

                                          <!-- <div class="message-block">
                                                <div class="media-thumb sm rounded-circle">
                                                    @if($from_chat->image != "")
                                                    <img src="{{$from_chat->image}}">
                                                    @else
                                                    <img src="{{url('assets/avatar.jpg')}}">
                                                    @endif
                                                </div>
                                                <div class="message-body">
                                                    <div class="messageTime">9:46 AM</div>
                                                    <div class="userName">{{$from_chat->firstname}} {{$from_chat->lastname}}</div>
                                                    <div class="messageContent">
                                                        <div class="messageText">
                                                            <span>Hi Everyone!</span>
                                                            <span>Joseph here from California</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="chat-footer">
                                            <!-- <form class="form"> -->
                                                <div class="input-group input-group-inner">
                                                    <input type="text" class="form-control" id="message" name="message" placeholder="Type a message">
                                                    <span class="input-group-append pr-3">
                                                        <button type="button" class="input-group-text" onclick="addAttachment();" data-toggle="tooltip" title="Send File">
                                                            <i class="material-icons-outlined">attach_file</i>
                                                        </button>
                                                        <input type="file" name="attachment" id="attachment" style="display: none;">
                                                        <!-- <button type="button" class="input-group-text">
                                                            <i class="material-icons-outlined">mic_none</i>
                                                        </button> -->
                                                        <button type="button" class="input-group-text ml-2" onclick="sendMessage();" data-toggle="tooltip" title="Send Text Message">
                                                            <i class="material-icons-outlined">arrow_forward</i>
                                                        </button>

                                                        <a href="{{url('/dashboard/appointment/videomeeting')}}/{{$value->id}}" class="input-group-text ml-2" data-toggle="tooltip" title="Video Call"><i class="material-icons-outlined">video_call</i></a>
                                                    </span>
                                                </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </section>
            				</div>
            			</div>
            		</div>
            	</div>
            </div>
</div>

@endsection

@section('script')
<script>
    var last_id = "";
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            sendMessage();
        }
    });

    $(document).ready(function(){
        
    });

    function addAttachment(){
        $('#attachment').click();
    }

    function sendMessage(){
        var msg=$('#message').val();
        var room_id="{{$room->id}}";
        $.ajax({
          url:"{{ route('Dashboard.Chat.Send') }}",
          method:"GET",
          data:{'msg':msg,'room_id':room_id},
          success:function(data){ 
            // last_id = data.last_chat_id;
            // var html = "";
            // html +=  '<div class="message-block" data-id="'+last_id+'">';
            // html +=  '<div class="media-thumb sm rounded-circle">';
            //             @if($from_chat->image != "")
            // html +=  '<img src="{{$from_chat->image}}">';
            //             @else
            // html +=  '<img src="{{url('assets/avatar.jpg')}}">';
            //             @endif
            // html +=  '</div>';
            // html +=  '        <div class="message-body">';
            // html +=  '            <div class="messageTime">'+new Date().toLocaleTimeString();+'</div>';
            // html +=  '            <div class="userName">{{ucfirst($from_chat->firstname)}} {{ucfirst($from_chat->lastname)}}</div>';
            // html +=  '            <div class="messageContent">';
            // html +=  '                <div class="messageText">';
            // html +=  '                    <span>'+msg+'</span>';
            // html +=  '                </div>';
            // html +=  '            </div>';
            // html +=  '        </div>';
            // html +=  '    </div>';
            // $('.chat-body').append(html);
            getMessage();
            $('#message').val('');
          }
        });
    }

    function getMessage(){
        var room_id="{{$room->id}}";
        var last_msg_id=$('.message-block:last').data('id');
        $.ajax({
          url:"{{route('Dashboard.Chat.GetResponse')}}",
          method:"GET",
          data:{room_id:room_id,last_msg_id:last_msg_id},
          success:function(data){ 
            $.each(data.chatHistory, function(key,value) {
                if(value.type == "file"){
                    var html = "";
                    html +=  '<div class="message-block" data-id="'+value.id+'">';
                    html +=  '<div class="media-thumb sm rounded-circle">';
                    html +=  '<img src="'+value.profile_image+'">';
                    html +=  '</div>';
                    html +=  '        <div class="message-body">';
                    html +=  '            <div class="messageTime">'+value.recevied_time+'</div>';
                    html +=  '            <div class="userName">'+value.full_name+'</div>';
                    html +=  '            <div class="messageContent">';
                    html +=  '                <div class="messageText">';
                    html +=  '                    <span style="font-size: 40px;"><a href="'+value.path+'"><i class="material-icons-outlined" style="color:white;">get_app</i></a></span>';
                    html +=  '                </div>';
                    html +=  '            </div>';
                    html +=  '        </div>';
                    html +=  '    </div>';
                    $('.chat-body').append(html);
                }else{
                    var html = "";
                    html +=  '<div class="message-block" data-id="'+value.id+'">';
                    html +=  '<div class="media-thumb sm rounded-circle">';
                    html +=  '<img src="'+value.profile_image+'">';
                    html +=  '</div>';
                    html +=  '        <div class="message-body">';
                    html +=  '            <div class="messageTime">'+value.recevied_time+'</div>';
                    html +=  '            <div class="userName">'+value.full_name+'</div>';
                    html +=  '            <div class="messageContent">';
                    html +=  '                <div class="messageText">';
                    html +=  '                    <span>'+value.message+'</span>';
                    html +=  '                </div>';
                    html +=  '            </div>';
                    html +=  '        </div>';
                    html +=  '    </div>';
                    $('.chat-body').append(html);
                }
            });
          }
        });
    }

    setInterval(function(){ getMessage(); }, 18000);

    //
    $("#attachment").on("change", function (e) {      
        e.preventDefault();

        var myformData = new FormData();        
        myformData.append('file', $('#attachment')[0].files[0]);

        // $("#UpdateMessage5").html("Uploading file ....");
        $(".message").css("background","url(../include/images/loaderIcon.gif) no-repeat right");
        var _token = $('input[name="_token"]').val();

        myformData.append('mode', 'fileUpload');
        myformData.append('type', $('#attachment').val());
        myformData.append('_token',_token); 
        myformData.append('room_id',"{{$room->id}}");

        $.ajax({
            url: "{{url(route('Dashboard.Chat.FileUpload'))}}",
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: myformData,
            enctype: 'multipart/form-data',
            success: function(response){ 
                $(".message").css("background","");
                getMessage();
                $('#message').val('');
                console.log("file successfully submitted");
            },error: function(){
                console.log("not okay");
            }
        });
    });

</script>
@endsection