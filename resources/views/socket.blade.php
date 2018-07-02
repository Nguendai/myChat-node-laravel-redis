@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
    <div class="__inner-main clearfix">
            <div id="messages" style="width: 100%;height: 116px;overflow-y: auto;">
                @foreach($messages as $data)
                <p id="{{$data->id}}">
                    <strong >{{$data->author}}
                    </strong>:{{$data->messages}}
                </p>
                @endforeach
            </div>
            <hr>
            <!-- <form action="" method="post"> -->
                <input type="" name="channel" id="channel" value="{{$channel}}" hidden>
               <div class="form-group">
                <p>Messages</p>
                <textarea name="content" id="content" cols="30" rows="1"  placeholder="Can I help you?" class="form-control" required ></textarea>
            </div>
            <button id="send" class="btn btn-primary pull-right">Send</button>
            <!-- </form> -->
        </div>
        </div>
    </div>
</div>
        <script src="http://localhost:8080/demo-chat/public/js/socket.io.js"></script>
        <script
        src="http://localhost:8080/demo-chat/public/js/jquery-1.12.4.js"
        integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
        crossorigin="anonymous"></script>
        <script  type="text/javascript">
            var socket = io('http://localhost:7001');
            // console.log(socket);
            socket.on('chat:message',function(data){
            if($('#'+data.id).length == 0){
                console.log('123'+data);
                $('#messages').append('<p><strong>'+data.author+'</strong>:'+data.messages+'</p>');
            }else{
                console.log('da co tin nhắn');
            }
            
        })
            $(document).ready(function(){

                $('#send').click(function(){
                  var channel = $('#channel').val();
                  var url = 'send';

                  var messages = $('#content').val();
                  if(messages == ''){
                    alert('mời bạn nhập nội dung');
                  }else{
                    $.ajax({
                        url: url,
                        data: {
                        messages:messages,
                        channel:channel
                        },
                        dataType: 'text',
                        type:'POST',
                        success: function(response){
                            var data = JSON.parse(response);
                            // console.log(data);
                            $('#content').val('');
                        }
                    });
                  }
                });

            });
        </script>

@endsection

   

    