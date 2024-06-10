import { useState } from "react";
import style from "./OrderSummary.module.css";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import Progress from "../../components/DineOption/Progress";
import { useDispatch, useSelector } from "react-redux";
import { PICK_UP } from "../../utils/Constants/DiningOptions";
import { formatNumber } from "../../utils/Common/Price";
import {
  nextStep,
  previousStep,
  setOrderStep,
  setClassAnimate,
} from "../../store/order/orderSlice";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import LoginModal from "../../components/Login/LoginModal";
import { LazyLoadImage } from 'react-lazy-load-image-component';

const OrderSummary = () => {
  const selectedDiningOption = useSelector((state) => state.order.diningOption);
  const selectedOutlet = useSelector((state) => state.order.selectedOutlet);
  const classAnimate = useSelector((state) => state.order.classAnimate);
  const selectedProducts = useSelector((state) => state.order.selectedProducts);
  const dispatch = useDispatch();
  const [openModal, setOpenModal] = useState({ startOver: false });

  const groupedProducts = selectedProducts.reduce((acc, product) => {
    const outletId = product.outlet.id;
    if (!acc[outletId]) {
      acc[outletId] = [];
    }
    acc[outletId].push(product);
    return acc;
  }, {});

  const onBackClick = () => {
    if (selectedDiningOption === PICK_UP) {
      dispatch(setOrderStep(3));
      dispatch(setClassAnimate("forwardAnimation"));
    } else {
      dispatch(previousStep());
      dispatch(setClassAnimate("forwardAnimation"));
    }
  };
  const onProceedClick = () => {
    dispatch(nextStep());
    dispatch(setClassAnimate("backwardAnimation"));
  };
  
  return (
    <>
      <div className={`${style[classAnimate]}`}>
        <div className={style.topContainer}>
          <Progress />
        </div>
        <div className={style.mainContainer}>
          <p className={style.title}>Order Summary</p>
          <div className={style.content}>
            {Object.entries(groupedProducts).map(([outletId, products]) => (
              <div key={outletId}>
                <div className={style.outletNameLogo}>
                  <LazyLoadImage
                    src={`${import.meta.env.VITE_API}/${products[0].outlet.image}`}
                    alt="outlet image"
                  />
                  <span>{products[0].outlet.name}</span>
                </div>
                <div className={style.orderSummarylist}>
                  {products.map((product, index) => (
                    <div key={product.details.id} className={style.orderList}>
                      <div className={style.leftDetails}>
                        <p className={style.countList}>{index + 1}.</p>
                        <div className={style.priceImg}>
                          <LazyLoadImage
                            src={`${import.meta.env.VITE_API}/${product.details.image}`}
                            alt={product.details.name}
                          />
                          <div>
                            <p>{product.details.name}</p>
                            <span className={style.price}>
                              &#8369;{formatNumber(product.details.price)}
                            </span>
                          </div>
                        </div>
                      </div>
                      <div className={style.rightDetails}>
                        <div>x{product.quantity}</div>
                        <div className={style.quantityPrice}>
                          &#8369;
                          {formatNumber(
                            parseFloat(product.details.price) * product.quantity
                          )}
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>

      <SummaryFooter
        className={style.summaryFooter}
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
        showChoosePaymentBtn={true}
        showLocationDetails={selectedDiningOption === PICK_UP ? false : true}
        backOnClick={onBackClick}
        startOverBtnOnClick={() => setOpenModal({ startOver: true })}
        choosePaymentOnClick={onProceedClick}
      />

        <StartOverConfirmation
          open={openModal.startOver}
          onClose={() => setOpenModal({ startOver: false })}
        />
        <LoginModal/>
      </div>
    </>
  );
};

export default OrderSummary;
