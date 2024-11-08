import { useSelector } from "react-redux";
import FooterLayout from "../../layout/FooterLayout";
import { calculateTotalPrice, formatNumber } from "../../utils/Common/Price";
import Button from "../Common/Button";
import styles from "./OutletOrder.module.css";

function SummaryFooter({
  continueToOrderOnClick,
  selectDineOptionOnClick,
  startOverBtnOnClick,
  backOnClick,
  choosePaymentOnClick,
  confirmPaymentOnClick,
  showContinueToOrder,
  showSelectDineOption,
  showStartOver,
  showBackBtn,
  showDiningDetails,
  showChoosePaymentBtn,
  showLocationDetails,
  showConfirmPaymentBtn,
  footerFullModal,
}) {
  const order = useSelector((state) => state.order);

  return (
    <FooterLayout
      className={`${styles.viewOrderFooter} ${
        footerFullModal ? styles.fullviewOrderFooter : ""
      }`}
    >
      <div className={styles.viewOrderFooterInner}>
        <div className={styles.viewOrderFooterDetails}>
          {showDiningDetails && (
            <p>
              <span>Dining Option</span>
              <span>
                {order.diningOption ? order.diningOption.toUpperCase() : "-"}
              </span>
            </p>
          )}
          {showLocationDetails && (
            <>
              <p style={{ marginTop: "40px" }}>
                <span>Location</span>
                <span>{order.location ? order.location.name : "-"}</span>
              </p>
              <p>
                <span>Table/Room Number</span>
                <span>{order.area ? order.area.name : "-"}</span>
              </p>
            </>
          )}
          {(showDiningDetails || showLocationDetails) && <hr></hr>}
          <p>
            <span>Number of order</span>
            <span>{order.selectedProducts.length}</span>
          </p>

          <p className={styles.viewOrderFooterBold}>
            <span>TOTAL</span>
            <span>
              PHP {formatNumber(calculateTotalPrice(order.selectedProducts))}
            </span>
          </p>
        </div>

        <div className={styles.btnsOption}>
          <div className={styles.paymentMethod}>
            {showChoosePaymentBtn ? (
              <Button type="Red" onClick={choosePaymentOnClick}>
                Choose payment method
              </Button>
            ) : null}

            {showConfirmPaymentBtn ? (
              <Button type="Red" onClick={confirmPaymentOnClick}>
                Confirm payment (provide reference number)
              </Button>
            ) : null}
          </div>

          <div className={styles.bottomBtn}>
            {showStartOver ? (
              <Button
                type="gray"
                className={styles.btnBottom}
                onClick={startOverBtnOnClick}
              >
                Start over
              </Button>
            ) : null}

            {showBackBtn ? (
              <Button type="white" onClick={backOnClick}>
                Back
              </Button>
            ) : null}

            {showContinueToOrder ? (
              <Button type="white" onClick={continueToOrderOnClick}>
                Continue to order
              </Button>
            ) : null}

            {showSelectDineOption ? (
              <Button type="Red" onClick={selectDineOptionOnClick}>
                Proceed to checkout
              </Button>
            ) : null}
          </div>
        </div>
      </div>
    </FooterLayout>
  );
}

export default SummaryFooter;
