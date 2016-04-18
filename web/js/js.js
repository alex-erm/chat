/**
 * Created by Alexey on 07.03.2016.
 */
$(document).ready(function(){
    var h = $("body").height();
    var chat = $(".chat-window");
    chat.height(h/2.5);
    chat.scrollTop (999999999);

    var timerId = setInterval(function() {
        getRequest();
        console.log('Go');
    }, 3000);

    function getRequest()
    {
        var times = $(".chat-window :last-child :first-child").text();
        var rooms = $("main h1 a").attr('href').substr(-1);
        html = $.get(
            "main/get",
            {
                room: rooms,
                time: times
            },
            function(data){
                if (data!==0){
                    $(".chat-window").append(data);
                    var chat = $(".chat-window");
                    chat.scrollTop(999999999);
                }
                console.log(data.length);
            }
        );
    }

    $("#w0[action='/main/message'] button[type=submit]").click(function(event) {
       event.preventDefault();
       sendMessage();
    });

    function sendMessage()
    {
        var messages = $("#messagetable-message");
        var names = $("#messagetable-user_name").val();
        var csrf = $("#w0 input[type=hidden]").val();
        var room = $("main h1 a").attr('href').substr(-1);
        if(messages.val()!=''){
            var messageSend = messages.val();
        }
        else{
            messages.attr("placeholder", "Введите ваше сообщение")
        }
        html = $.post(
            "/main/message",
            {
                "MessageTable[message]":messageSend,
                "MessageTable[user_name]":names,
                "MessageTable[room_id]":room,
                "_csrf":csrf
            },
            function(data){
                messages.val('');
                messages.attr("placeholder", "Введите ваше сообщение");
            }
        );
    }
    $("main h1 a").click(function(event){event.preventDefault();});
    var room = $("aside ul li a");
    room.click(function(event) {
        event.preventDefault();
        var idRoom = $(this).attr('href').substr(-1);
        html = $.get(
            "/main/room",
            {
                "id": idRoom,
            },
            function(data){
                var h1 = $("main h1 a");
                h1.text(data.room);
                h1.attr('href','/main/chat/'+data.idRoom);
                var html = $(".chat-window").html('');
                var chat;
                for (var i=0; i < data.archive.length; i++){
                    html.append("<p><span class='user-date'>" + data.archive[i].create_at + "</span>" +
                        "<br><span class='user'>" + data.arhiv[i].user_name + "</span>" + data.arhiv[i].message + "</p>");
                }


                alert(data.arhiv[1].user_name);
                console.log(data.arhiv[2].user_name);
            },
            'json'
        );
    });

});


