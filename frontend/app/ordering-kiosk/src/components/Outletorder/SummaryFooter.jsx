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
  showContinueToOrder,
  showSelectDineOption,
  showStartOver,
  showBackBtn,
  showDiningDetails,
  showChoosePaymentBtn,
}) {
  const selectedProducts = useSelector((state) => state.order.selectedProducts);

  return (
    <FooterLayout className={styles.viewOrderFooter}>
      <div className={styles.viewOrderFooterInner}>
        <div className={styles.viewOrderFooterDetails}>
          {showDiningDetails && (
            <p>
              <span>Dining Option</span>
              <span>-</span>
            </p>
          )}
          {showDiningDetails && <hr></hr>}
          <p>
            <span>Number of order</span>
            <span>{selectedProducts.length}</span>
          </p>

          <p className={styles.viewOrderFooterBold}>
            <span>TOTAL</span>
            <span>
              PHP {formatNumber(calculateTotalPrice(selectedProducts))}
            </span>
          </p>
        </div>

        <div>
          {showContinueToOrder ? (
            <Button type="white" onClick={continueToOrderOnClick}>
              Continue to order
            </Button>
          ) : null}

          {showSelectDineOption ? (
            <Button type="black" onClick={selectDineOptionOnClick}>
              Proceed to checkout
            </Button>
          ) : null}
          <div>
            {showChoosePaymentBtn ? (
              //   <Button type="white" onClick={choosePaymentOnclick}>
              <Button type="white">Choose payment method</Button>
            ) : null}
          </div>

          {showStartOver ? <Button type="gray">Start over</Button> : null}

          {showBackBtn ? <Button type="white">Back</Button> : null}
        </div>
      </div>
    </FooterLayout>
  );
}

export default SummaryFooter;
