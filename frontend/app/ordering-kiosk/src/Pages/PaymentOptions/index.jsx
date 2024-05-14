import { useEffect, useState } from "react";
import style from "./PaymentOption.module.css";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import gcashlogo from "../../assets/gcashlogo.png";
import { useDispatch, useSelector } from "react-redux";
import { PICK_UP } from "../../utils/Constants/DiningOptions";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import { nextStep, previousStep, setGCashPaymentDetails, setOrderStep, setPaymentOption } from "../../store/order/orderSlice";
import { CASH_PAYMENT, GCASH_PAYMENT } from "../../utils/Constants/PaymentOptions";
import { useCreateTransaction } from "../../services/TransactionService";

const PaymentOptions = () => {
  const dispatch = useDispatch();
  const order = useSelector(state => state.order);
  const selectedDiningOption = useSelector(state => state.order.diningOption);
  const [openModal, setOpenModal] = useState({startOver: false});
  const placeOrderQuery = useCreateTransaction();

  useEffect(() => {
    if (order.paymentOption === CASH_PAYMENT && order.gcashPaymentDetails === null) {
      handleSave();
    }
  }, [order.paymentOption, order.gcashPaymentDetails]);
  
  const onSelectPayment = (paymentMethod) => {
    if(paymentMethod === GCASH_PAYMENT) {
      dispatch(setPaymentOption(GCASH_PAYMENT));
      dispatch(nextStep());
    }
    else if(paymentMethod === CASH_PAYMENT) {
      dispatch(setPaymentOption(CASH_PAYMENT));
      dispatch(setGCashPaymentDetails(null));
    }
  }

  const handleSave = async () => {
    try {
        const response = await (await placeOrderQuery).mutateAsync(order);
        dispatch(setOrderStep(8));
    } catch (error) {
        alert("Cannot create transaction. Please try again.");
    }
  };

  return (
    <>
      <div className={style.topContainer}>
        <Progress width={80} />
      </div>
      <div className={style.mainContainer}>
        <div className={style.titleContainer}>Choose your payment method</div>
        <div className={style.buttonOptions}>
          <div className={style.btnWrapper} onClick={() => onSelectPayment(CASH_PAYMENT)}>
            Pay at the counter <br />
            (cash)
          </div>
          <div className={style.btnWrapper} onClick={() => onSelectPayment(GCASH_PAYMENT)}>
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
