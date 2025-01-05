const express = require("express");
const http = require("http");
const cors = require("cors");
const { Server } = require("socket.io");
const connection = require("./connection");

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"],
    credentials: true,
  },
});

connection();

app.use(express.json());
app.use(cors());

let newUser = ["something"];
io.on("connection", (socket) => {
  console.log("Socket Server Up and Running");

  socket.on("userConnected", (username) => {
    console.log(username + " has connected to the chat room");
    socket.join(username);
    const isOnline = true;
    socket.broadcast.emit("iAmOnline", { isOnline, username });
    let isThere = false;
    for (i = 0; i < newUser.length; i++) {
      if (username == newUser[i]) {
        isThere = true;
      }
    }
    if (!isThere) {
      newUser.push(username);
    }
  });

  socket.on("disconnect", () => {
    console.log("user disconnected");
  });

  socket.on("checkIsOnline", (data) => {
    let isOnline = false;
    console.log(newUser);
    console.log(data);
    for (i = 0; i < newUser.length; i++) {
      if (data == newUser[i]) {
        isOnline = true;
        socket.emit("isOnline", isOnline);
        console.log(isOnline);
        break;
      } else {
        socket.emit("isOnline", isOnline);  
      }
    }
  });

  socket.on("sendThisMessageToRoom", (data) => {
    socket.to(data.recievername).emit("sendThisMessageToRoom", data);
    const { roomname, sendername, recievername, message } = data;
    const sendMessage = async () => {
      const collection = await connection();
      const result = await collection.insertOne({
        sendername: sendername,
        recievername: recievername,
        message: message,
        roomname: roomname,
        timestamp: new Date(),
      });
      return result;
    };
    sendMessage();
  });

  socket.on("sendPreviousMessages", ({ roomname, senderName }) => {
    const sendPreviousMessages = async () => {
      const collection = await connection();
      const result = await collection
        .find({
          $or: [
            { $and: [{ sendername: senderName }, { roomname: roomname }] },
            { $and: [{ sendername: roomname }, { roomname: senderName }] },
          ],
        })
        .toArray();
      socket.emit("takethisdata", result);
    };
    sendPreviousMessages();
  });
});

server.listen(3000, () => {
  console.log("Node Server Up and Running at http://localhost:3000");
});
