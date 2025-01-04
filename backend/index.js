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

app.get("/", (req, res) => {
  res.json({
    message: "This is Home page",
  });
});

let roomno = 0;
let connectionCount = 0;

io.on("connection", (socket) => {
  console.log("Socket Server Up and Running");
  // console.log(roomno);
  // roomno++;

  socket.on("userConnected", (username) => {
    console.log(username + " has connected to the chat room");
    socket.join(username);
    // console.log(socket);
  });
  // connectionCount++;

  // if (connectionCount > 2) {
  //   connectionCount = 0;
  //   roomno++;
  // } else {
  //   socket.on("weJoinedRoom", () => {
  //     socket.join("room", roomno);
  //     // console.log("This message came to room", room, message);
  //     // console.log("This message came to room", message);
  //     socket.to("room", roomno).emit("sendThisMessageToThisRoom", message);
  //   });
  //   console.log(roomno, connectionCount);
  // }

  // socket.on("weJoinedRoom", (data) => {
  // connectionCount++;
  // if (connectionCount > 1) {
  //   connectionCount = 0;
  //   roomno++;
  // } else {
  //   socket.join("room", roomno);
  //   socket.to("room", roomno).emit("sendThisMessageToThisRoom", data);
  // }
  // console.log(roomno, connectionCount, data);

  // console.log(data);
  // let roomname = data.data.sort().join("_");
  // console.log(roomname);

  socket.on("sendThisMessageToRoom", (data) => {
    // console.log(data);
    // let dataRoomName = [data.sendername, data.recievername];
    // let messageRoomName = dataRoomName.sort().join("_");
    // console.log(messageRoomName);
    // if (messageRoomName == roomname) {
    socket.to(data.recievername).emit("sendThisMessageToRoom", data);
    // console.log(`Joined to room ${roomname}, ${messageRoomName}`);
    // }
    const { sendername, recievername, message } = data;
    const sendMessage = async () => {
      const collection = await connection();
      const result = await collection.insertOne({
        sendername: sendername,
        recievername: recievername,
        message: message,
      });
      return result;
    };
    // console.log(data);
    // socket.broadcast.emit("seeThisMessage", data);
    sendMessage();
  });
  // });

  //
  // // socket.to("room1").emit("this room");
  //

  socket.on("sendmessage", (data) => {
    // console.log(data);
    const { sendername, recievername, message } = data;
    const sendMessage = async () => {
      const collection = await connection();
      const result = await collection.insertOne({
        sendername: sendername,
        recievername: recievername,
        message: message,
      });
      return result;
    };
    // console.log(data);
    // socket.broadcast.emit("seeThisMessage", data);
    sendMessage();
  });

  socket.on("sendPreviousMessages", ({ senderName, recieverName }) => {
    console.log(senderName, recieverName);
    const sendPreviousMessages = async () => {
      const collection = await connection();
      const result = await collection
        .find({
          $or: [{ sendername: senderName }, { recievername: senderName }],
        })
        .toArray();
      // console.log(result);
      socket.emit("takethisdata", result);
    };
    sendPreviousMessages();
  });
});

server.listen(3000, () => {
  console.log("Node Server Up and Running at http://localhost:3000");
});
