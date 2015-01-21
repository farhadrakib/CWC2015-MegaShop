
/** register_form_token indexes **/
db.getCollection("register_form_token").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** user indexes **/
db.getCollection("user").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** user_token indexes **/
db.getCollection("user_token").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** register_form_token records **/
db.getCollection("register_form_token").insert({
  "_id": ObjectId("54ba701590f500780c00002a"),
  "token": "ff32cc09d13d4ce1"
});
db.getCollection("register_form_token").insert({
  "_id": ObjectId("54bbba5890f5001015000029"),
  "token": "8f3f73a61bf42c98"
});
db.getCollection("register_form_token").insert({
  "_id": ObjectId("54bfc09090f5001812000029"),
  "token": "a94a5acafe49f50b"
});
db.getCollection("register_form_token").insert({
  "_id": ObjectId("54bfc09890f500181200002a"),
  "token": "f062394d3e9d90bc"
});

/** system.indexes records **/
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "megashop.user"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "megashop.user_token"
});
db.getCollection("system.indexes").insert({
  "v": NumberInt(1),
  "key": {
    "_id": NumberInt(1)
  },
  "name": "_id_",
  "ns": "megashop.register_form_token"
});

/** user records **/
db.getCollection("user").insert({
  "_id": ObjectId("54ba3ee190f5000c17000029"),
  "first_name": "niloy",
  "last_name": "test",
  "email": "test",
  "passsword": "1234",
  "phone": "test",
  "address1": "dfd",
  "address2": "dfdf",
  "city": "dfdf",
  "country": "Bangldesh",
  "password": "test"
});
db.getCollection("user").insert({
  "_id": ObjectId("54bfbf2590f500e01400002a"),
  "first_name": "rakib",
  "last_name": "hasan",
  "email": "rakib@gmail.com",
  "passsword": "12345",
  "phone": "01835099322",
  "address1": "rer",
  "address2": "ere",
  "city": "ere",
  "country": "India"
});

/** user_token records **/
db.getCollection("user_token").insert({
  "_id": ObjectId("54bfc0b990f500d014000029"),
  "user_token": "1714bbd7a5c3f1325541bac30f3a2e53",
  "user_id": ObjectId("54ba3ee190f5000c17000029")
});
