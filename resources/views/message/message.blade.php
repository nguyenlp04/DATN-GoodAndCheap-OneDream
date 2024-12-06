@extends('layouts.client_layout')
@section('content')

<link rel="stylesheet" href="{{ asset('message/css.css') }}">
    @php
        $loggedIn_userId = auth()->user()->user_id;
        $loggedIn_userName = auth()->user()->full_name;
    @endphp
<main class="content-message">
    <div class="container p-0">
        <h1 class="h3 m-3">Messages</h1>
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right" >


                    <div  id="conversations" class="list-user-mess  d-md-block"  >

                        @foreach ($data as $item )
                        <a    class="list-group-item list-group-item-action border-0  user-item"  data-id="{{$item['user']->user_id}}" data-name="{{$item['user']->full_name}}">
                            <div class="d-flex align-items-start">
                                @if ($item['user']->image_user == null)
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Jennifer Chang" width="40" height="40">
                                @else
                                <img src="{{ asset($item['user']->image_user) }}" class="rounded-circle mr-1" alt="Jennifer Chang" width="40" height="40">
                                @endif
                                <div class="flex-grow-1 ml-3">
                                    {{ $item['user']->full_name }}
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div id="border-bottom" class="py-2 px-4 d-lg-block">
                        <div class="d-flex align-items-center py-1">

                            <div class="position-relative d-none" id="recipientimgContainer"   >
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                            </div>
                            <div class="flex-grow-1 pl-3 d-none" id="recipientNameContainer"  >
                                <strong id="recipient-name-display"></strong>
                                {{-- <div class="text-muted small"><em>Typing...</em></div> --}}
                            </div>

                            <div>
                                <button id="togglecvn" class="btn btn-light border btn-lg px-3 d-lg-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <div id="chat-container" class="chat-messages p-4" style="min-height: 380px;">
                            <h3 class="text-center content-cente"> You haven't selected any conversations yet</h3>
                        </div>
                    </div>
                    <div id="showinput" class="flex-grow-0 py-3 px-4 border-top d-none" >
                        <div class="input-group">
                            <input type="text" class="form-control" inputmode="text" pattern=".*"  style="margin: 8.6px; min-width:16px;font-size: 16px;" id="msg-input"  onkeypress="checkEnter(event)" >
                            <button  onclick="sendMessage(currentChannel)" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script-link-css')
<script>

if (window.innerWidth <= 768) {
    document.getElementById('msg-input').addEventListener('focus', function() {
        setTimeout(() => {
            const rect = this.getBoundingClientRect();
            window.scrollTo({
                top: rect.top + window.scrollY - window.innerHeight / 2,
                behavior: 'smooth'
            });
        }, 300);
    });
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tên kênh từ localStorage
        var channelName = localStorage.getItem('channelName');

        var recipientName = localStorage.getItem('recipientName');
        console.log(recipientName);


        if (channelName) {
            // Gọi hàm subscribeToChannel với tên kênh từ localStorage
            subscribeToChannel(channelName);
            $('#recipientimgContainer').removeClass('d-none');
            $('#recipientNameContainer').removeClass('d-none');
            $('#showinput').removeClass('d-none');
            $('#border-bottom').addClass('border-bottom');
            $('#recipient-name-display').text(recipientName);
            // Xóa giá trị channelName khỏi localStorage để tránh gọi lại hàm khi tải lại trang
            localStorage.removeItem('channelName');
            localStorage.removeItem('recipientName');
        }
    });


</script>

<script>
    document.getElementById('togglecvn').addEventListener('click', function() {
        var myDiv = document.getElementById('conversations');
        myDiv.classList.toggle('d-none');
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.ably.com/lib/ably.min-1.js"></script>
<script>
     function checkEnter(event) {
        if (event.key === 'Enter') {
            sendMessage(currentChannel);
        }
    }
    var ablyKey = "{{ env('ABLY_API_KEY') }}";
    var ably = new Ably.Realtime.Promise({
        key: ablyKey
     });

      var recipientId = null;
      var currentChannel = null;
      var recipientName = null;
      var login_userId = '<?php echo $loggedIn_userId; ?>';
      // console.log(login_userId);
      var UserList = $('#conversations');
    //   var v =document.getElementById('v1');

      UserList.on('click', 'a', function() {
          recipientId = $(this).attr('data-id');
          recipientName = $(this).attr('data-name');
          $('#recipient-name-display').text(recipientName);
          $('#recipientNameContainer').removeClass('d-none');
          $('#recipientimgContainer').removeClass('d-none');
          $('#showinput').removeClass('d-none');
          $('#border-bottom').addClass('border-bottom');
          UserList.find('a').removeClass('selected-user');  // Remove from all anchors
            $(this).addClass('selected-user');  // Add to the clicked anchor

            console.log('Recipient ID: ', recipientId);
            console.log('Recipient Name: ', recipientName);



          $.ajax({
              url: "{{ route('message.checkconversations') }}",
              method: 'GET',
              data: { recipientId: recipientId },
              success: function(response) {
                  if (response.channelExists) {
                      subscribeToChannel(response.channelName);


                  } else {
                      createNewChannel(recipientId);


                  }
              },
              error: function(xhr, status, error) { console.error(error); }
          });
      });

      function sendMessage(currentChannel) {
          var messageInput = document.getElementById('msg-input');
          var message = messageInput.value.trim();

          if (message !== '') {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var baseUrl = '{{ route('message.savemessage',['namechannel'=>':namechannel']) }}';
               var fullUrl = baseUrl.replace(':namechannel',currentChannel.name);

    $.ajax({
        url: `${fullUrl}`,
        method: 'POST',
        data: {
            conversation_name: currentChannel.name,
            message_person: login_userId,
            data: message
        },
        success: function(response) {
            if (response.success) {
                currentChannel.publish(currentChannel.name, { text: message, sender: 'local' });
                messageInput.value = '';



            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText);
        }
    });
    }

      }




      function subscribeToChannel(channelName) {
        localStorage.setItem('channelName', channelName);
          if (currentChannel) {
              currentChannel.unsubscribe();
          }
          currentChannel = ably.channels.get(channelName);

        var baseUrl = '{{ route('message.getmessage',['name'=>':channelName']) }}';
        var fullUrl = baseUrl.replace(':channelName',channelName);

          $.ajax({
              url:  `${fullUrl}`,
              method: 'GET',

              success: function(response) {

                  if(response.getmessExists){

                  response.messages.forEach((msg) => {
                      oldMessage(msg, recipientName);
                      console.log(msg.message_person );

                  });
                  }else{
                  console.log(5);

                  }

              }
          });

          currentChannel.subscribe(function(message) {
              displayMessage(message, recipientName);
          });
          $('#chat-container').html('');

      }

      function createNewChannel(recipientId) {

      $.ajax({
          url: '{{ route('message.createconversations') }}',
          method: 'GET',
          data: { recipientId: recipientId },
          success: function (response) {
              if(response.success == true)

              subscribeToChannel(response.channelName);
              else
              console.log(response.error);
          },

      });
  }

      function displayMessage(messageObject, recipientName) {
        var isLocalSender = messageObject.connectionId == ably.connection.id;

          const chatContainer = $('#chat-container');

            const message1 =` <div class="chat-message-right mb-4">
                                <div>
                                </div>
                                <div class="flex-shrink-1 bg-primary text-white  rounded py-2 px-3 mr-3">

                                    ${messageObject.data.text}
                                </div>
                            </div>`



          const message2=` <div class="chat-message-left pb-4">
                                <div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">

                                   ${messageObject.data.text}
                                </div>
                            </div>`

          chatContainer.append(isLocalSender ? message1 : message2);
          chatContainer.scrollTop(chatContainer[0].scrollHeight);
      }

      function oldMessage(messageObject, recipientName) {
          var isLocalSender = messageObject.message_person == login_userId ;
          const chatContainer = $('#chat-container');

          const message2 =` <div class="chat-message-right mb-4">
                                <div>
                                    <div class="text-muted small text-nowrap mt-2">  ${new Date(messageObject.created_at).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' })}</div>
                                </div>
                                <div class="flex-shrink-1 bg-primary text-white rounded py-2 px-3 mr-3">

                                    ${messageObject.data}
                                </div>
                            </div>`



          const message1=` <div class="chat-message-left pb-4">
                                <div>

                                    <div class="text-muted small text-nowrap mt-2"> ${new Date(messageObject.created_at).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' })}</div>
                                </div>
                                <div class="flex-shrink-1 bg-light  rounded py-2 px-3 ml-3">

                                   ${messageObject.data}
                                </div>
                            </div>`

          chatContainer.append(isLocalSender ? message2 : message1);
          chatContainer.scrollTop(chatContainer[0].scrollHeight);

      }
  </script>
@endsection
