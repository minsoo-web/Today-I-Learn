const forEach = require("./number4");

const add = (a, b) => a + b;

const reduce = (arr, callback, init) => {
  let result = init;
  forEach(arr, (item) => {
    result = callback(item, result);
  });
  return result;
};

console.log(reduce([1, 2], add, 0));
