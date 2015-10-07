var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

var connectedUsers = [];
redis.subscribe('cotacao', 'chat-message', 'deleted-chats', 'created-chats');

redis.on('message', function(channel, message){
  message = JSON.parse(message);
  // console.log(message);
  if (channel == 'cotacao') {
    io.emit(channel + ':' + message.event, message.data);
  }
  if (channel == "chat-message") {
    for(var k in connectedUsers){
      if (connectedUsers[k].user == message.data.userTo) {
        connectedUsers[k].socket.emit(channel + ':' + message.event, message.data);
      }
    }
  }
  if (channel == "deleted-chats") {
    for(var k in connectedUsers){
      if (connectedUsers[k].user == message.data.id) {
        connectedUsers[k].socket.emit(channel + ':' + message.event, message.data);
      }
    }
  }
  if (channel == "created-chats") {
    for(var k in connectedUsers){
      if (connectedUsers[k].user == message.data.chat.user_2) {
        connectedUsers[k].socket.emit(channel + ':' + message.event, message.data);
      }
    }
  }
});

io.on('connection', function (socket) {
  socket.on('user_id', function (data) {
    connectedUsers.push({user: data.user_id, socket: socket});
    // console.log(connectedUsers);
  });
  socket.on('disconnect', function(){
    for(var k in connectedUsers){
      if (connectedUsers[k].socket.id == socket.id) {
        connectedUsers.splice(k, 1);
      }
    }
    // setTimeout(function(){console.log(connectedUsers);}, 1000);
  })
});


server.listen(3000);
