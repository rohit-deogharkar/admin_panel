const Bull = require("bull");
const myFirstQueue = new Bull("rohit", {
  redis: { port: 6379, host: "192.168.0.94" },
});

myFirstQueue.process((job, done) => {
  console.log("Data", job.data);
  done();
});

myFirstQueue.on("completed", (job) => {
  console.log(`Job with id ${job.id} has been completed`);
  job.remove();
});
