# Homework #1

## 1. pivot is first element

| n     | Quick       |          |           |
| ----- | ----------- | -------- | --------- |
|       | comparision | Exchange | Time (ms) |
| 100   | 815         | 163      | 0.583     |
| 200   | 1754        | 369      | 0.672     |
| 500   | 5270        | 1108     | 1.932     |
| 1,000 | 11838       | 2407     | 35.236    |
| 2,000 | 27162       | 5280     | 27162     |
| 3,000 | 45799       | 8093     | 10.127    |
| 4,000 | 63011       | 11384    | 63.712    |
| 5,000 | 77398       | 14533    | 11.646    |

## 2. when pivot is...

### Left ( first element )

In my opinion, picking the smallest or largest index as pivot is not much different from choosing a pivot in a random position.

### Random Value

If the pivot is in a random position, predicting the results is also the same as predicting randomly.  
However, picking a pivot randomly is not necessarily a bad way, as the result of the quick sort is also random.

### Median Value

I think selecting a mid-priced pivot is like doing a Merge sort, not a quick sort.  
It will certainly take a short time, but I think it's an average and ideal value and if you're expecting those values,  
you should do a Merge sort, not a Quick sort.

## 3. My Opinion

In my opinion, the good selection of Pivot in Quick Sort is the reason for the difference in speed with the Merge sort.  
The best way to fit the methodology of divisional conquest is the same way to reduce the depth of circular invocation.  
Because the number of comparisons is fixed at n times.
So to save time, same as to reduce the number of divide times, which is linked to choosing the middle value,  
which will be the best pivot value.
