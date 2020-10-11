function quicksort(length) {
  let randomArray = new Array(length);
  for (let i = 0; i < randomArray.length; i++) {
    randomArray[i] = Math.random();
  }
  console.time("QuickSort");
  
  console.log(randomArray);
  //   console.timeLog("QuickSort", "hi");
  console.timeEnd("QuickSort");
}

quicksort(5);
