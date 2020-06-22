const express = require("express");
const http = require("http");
const path = require("path");
const static = require("serve-static");
const cookieParser = require("cookie-parser");
const bodyParser = require("body-parser");

// express 객체
let app = express();

app.use("/public", static(path.join(__dirname, "public")));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.use(cookieParser());

app.get("/", function (req, res, next) {
  res.redirect("/public/templates/login.html");
});

app.post("/login", function (req, res, next) {
  let id = req.body.id;
  let password = req.body.password;

  if (id == "minsoo" && password == "1234") {
    res.cookie("id", id);
    res.redirect("/");
  }
});

// 값 세팅
app.set("port", process.env.PORT || 3000);

http.createServer(app).listen(app.get("port"), function () {
  console.log("익스프레스 서버" + app.get("port"));
});
