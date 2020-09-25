const addTwo = require("./number1");
const forEach = require("./number4");

function mapWith(arr, callback) {
  let brr = [];
  forEach(arr, function () {
    // brr.push(forEach(arr, callback));
  });
  return brr;
}

console.log(mapWith([1, 2, 3], addTwo));
