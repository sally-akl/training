const express = require("express");
const http = require("http");
const socketio = require("socket.io")
const app = express();
const server = http.createServer(app);
const io = socketio(server,{
  cors: {
    origin: "*",
  }
});
var users = [];
var tosocket = "";
app.get('/', (request, response) => {
  response.send('connected');
});

io.on("connection", socket => {
  console.log("new connection with socket with id " , socket.id);

  socket.on("beginChat" , function(data){
     users[data.sender] = socket.id;
  });
  socket.on("Typing" , function(data){
    tosocket = users[data.receiver];
    io.to(tosocket).emit("Typing",data);
  });
  socket.on("stopTyping" , function(data){
    tosocket = users[data.receiver];
    io.to(tosocket).emit("stopTyping",data);
  });
  socket.on("message" , function(data){
    tosocket = users[data.receiver];
    io.to(tosocket).emit("message",data);
  });




});
const PORT = 3000 || process.env.PORT;
server.listen(PORT , ()=>console.log('Server is running in port',PORT));
