const express = require("express");
const http = require("http");
const cors = require('cors')
const { Server } = require("socket.io");

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
  cors: { 
    origin: "*",
    methods: ["GET", "POST"],
    credentials: true}
});

app.use(express.json())
app.use(cors())

app.get("/", (req, res) => {
  res.json({
    message: "This is Home page",
  });
});

io.on("connection", (socket) => {
  console.log("Socket Server Up and Running");

  socket.on("userConnected", (name) => {
    console.log(name + " has connected to the chat room");
    
  });


});

server.listen(3000, () => {
  console.log("Node Server Up and Running at http://localhost:3000");
});


