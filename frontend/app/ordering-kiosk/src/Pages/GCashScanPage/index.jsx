import { useState } from "react";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import gCashAccount from "../../assets/GCashAccount/account.jpg";
import { useDispatch, useSelector } from "react-redux";
import { PICK_UP } from "../../utils/Constants/DiningOptions";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import { previousStep } from "../../store/order/orderSlice";

import style from './GCashScanPage.module.css';

function GCashScanPage(){
    const dispatch = useDispatch();
    const selectedDiningOption = useSelector(state => state.order.diningOption);
    const [openModal, setOpenModal] = useState({startOver: false});
  
    return (
      <>
        <div className={style.topContainer}>
          <Progress width={100} />
        </div>
        <div className={style.mainContainer}>
          <div className={style.gcashWrapper}>
            <div className={style.titleContainer}>GCASH Payment</div>
            <div className={style.instructions}>
              <p>
                <span>1. Open GCASH APP then login.</span>
                <span>2. Click “QR” then scan the QR code below.</span>
              </p>
            </div>

            <img src={gCashAccount} alt="GCash Account"/>
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
          showConfirmPaymentBtn={true}
        />
  
        <StartOverConfirmation
          open={openModal.startOver}
          onClose={() => setOpenModal({startOver: false})}
        />
      </>
    );
}

export default GCashScanPage;