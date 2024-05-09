import React, { useState } from 'react';
import styles from "./Common.module.css";
import minusIcon from "../../assets/minus_icon.svg";
import plusIcon from "../../assets/plus_icon.svg";

function StepperInput({initialValue = 0, min, max, onValueChange}){
    const [value, setValue] = useState(initialValue);

    const increment = () => {
        if (value < max) {
            const newValue = value + 1;
            setValue(newValue);
            onValueChange(newValue);
        }
    }

    const decrement = () => {
        if (value > min) {
            const newValue = value - 1;
            setValue(newValue);
            onValueChange(newValue);
        }
    }

    return (
        <div className={styles.stepperInputWrapper}>
            <div className={styles.stepperActionWrapper} onClick={decrement}>
                <img src={minusIcon} alt="minus"/>
            </div>

            <div className={styles.stepperValue}>
                <span>{value}</span>
            </div>

            <div className={styles.stepperActionWrapper} onClick={increment}>
                <img src={plusIcon} alt="plus"/>
            </div>
        </div>
    );
}

export default StepperInput;