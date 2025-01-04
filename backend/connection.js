const { MongoClient, ServerApiVersion } = require("mongodb");

const url = "mongodb://localhost:27017/";

const client = new MongoClient(url, {
  serverApi: {
    version: ServerApiVersion.v1,
    strict: true,
    deprecationErrors: true,
  },
});

const databaseName = "admin_panel_chat";

const connection = async () => {
  await client.connect();
  console.log("Connected successfully to server");
  const db = client.db(databaseName);
  const collection = db.collection("chat_collection");
  return collection;
};

module.exports = connection;
