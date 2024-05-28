import React, { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import style from "./DineOption.module.css";

const Progress = (props) => {
  const [progressWidth, setProgressWidth] = useState(0);
  const orderStep = useSelector((state) => state.order.orderStep);

  useEffect(() => {
    let width;
    switch (orderStep) {
      case 3:
        width = 20;
        break;
      case 4:
        width = 40;
        break;
      case 5:
        width = 60;
        break;
      case 6:
        width = 80;
        break;
      case 7:
        width = 100;
        break;
      default:
        width = 0;
    }
    setProgressWidth(width);
  }, [orderStep]);

  const progressStyle = {
    width: `${progressWidth}%`,
  };

  return (
    <div className={style.progress} style={props.style}>
      <div className={style.progressDone} style={progressStyle}></div>
    </div>
  );
};

export default Progress;
