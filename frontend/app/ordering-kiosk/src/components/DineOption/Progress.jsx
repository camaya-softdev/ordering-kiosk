import React, { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import style from "./DineOption.module.css";

const Progress = (props) => {
  const [progressWidth, setProgressWidth] = useState(0);
  const [initialWidth, setInitialWidth] = useState(0);
  const [prevWidth, setPrevWidth] = useState(0);
  const [animate, setAnimate] = useState(false);
  const orderStep = useSelector((state) => state.order.orderStep);

  useEffect(() => {
    let newInitialWidth;
    switch (orderStep) {
      case 3:
        newInitialWidth = 0;
        break;
      case 4:
        newInitialWidth = 20;
        break;
      case 5:
        newInitialWidth = 40;
        break;
      case 6:
        newInitialWidth = 60;
        break;
      case 7:
        newInitialWidth = 80;
        break;
      default:
        newInitialWidth = 0;
    }

    if (newInitialWidth < initialWidth) {
      setPrevWidth(initialWidth);
    }
    setInitialWidth(newInitialWidth);
  }, [orderStep]);

  useEffect(() => {
    setProgressWidth(initialWidth < prevWidth ? prevWidth : initialWidth);
    setAnimate(false);
    const timer = setTimeout(() => {
      setAnimate(true);
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
    }, 1000);

    return () => clearTimeout(timer);
  }, [orderStep, initialWidth, prevWidth]);

  return (
    <div className={style.progress} style={props.style}>
      <div
        className={animate ? style.progressDone : style.progressStart}
        style={{ width: `${progressWidth}%` }}
      ></div>
    </div>
  );
};

export default Progress;