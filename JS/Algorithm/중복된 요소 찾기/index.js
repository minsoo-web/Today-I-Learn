// 내 풀이

const original = [202011, 202011, 202012, 202101, 202101, 202202, 202202, 202202];

let answer = [];
let index = original[0];
let cont = 0;

for (let i = 0; i < original.length; i++) {
	if (i == original.length - 1) {
		if (original[i] == index) {
			cont++;
			answer.push(cont);
		} else {
			answer.push(cont);
			answer.push(1);
		}
	} else {
		if (original[i] == index) {
			cont++;
			index = original[i];
		} else {
			answer.push(cont);
			cont = 1;
			index = original[i];
		}
	}
}

console.log(answer);
