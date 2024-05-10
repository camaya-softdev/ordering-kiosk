import style from "./DineOptions.module.css";
import dineinlogo from "../../assets/dineoptionlogo/dinein.svg";
import deliverlogo from "../../assets/dineoptionlogo/deliver.svg";
import takeawaylogo from "../../assets/dineoptionlogo/takeaway.svg";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import { useDispatch } from "react-redux";
import { nextStep, previousStep, setDiningOption } from "../../store/order/orderSlice";
import { DELIVERY, DINE_IN, PICK_UP } from "../../utils/Constants/DiningOptions";
import { useState } from "react";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";

function DineOptions() {
  const dispatch = useDispatch();
  const [openModal, setOpenModal] = useState({startOver: false});

  const selectDiningOption = (option) => {
    dispatch(setDiningOption(option));
    dispatch(nextStep());
  }

  return (
    <>
      <div className={style.topContainer}>
        <Progress width={20} />
      </div>
      <div className={style.mainContainer}>
        <div className={style.wrapper}>
          <span className={style.text}>Where would you like to eat?</span>
          <div className={style.section}>
            <div className={style.wrapperOption}>
              <div 
                className={style.buttonOption} 
                onClick={() => selectDiningOption(DINE_IN)}
              >
                <span>DINE IN</span>
                <img src={dineinlogo} alt="Dine In Logo" />
              </div>
              <div 
                className={style.buttonOption}
                onClick={() => selectDiningOption(PICK_UP)}
              >
                <span>PICKUP TAKEAWAY</span>
                <img src={takeawaylogo} alt="Takeaway Logo" />
              </div>
              <div 
                className={style.buttonOption}
                onClick={() => selectDiningOption(DELIVERY)}
              >
                <span>DELIVERY</span>
                <img src={deliverlogo} alt="Delivery Logo" />
              </div>
            </div>
          </div>
        </div>
        <div className={style.circleBlur}></div>
      </div>
      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
        startOverBtnOnClick={() => setOpenModal((prev) => ({...prev, startOver: true}))}
        backOnClick={() => dispatch(previousStep())}
      />

      <StartOverConfirmation
        open={openModal.startOver}
        onClose={() => setOpenModal((prev) => ({...prev, startOver: false}))}
      />
    </>
  );
}

export default DineOptions;
