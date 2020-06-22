const express = require("express");
const http = require("http");
const path = require("path");
const static = require("serve-static");

// express 객체
let app = express();

let bodyParser = require("body-parser");
app.use("/public", static(path.join(__dirname, "public")));

// // 미들웨어 등록
// app.use("/static", express.static(__dirname + "/public"));

// app.use(function (req, res, next) {
//   res.writeHead(200, { "Content-Type": "text/html; charset=utf8" });
//   res.write("<img src='/static/img/img1.jpg' width='50px'/>");
//   res.end();
// });

// 값 세팅
app.set("port", process.env.PORT || 3000);

http.createServer(app).listen(app.get("port"), function () {
  console.log("익스프레스 서버" + app.get("port"));
});
