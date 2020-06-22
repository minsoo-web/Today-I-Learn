# express

### express 서버 생성

```js
const express = require("express");
const http = require("http");

// port 값 세팅
app.set("port", process.env.PORT || 3000);

http.createServer(app).listen(app.get("port"), function () {
  console.log("익스프레스 서버" + app.get("port"));
});
```

### express 객체 생성

```js
const express = require("express");
let app = express();
```

### 미들웨어 함수 등록

```js
app.use(function (req, res, next) {
  console.log("첫번째 미들웨어 호출");
  next();
});

app.use("/", function (req, res, next) {
  console.log("두번째 미들웨어 호출");
  res.writeHead(200, { "Content-Type": "text/html; charset=utf-8" });
  res.write("<h1>Express 서버</h1>");
  res.end();
});
```

### 상태 코드 전송

```js
app.use(function (req, res, next) {
  console.log("첫번째 미들웨어 호출");
  res.status(404).send("not found");
  // res.sendStatus(404) 이 메소드를 통한 전송 또한 가능하다
});
```

### 익스프레스에서 요청 객체에 추가한 헤더와 파라미터

```js
app.use(function (req, res, next) {
  let userAgent = req.header("User-Agent");
  let paramValue = req.query.name;

  res.writeHead(200, { "Content-Type": "text/html; charset=utf8" });
  res.write(`
    <h1>Express 서버에서 응답한 결과</h1>
    <p>UserAgent : ${userAgent}</p>
    <p>paramValue : ${paramValue}</p>
  `);
  res.end();
});
```

### 익스프레스 기본 내장 미들웨어 함수 - static

```js
app.use("/static", express.static(__dirname + "/public"));

app.use(function (req, res, next) {
  res.writeHead(200, { "Content-Type": "text/html; charset=utf8" });
  res.write("<img src='/static/img/imge1.jpg />");
  res.end();
});
```

### body-parser

POST로 요청했을 때 요청 파라미터를 확인할 수 있도록 만들어 둔 `body-parser` 미들웨어
