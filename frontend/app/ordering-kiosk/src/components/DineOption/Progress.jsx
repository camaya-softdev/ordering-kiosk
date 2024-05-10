import React from "react";
import style from "./DineOption.module.css";

const Progress = (props) => {
  return (
    <div className={style.progress}>
      <div
        className={style.progressDone}
        style={{ width: `${props.width}%` }}
      ></div>
    </div>
  );
};

export default Progress;
