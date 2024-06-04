import React, { useState } from "react";
import styles from "./Common.module.css";
import minusIcon from "../../assets/minus_icon.svg";
import plusIcon from "../../assets/plus_icon.svg";

function StepperInput({
  initialValue = 0,
  min,
  max,
  onValueChange,
  size = "medium",
}) {
  const [value, setValue] = useState(initialValue);

  const sizeClassMap = {
    small: {
      wrapper: styles.stepperInputWrapperSmall,
      action: styles.stepperActionWrapperSmall,
      value: styles.stepperValueSmall,
    },
    medium: {
      wrapper: styles.stepperInputWrapperMedium,
      action: styles.stepperActionWrapperMedium,
      value: styles.stepperValueMedium,
    },
    large: {
      wrapper: styles.stepperInputWrapperLarge,
      action: styles.stepperActionWrapperLarge,
      value: styles.stepperValueLarge,
    },
  };

  const classes = sizeClassMap[size] || sizeClassMap.medium;

  const increment = () => {
    if (value < max) {
      const newValue = value + 1;
      setValue(newValue);
      onValueChange(newValue);
    }
  };

  const decrement = () => {
    if (value > min) {
      const newValue = value - 1;
      setValue(newValue);
      onValueChange(newValue);
    }
  };

  return (
    <div className={classes.wrapper}>
      <div className={classes.action} onClick={decrement}>
        <img src={minusIcon} alt="minus" />
      </div>

      <div className={classes.value}>
        <span>{value}</span>
      </div>

      <div className={classes.action} onClick={increment}>
        <img src={plusIcon} alt="plus" />
      </div>
    </div>
  );
}

export default StepperInput;
