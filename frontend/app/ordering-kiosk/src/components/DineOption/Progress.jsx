import { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import style from "./DineOption.module.css";

const Progress = (props) => {
  const [progressWidth, setProgressWidth] = useState(0);
  const [initialWidth, setInitialWidth] = useState(0);
  const [animate, setAnimate] = useState(false);
  const orderStep = useSelector((state) => state.order.orderStep);
  const [succeedingWidth, setSucceedingWidth] = useState(0);
  const prevOrderStep = useSelector((state) => state.order.prevOrderStep);

  useEffect(() => {
    let newInitialWidth;
    let newSucceedingWidth;
    switch (orderStep) {
      case 3:
        newInitialWidth = 0;
        newSucceedingWidth = 40;
        break;
      case 4:
        newInitialWidth = 20;
        newSucceedingWidth = 60;
        break;
      case 5:
        newInitialWidth = 40;
        newSucceedingWidth = 80;
        break;
      case 6:
        newInitialWidth = 60;
        newSucceedingWidth = 100;
        break;
      case 7:
        newInitialWidth = 80;
        newSucceedingWidth = 100;
        break;
      default:
        newInitialWidth = 0;
    }

    setInitialWidth(newInitialWidth);
    setSucceedingWidth(newSucceedingWidth);
  }, [orderStep, prevOrderStep]);

  useEffect(() => {
    setProgressWidth(prevOrderStep < orderStep ? initialWidth : succeedingWidth);
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
    }, 300);

    return () => clearTimeout(timer);
  }, [orderStep, initialWidth, succeedingWidth]);

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