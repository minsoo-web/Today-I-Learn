const addTwo = require("./number1");

function map(arr, callback) {
  let brr = [];
  for (let i = 0; i < arr.length; i++) {
    brr.push(callback(arr[i]));
  }
  return brr;
}

console.log(map([1, 2, 3], addTwo));

