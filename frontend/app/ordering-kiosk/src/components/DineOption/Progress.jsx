import React, { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import style from "./DineOption.module.css";

const Progress = (props) => {
  const [progressWidth, setProgressWidth] = useState(0);
  const orderStep = useSelector((state) => state.order.orderStep);

  useEffect(() => {
    switch (orderStep) {
      case 3:
        setProgressWidth(20);
        break;
      case 4:
        setProgressWidth(40);
        break;
      case 5:
        setProgressWidth(60);
        break;
      case 6:
        setProgressWidth(80);
        break;
      case 7:
        setProgressWidth(100);
        break;
      default:
        setProgressWidth(0);
    }
  }, [orderStep]);

  return (
    <div className={style.progress} style={props.style}>
      <div
        className={style.progressDone}
        style={{ width: `${progressWidth}%` }}
      ></div>
    </div>
  );
};

export default Progress;
