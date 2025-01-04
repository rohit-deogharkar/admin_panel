const Bull = require('bull');
const myFirstQueue = new Bull("my-first-queue");

const job = await myFirstQueue.add({
  foo: "bar",
});

myFirstQueue.process(async (job) => {
  return doSomething(job.data);
});
