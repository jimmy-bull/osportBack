
var app = require("express")();
var http = require("http").createServer(app);
var io = require("socket.io")(http, {
  cors: {
    origin: "*",
  },
});
io.on("connection", (socket) => {
  console.log("connection");

  socket.on("sendToServer", (message) => {
    console.log(message);
    // io.emit('sendToClient',message)
    socket.broadcast.emit("sendToClient", message);
  });

  socket.on("disconnect", (socket) => {
    console.log("disconnected");
  });
});



http.listen(3000, () => {
  console.log("Listening on Port 3000");
});
