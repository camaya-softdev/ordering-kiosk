import React, { useState } from "react";
import style from "./PaymentOption.module.css";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import gcashlogo from "../../assets/gcashlogo.png";
import { useDispatch, useSelector } from "react-redux";
import { PICK_UP } from "../../utils/Constants/DiningOptions";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import { previousStep } from "../../store/order/orderSlice";

const PaymentOptions = () => {
  const dispatch = useDispatch();
  const selectedDiningOption = useSelector(state => state.order.diningOption);
  const [openModal, setOpenModal] = useState({startOver: false});

  return (
    <>
      <div className={style.topContainer}>
        <Progress width={80} />
      </div>
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
        showLocationDetails={selectedDiningOption === PICK_UP ? false : true}
        backOnClick={() => dispatch(previousStep())}
        startOverBtnOnClick={() => setOpenModal({startOver: true})}
      />

      <StartOverConfirmation
        open={openModal.startOver}
        onClose={() => setOpenModal({startOver: false})}
      />
    </>
  );
};

export default PaymentOptions;
