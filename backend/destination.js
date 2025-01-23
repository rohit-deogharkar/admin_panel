const Bull = require("bull");
const myFirstQueue = new Bull("rohit", {
  redis: { port: 6379, host: "127.0.0.1" },
});
const connection = require("./connection");
// setInterval(() => {
myFirstQueue.process(async (job, done) => {
  // console.log("Data", job.data);
  try {
    const collection = await connection();
    const result = await collection.redistest.insertOne(job.data);
    console.log(result);
  } catch (ex) {
    console.log(ex);
  } // console.log(result);
  // console.log(job.data);
  done();
});

myFirstQueue.on("completed", (job) => {
  console.log(`Job with id ${job.id} has been completed`);
  job.remove();
});
// }, 3000);
