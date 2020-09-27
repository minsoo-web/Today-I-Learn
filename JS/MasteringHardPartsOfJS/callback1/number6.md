# Exercise 6

## Problem

> The function reduce takes an array and reduces the elements to a single value.
> For example it can sum all the numbers, multiply them, or any operation that you can put into a function.

```js
const nums = [4, 1, 3];
const add = function (a, b) {
  return a + b;
};

console.log(reduce(nums, add, 0)); // 8
```
