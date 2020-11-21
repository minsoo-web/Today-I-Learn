// 바보 캄님의 풀이

const original = [202011, 202011, 202012, 202101, 202101, 202202, 202202, 202202];

var obj = {};

original.forEach(v => {
	if (!obj[v]) obj[v] = 1;
	else obj[v] += 1;
});

console.log(obj);

console.log(Object.values(obj));
