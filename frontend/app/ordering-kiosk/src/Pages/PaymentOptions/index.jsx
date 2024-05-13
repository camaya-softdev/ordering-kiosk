import React from "react";
import style from "./PaymentOption.module.css";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import gcashlogo from "../../assets/gcashlogo.png";
const PaymentOptions = () => {
  return (
    <>
      <Progress width={80} />
      <div className={style.mainContainer}>
        <div className={style.titleContainer}>Choose your payment method</div>
        <div className={style.buttonOptions}>
          <div className={style.btnWrapper}>
            Pay at the counter <br />
            (cash)
          </div>
          <div className={style.btnWrapper}>
            <img src={gcashlogo} />
          </div>
        </div>
      </div>
      <div className={style.circleBlur}></div>
      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
      />
    </>
  );
};

export default PaymentOptions;
