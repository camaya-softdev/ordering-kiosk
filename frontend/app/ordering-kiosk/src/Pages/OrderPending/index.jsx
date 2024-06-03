import React from "react";
import style from "./OrderResult.module.css";
import FooterLayout from "../../layout/FooterLayout";
import CamayaLogo from "../../assets/camaya-logo.svg";
import ClockIcon from "../../assets/ClockIcon.svg";
import CheckIcon from "../../assets/CheckIcon.svg";
import ScrollGIF from "../../assets/scrolldown.gif";
import { connect } from "react-redux";
import { resetOrder } from "../../store/order/orderSlice";
import { calculateTotalPrice, formatNumber } from "../../utils/Common/Price";
import ReactToPrint from "react-to-print";
import {
  CASH_PAYMENT,
  GCASH_PAYMENT,
} from "../../utils/Constants/PaymentOptions";

class OrderPending extends React.Component {
  printRef = React.createRef();
  receiptComponentsRef = React.createRef();
  state = {
    countdown: 10,
    showScrollDivs: false,
  };

  componentDidMount() {
    if (this.printRef.current) {
      this.printRef.current.handlePrint();
    }

    this.timer = setInterval(() => {
      this.setState(
        (prevState) => ({
          countdown: prevState.countdown - 1,
        }),
        () => {
          if (this.state.countdown <= 0) {
            clearInterval(this.timer);
            this.props.dispatch(resetOrder());
          }
        }
      );
    }, 1000);

    this.checkHeight();
  }

  componentWillUnmount() {
    clearInterval(this.timer);
  }

  checkHeight() {
    if (this.receiptComponentsRef.current) {
      const height = this.receiptComponentsRef.current.clientHeight;
      if (height >= 900) {
        this.setState({ showScrollDivs: true });
      }
    }
  }

  render() {
    const { order, dispatch } = this.props;
    const { countdown, showScrollDivs } = this.state;

    return (
      <div>
        <ReactToPrint
          trigger={() => <></>}
          content={() => this.componentRef}
          ref={this.printRef}
          // onAfterPrint={() => {
          //   setTimeout(() => {
          //     dispatch(resetOrder());
          //   }, 10000);
          // }}
        />
        <div
          className={style.resultWrapper}
          id="print-me"
          ref={(el) => (this.componentRef = el)}
        >
          <div className={style.innerWrapper}>
            <div className={style.iconWrapper}>
              <div className={style.iconDetails}>
                <img
                  src={
                    order.paymentOption === CASH_PAYMENT ? ClockIcon : CheckIcon
                  }
                />
                <span className={style.orderStatus}>
                  {order.paymentOption === CASH_PAYMENT
                    ? "Order Pending..."
                    : "Order Confirmed!"}
                </span>
              </div>
            </div>

            <div className={style.resultNotes}>
              <div className={style.logoText}>
                <p>
                  {order.paymentOption === CASH_PAYMENT ? (
                    <>
                      Kindly take your order slip for reference then proceed to{" "}
                      <span>{order.selectedOutlet.name}</span> to pay.
                    </>
                  ) : (
                    <>
                      Army Navy is preparing your order. If there are any
                      concerns, we will contact you.
                      <br></br>
                      <br></br>
                      Kindly take your order slip for reference.
                    </>
                  )}
                </p>
              </div>
            </div>

            <div className={style.orderDetails}>
              <div
                className={style.receiptComponents}
                ref={this.receiptComponentsRef}
              >
                <div className={style.orderSummary}>
                  <div className={style.innerSummary}>
                    <div className={style.summaryTitle}>
                      <span>Order details</span>
                    </div>

                    <div className={style.summaryRow}>
                      <div>
                        <span>ORDER NUMBER</span>
                        <span>{order.createdTransaction?.id ?? "-"}</span>
                      </div>
                    </div>
                    <hr className={style.line} />
                    <div className={style.summaryRow}>
                      <div>
                        <span>Dining Option</span>
                        <span>{order.diningOption.toUpperCase() ?? "-"}</span>
                      </div>
                    </div>
                    {order.location !== null && order.area !== null ? (
                      <div className={style.summaryRow}>
                        <div>
                          <span>Location</span>
                          <span>{order.location.name}</span>
                        </div>
                        <div>
                          <span>Table/Room Number</span>
                          <span>{order.area.name}</span>
                        </div>
                      </div>
                    ) : null}
                    <hr className={style.line} />
                    <div className={style.orderList}>
                      <div className={style.orderOutlet}>
                        <p>
                          <span>{order.selectedOutlet.name}</span>
                        </p>
                      </div>

                      <div className={style.orderProducts}>
                        {Object.entries(order.selectedProducts).map(
                          ([key, product]) => {
                            return (
                              <div
                                className={style.orderItem}
                                key={product.details.id}
                              >
                                <div className={style.itemDetails}>
                                  <p>
                                    <span>
                                      {product.details.name}
                                      {` (PHP ${formatNumber(
                                        product.details.price
                                      )})`}
                                    </span>
                                    <span>{`x${product.quantity}`}</span>
                                  </p>
                                </div>

                                <div className={style.itemTotal}>
                                  <p>
                                    <span>{`PHP ${formatNumber(
                                      product.details.price * product.quantity
                                    )}`}</span>
                                  </p>
                                </div>
                              </div>
                            );
                          }
                        )}
                      </div>
                    </div>

                    <hr className={style.line} />
                    <div className={style.ordersFooter}>
                      <div className={style.footerRow}>
                        <div>
                          <div>
                            <div className={style.footerRowDetails}>
                              <p>
                                <span>TOTAL</span>
                                <span>
                                  PHP{" "}
                                  {formatNumber(
                                    calculateTotalPrice(order.selectedProducts)
                                  )}
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      {order.gcashPaymentDetails !== null ? (
                        <div className={style.footerRow}>
                          <div>
                            <div>
                              <div className={style.footerRowDetails}>
                                <p>
                                  <span>PAYMENT (VIA GCASH)</span>
                                  <span>
                                    PHP{" "}
                                    {formatNumber(
                                      calculateTotalPrice(
                                        order.selectedProducts
                                      )
                                    )}
                                  </span>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      ) : null}
                      <div className={style.footerRow}>
                        <div>
                          <div>
                            <div className={style.footerRowDetails}>
                              <p>
                                <span>DATE</span>
                                <span>
                                  {new Date().toLocaleString("en-US", {
                                    year: "numeric",
                                    month: "long",
                                    day: "numeric",
                                    hour: "numeric",
                                    minute: "numeric",
                                    hour12: true,
                                  })}
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {order.gcashPaymentDetails !== null ? (
                      <div className={style.footerRow}>
                        <div>
                          <div>
                            <div className={style.footerRowDetails}>
                              <p>
                                <span className={style.bold}>
                                  REFERENCE NUMBER
                                </span>
                                <span className={style.bold}>
                                  {order.gcashPaymentDetails.referenceNumber}
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    ) : null}
                  </div>
                </div>
              </div>
            </div>
          </div>
          {showScrollDivs && (
            <div className={style.scrollDivs}>
              <p>Scroll Down</p>
              <img src={ScrollGIF} />
            </div>
          )}
          <p className={style.countdownTimer}>Page will reset in {countdown}</p>
        </div>
        <FooterLayout className={style.footer}>
          <img src={CamayaLogo} />
          <div
            className={style.backButton}
            onClick={() => dispatch(resetOrder())}
          >
            <span className={style.title}>Back to home</span>
          </div>
        </FooterLayout>
      </div>
    );
  }
}

const mapStateToProps = (state) => ({
  order: state.order,
});

export default connect(mapStateToProps)(OrderPending);
