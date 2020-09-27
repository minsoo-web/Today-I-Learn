const addTwo = require("./number1");
const forEach = require("./number4");

function mapWith(arr, callback) {
  let brr = [];
  forEach(arr, (item) => {
    brr.push(callback(item));
  });
  return brr;
}

console.log(mapWith([1, 2, 3], addTwo));
