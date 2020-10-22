var options = {
    valueNames: ["title", "authors", "publisher", "good", "read"],
};
var userList = new List("books", options);
userList.sort("read");

