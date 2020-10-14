let Comparison = 0;
let Exchange = 0;

function SWAP(array, left, right) {
  Exchange += 1;
  let temp;
  temp = array[left];
  array[left] = array[right];
  array[right] = temp;
  return array;
}

function main(length, pivot_type) {
  let randomArray = new Array(length);
  for (let i = 0; i < randomArray.length; i++) {
    randomArray[i] = Math.random();
  }
  console.log(`Pivot Type is ${pivot_type}`);
  console.time(`n[${length}] time is`);
  quicksort(randomArray, 0, length - 1, pivot_type);
  console.timeEnd(`n[${length}] time is`);
}

function partition(list, left, right, pivot_type) {
  let low, high;
  let pivot, pivot_index;

  low = left;
  high = right + 1;
  pivot_type === "random"
    ? (pivot_index = Math.round(Math.random() * 100))
    : pivot_index === "mid"
    ? (pivot_index = Math.round(list.length / 2))
    : (pivot_index = left);
  pivot = list[pivot_index];

  do {
    do {
      Comparison += 1;
      low += 1;
    } while (low <= right && list[low] < pivot);

    do {
      Comparison += 1;
      high -= 1;
    } while (high >= left && list[high] > pivot);

    if (low < high) {
      list = SWAP(list, low, high);
    }
  } while (low < high);

  list = SWAP(list, left, high);

  return high;
}

/**
 * Quicsort
 * @summary 재귀함수로 구현한 퀵소트
 * @param {Array} list 정렬이 되어야할 리스트
 * @param {Number} left 왼쪽부터 증가되는 index
 * @param {Number} right 오른쪽부터 감소하는 index
 * @return {null}
 */
function quicksort(list, left, right, pivot_type) {
  if (left < right) {
    let q = partition(list, left, right, pivot_type);

    quicksort(list, left, q - 1);
    quicksort(list, q + 1, right);
  }
}

main(5000, "mid");
console.log("Exchange : " + Exchange);
console.log("Comparison : " + Comparison);
