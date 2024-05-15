import React, { useState } from "react";
import style from "./OrderSummary.module.css";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import Progress from "../../components/DineOption/Progress";
import { useDispatch, useSelector } from "react-redux";
import { PICK_UP } from "../../utils/Constants/DiningOptions";
import { formatNumber } from "../../utils/Common/Price";
import { nextStep, previousStep, setOrderStep } from "../../store/order/orderSlice";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";

const OrderSummary = () => {
  const selectedDiningOption = useSelector(state => state.order.diningOption);
  const selectedOutlet = useSelector(state => state.order.selectedOutlet);
  const selectedProducts = useSelector(state => state.order.selectedProducts);
  const dispatch = useDispatch();
  const [openModal, setOpenModal] = useState({startOver: false});

  const onBackClick = () => {
    if (selectedDiningOption === PICK_UP) {
      dispatch(setOrderStep(3));
    }
    else{
      dispatch(previousStep());
    }
  }

  return (
    <>
      <div className={style.topContainer}>
        <Progress width={60} />
      </div>
      <div className={style.mainContainer}>
        <p className={style.title}>Order Summary</p>
        <div className={style.content}>
          <div className={style.outletNameLogo}>
            <img src={`${import.meta.env.VITE_API}/${selectedOutlet.image}`} alt="" />
            <span>{selectedOutlet.name}</span>
          </div>
          <div className={style.orderSummarylist}>
            {selectedProducts.map((product, index) => (
              <div key={product.details.id} className={style.orderList}>
                <div className={style.leftDetails}>
                  <p className={style.countList}>{index + 1}.</p>
                  <div className={style.priceImg}>
                    <img src={`${import.meta.env.VITE_API}/${product.details.image}`} alt={product.details.name} />
                    <div>
                      <p>{product.details.name}</p>
                      <span className={style.price}>&#8369;{formatNumber(product.details.price)}</span>
                    </div>
                  </div>
                </div>
                <div className={style.rightDetails}>
                  <div>x{product.quantity}</div>
                  <div className={style.quantityPrice}>&#8369;{formatNumber(parseFloat(product.details.price) * product.quantity)}</div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
      
      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
        showChoosePaymentBtn={true}
        showLocationDetails={selectedDiningOption === PICK_UP ? false : true}
        backOnClick={onBackClick}
        startOverBtnOnClick={() => setOpenModal({startOver: true})}
        choosePaymentOnClick={() => dispatch(nextStep())}
      />

      <StartOverConfirmation
        open={openModal.startOver}
        onClose={() => setOpenModal({startOver: false})}
      />
    </>
  );
};

export default OrderSummary;