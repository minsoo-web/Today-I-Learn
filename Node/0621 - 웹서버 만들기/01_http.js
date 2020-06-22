const http = require("http");

let server = http.createServer();

let port = 3000;

server.listen(port, () => {
  console.log("server is running on" + port);
});

server.on("connection", (socket) => {
  var addr = socket.address();
  console.log("클라이언트가 접속했습니다. : %s, %d", addr.address, addr.port);
});

server.on("request", (req, res) => {
  console.log("요청이 들어왔습니다.");

  res.writeHead(200, { "Content-Type": "text/html; charset=utf-8" });
  res.write("<!DOCTYPE html>");
  res.write("<html>");
  res.write("<body>");
  res.write("<h1>ㅎㅇ</h1>");
  res.write("</h1>");
  res.write("</html>");
  res.end();
});

server.on("close", () => {
  console.log("서버가 종료됩니다. ");
});
