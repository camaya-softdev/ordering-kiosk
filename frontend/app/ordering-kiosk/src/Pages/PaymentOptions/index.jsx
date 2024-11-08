import { useEffect, useState } from "react";
import style from "./PaymentOption.module.css";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import { useDispatch, useSelector } from "react-redux";
import { PICK_UP } from "../../utils/Constants/DiningOptions";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import {
  nextStep,
  previousStep,
  setClassAnimate,
  setCreatedTransaction,
  setGCashPaymentDetails,
  setOrderStep,
  setPaymentOption,
} from "../../store/order/orderSlice";
import {
  CASH_PAYMENT,
  GCASH_PAYMENT,
} from "../../utils/Constants/PaymentOptions";
import { useCreateTransaction } from "../../services/TransactionService";
import useFetchPaymentMethods from "../../hooks/useFetchPaymentMethods";
import BeatLoader from "react-spinners/BeatLoader";
import LoginModal from "../../components/Login/LoginModal";
import { LazyLoadImage } from "react-lazy-load-image-component";
import PrivacyNote from "../../components/PrivacyNotice/PrivacyNote";

const PaymentOptions = () => {
  const dispatch = useDispatch();
  const order = useSelector((state) => state.order);
  const selectedDiningOption = useSelector((state) => state.order.diningOption);
  const classAnimate = useSelector((state) => state.order.classAnimate);
  const [openStartOverModal, setOpenStartOverModal] = useState(false);
  const [openPrivacyNote, setOpenPrivacyNote] = useState(false);
  const { paymentMethods, isPaymentMethodsLoading } = useFetchPaymentMethods();

  useEffect(() => {
    if (
      order.paymentOption === CASH_PAYMENT &&
      order.gcashPaymentDetails === null
    ) {
      setOpenPrivacyNote(true);
    }
  }, [order.paymentOption, order.gcashPaymentDetails]);

  const onSelectPayment = (paymentMethod) => {
    if (paymentMethod === GCASH_PAYMENT) {
      dispatch(setPaymentOption(GCASH_PAYMENT));
      dispatch(nextStep());
      dispatch(setClassAnimate("backwardAnimation"));
    } else if (paymentMethod === CASH_PAYMENT) {
      dispatch(setPaymentOption(CASH_PAYMENT));
      dispatch(setGCashPaymentDetails(null));
      setOpenPrivacyNote(true); // Ensure the privacy note opens when CASH_PAYMENT is selected
    }
  };

  const handleBackClick = () => {
    dispatch(previousStep());
    dispatch(setClassAnimate("forwardAnimation"));
  };

  return (
    <div className={`${style[classAnimate]}`}>
      <div className={style.topContainer}>
        <Progress />
      </div>
      <div className={style.mainContainer}>
        <div className={style.titleContainer}>Choose your payment method</div>
        <div className={style.buttonOptions}>
          {isPaymentMethodsLoading ? (
            <BeatLoader color="#FD3C00" size={35} speedMultiplier={0.5} />
          ) : (
            <>
              {Object.entries(paymentMethods?.payment_method).map(
                ([index, paymentMethod]) => {
                  return (
                    <div
                      key={index}
                      className={`${style.btnWrapper} ${
                        paymentMethod.status ? "" : "disabled"
                      }`}
                      onClick={() => {
                        if (paymentMethod.status) {
                          onSelectPayment(paymentMethod.name);
                        }
                      }}
                    >
                      {paymentMethod.image ? (
                        <LazyLoadImage
                          src={`${import.meta.env.VITE_API}${
                            paymentMethod.image
                          }`}
                          alt="payment method"
                        />
                      ) : (
                        <span>{paymentMethod.name}</span>
                      )}
                    </div>
                  );
                }
              )}
            </>
          )}
        </div>
      </div>
      <div className={style.circleBlur}></div>

      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
        showLocationDetails={selectedDiningOption === PICK_UP ? false : true}
        backOnClick={handleBackClick}
        startOverBtnOnClick={() => setOpenStartOverModal(true)}
      />

      <StartOverConfirmation
        open={openStartOverModal}
        onClose={() => setOpenStartOverModal(false)}
      />

      <PrivacyNote
        open={openPrivacyNote}
        onClose={() => setOpenPrivacyNote(false)}
      />
      <LoginModal />
    </div>
  );
};

export default PaymentOptions;
