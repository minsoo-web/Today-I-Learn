import React, { useState, useMemo, useCallback, useRef } from "react";

const getAverage = (number) => {
  console.log("평균값 계산중");
  if (number.length === 0) return 0;
  const sum = number.reduce((a, b) => a + b);
  return sum / number.length;
};

const HooksExercise = () => {
  const [list, setList] = useState([]);
  const [number, setNumber] = useState("");
  const inputE1 = useRef(null);
  const onChange = useCallback((e) => setNumber(e.target.value), []);

  const onInsert = useCallback(() => {
    const nextList = list.concat(parseInt(number));
    setList(nextList);
    setNumber("");
    inputE1.current.focus();
  }, [number, list]);

  const onKeyPress = (e) => {
    if (e.key === "Enter") {
      onInsert();
    }
  };

  const avg = useMemo(() => getAverage(list), [list]);

  return (
    <div>
      <div>
        <input
          type="text"
          value={number}
          onChange={onChange}
          onKeyDown={onKeyPress}
          ref={inputE1}
        />
      </div>
      <div>
        <button onClick={onInsert}>추가</button>
      </div>
      <div>
        <ul>
          {list.map((item, index) => {
            return <li key={index}>{item}</li>;
          })}
        </ul>
        <div>평균 값 :{avg}</div>
      </div>
    </div>
  );
};

export default HooksExercise;
