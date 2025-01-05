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

let newUser = ["something"];
io.on("connection", (socket) => {
  console.log("Socket Server Up and Running");

  socket.on("userConnected", (username) => {
    console.log(username + " has connected to the chat room");
    socket.join(username);
    const isOnline = true;
    socket.emit("online", isOnline);
    let isThere = false;
    for (i = 0; i < newUser.length; i++) {
      if (username == newUser[i]) {
        isThere = true;
      }
    }
    if (!isThere) {
      newUser.push(username);
    }
    // console.log(newUser);
    // console.log(newUser);

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

  socket.on("checkIsOnline", (data) => {
    // console.log(socket);
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

    // console.log(data);
  });

  socket.on("sendThisMessageToRoom", (data) => {
    // console.log(data);
    // let dataRoomName = [data.sendername, data.recievername];
    // let messageRoomName = dataRoomName.sort().join("_");
    // console.log(messageRoomName);
    // if (messageRoomName == roomname) {
    socket.to(data.recievername).emit("sendThisMessageToRoom", data);
    // console.log(`Joined to room ${roomname}, ${messageRoomName}`);
    // }
    const { roomname, sendername, recievername, message } = data;
    const sendMessage = async () => {
      const collection = await connection();
      const result = await collection.insertOne({
        sendername: sendername,
        recievername: recievername,
        message: message,
        roomname: roomname,
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

  socket.on(
    "sendPreviousMessages",
    ({ roomname, senderName, recieverName }) => {
      // console.log(senderName, recieverName);
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
        // console.log(result);
        socket.emit("takethisdata", result);
      };
      sendPreviousMessages();
    }
  );
});

server.listen(3000, () => {
  console.log("Node Server Up and Running at http://localhost:3000");
});
