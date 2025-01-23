const Bull = require("bull");
const myFirstQueue = new Bull("user_summary", {
  redis: { port: 6379, host: "127.0.0.1" },
});

setInterval(async () => {
  //   for (let index = 0; index < 100; index++) {
  myFirstQueue.add({
    foo: "bar" + Math.floor(Math.random() * 100),
  });
  //   }
}, 3000);
