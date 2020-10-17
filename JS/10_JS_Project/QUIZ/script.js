// 약 두 시간,,
const questionTitle = document.getElementById("question");
const choiceList = document.getElementById("choice-list");
const button = document.getElementById("gotoNext");
const errorMsg = document.querySelector(".error");

const quizData = [
  {
    question: "김민수의 나이는 ?",
    choices: [
      { id: 0, text: "20 😀" },
      { id: 1, text: "24 🤔" },
      { id: 2, text: "26 😇" },
      { id: 3, text: "28 🤬" },
    ],
    answer: 2,
  },
  {
    question: "김민수가 싫어하는 음식은?",
    choices: [
      { id: 0, text: "키위 🥝" },
      { id: 1, text: "사과 🍎" },
      { id: 2, text: "가지 🍆" },
      { id: 3, text: "수박 🍉" },
    ],
    answer: 2,
  },
  {
    question: "김민수가 좋아하는 운동은?",
    choices: [
      { id: 0, text: "축구 ⚽️" },
      { id: 1, text: "농구 🏀" },
      { id: 2, text: "야구 ⚾️" },
      { id: 3, text: "조깅 🏃‍♂️" },
    ],
    answer: 3,
  },
];
function setQuizList(currentNumber) {
  questionTitle.innerHTML = quizData[currentNumber].question;

  for (let i = 0; i < quizData[currentNumber].choices.length; i++) {
    const li = document.createElement("li");
    li.className = "choice";
    li.id = i;

    const strong = document.createElement("strong");
    strong.setAttribute("for", i);
    strong.innerHTML = i + 1 + ". " + quizData[currentNumber].choices[i].text;

    const span = document.createElement("span");
    span.className = "answer";

    choiceList.appendChild(li);
    li.appendChild(strong);
    li.appendChild(span);

    li.addEventListener(
      "click",
      function () {
        errorMsg.setAttribute("style", "display: none");
        // 정답을 고른 상태라면
        if (isCorrect) return;

        let selectedAnswer = Number(this.id); // 고른 선택지
        let correctAnswer = quizData[currentNumber].answer; // 실제 정답

        if (selectedAnswer !== correctAnswer) {
          // 다른 경우
          this.className += " wrong";
          let selectedSpan = document.querySelectorAll("span.answer")[
            selectedAnswer
          ];
          selectedSpan.innerHTML = "x";
        } else {
          //  맞춘 경우
          isCorrect = true;
          this.className += " correct";
          let selectedSpan = document.querySelectorAll("span.answer")[
            selectedAnswer
          ];
          selectedSpan.innerHTML = "✓";
        }
      },
      { once: true }
    );
  }
}

let isCorrect = false;
let currentNumber = 0;

function deleteEl() {
  const li = document.querySelectorAll("#choice-list > li");
  for (let i = 0; i < li.length; i++) {
    choiceList.removeChild(li[i]);
  }
}
function main() {
  currentNumber = 0;
  button.innerText = "Go Next";
  setQuizList(currentNumber);
}

button.addEventListener("click", () => {
  if (currentNumber === 2) {
    // 문제를 모두 맞힘
    currentNumber += 1;
    questionTitle.innerHTML = "모두 맞히셨습니다아! 🥳";
    deleteEl();
    button.innerText = "Clear !!";
  } else if (currentNumber > 2) {
    // Clear 버튼 클릭 시
    main();
  } else if (isCorrect) {
    // 문제를 맞추면
    currentNumber += 1;
    deleteEl();
    setQuizList(currentNumber);
    isCorrect = false;
  } else {
    errorMsg.setAttribute("style", "display: block");
    return;
  }
});

main();
