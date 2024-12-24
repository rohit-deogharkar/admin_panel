const express = require("express");
const http = require("http");
const { Server } = require("socket.io", {
  cors: {
    origin: "http://localhost:3000",
    methods: ["GET", "POST"],
  },
});

const app = express();
const server = http.createServer(app);
const io = new Server(server);

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
