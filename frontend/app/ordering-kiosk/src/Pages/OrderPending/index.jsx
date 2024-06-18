import React, { useEffect } from "react";
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
import { CASH_PAYMENT } from "../../utils/Constants/PaymentOptions";
import LoginModal from "../../components/Login/LoginModal";
import { LazyLoadImage } from "react-lazy-load-image-component";

class OrderPending extends React.Component {
  printRef = React.createRef();
  receiptComponentsRef = React.createRef();
  state = {
    countdown: 30,
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
    const { order, auth, dispatch } = this.props;
    const { countdown, showScrollDivs } = this.state;
    const groupedProducts = order.selectedProducts.reduce((acc, product) => {
      const outletId = product.outlet.id;
      if (!acc[outletId]) {
        acc[outletId] = [];
      }
      acc[outletId].push(product);
      return acc;
    }, {});

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
                <LazyLoadImage
                  src={
                    order.paymentOption === CASH_PAYMENT ? ClockIcon : CheckIcon
                  }
                  alt="icon"
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
                    // auth.assign_to_outlet === null ? (
                    //   <>
                    //     Kindly take your order slip for reference then proceed
                    //     and pay at any Ordering Booth available on any food
                    //     outlet to process your order.
                    //   </>
                    // ) : (
                    //   <>
                    //     Kindly take your order slip for reference then proceed
                    //     and pay at the Ordering Booth beside
                    //     <span> Pancake House </span> to process your order.
                    //   </>
                    // )
                    <>
                      Kindly take your order slip for reference then proceed and
                      pay at the Ordering Booth beside
                      <span> Pancake House </span> to process your order.
                    </>
                  ) : (
                    <>
                      We are now preparing your order. If there are any
                      concerns, we will contact you.
                      <br />
                      <br />
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
                      {order.paymentOption === CASH_PAYMENT ? (
                        <p>Official Receipt will be provided upon payment.</p>
                      ) : (
                        <p>
                          Official Receipt will be provided upon serving your
                          food.
                        </p>
                      )}
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
                    {Object.entries(groupedProducts).map(
                      ([outletId, products]) => (
                        <div key={outletId} className={style.orderList}>
                          <div className={style.orderOutlet}>
                            <p>
                              <span>{products[0].outlet.name}</span>
                            </p>
                          </div>

                          <div className={style.orderProducts}>
                            {products.map((product, index) => (
                              <div className={style.orderItem} key={index}>
                                <div className={style.itemDetails}>
                                  <p>
                                    <span>
                                      {product.details
                                        ? product.details.name
                                        : "-"}
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
                            ))}
                          </div>
                        </div>
                      )
                    )}

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
                          <div>
                            <div className={style.footerRowDetails}>
                              <p>
                                <span>NAME</span>
                                <span>{order.gcashPaymentDetails.name}</span>
                              </p>
                            </div>
                          </div>
                          <div>
                            <div className={style.footerRowDetails}>
                              <p>
                                <span>CONTACT NUMBER</span>
                                <span>
                                  {order.gcashPaymentDetails.phoneNumber}
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
              <LazyLoadImage src={ScrollGIF} alt="scroll gif" />
            </div>
          )}
          <p className={style.countdownTimer}>Page will reset in {countdown}</p>
        </div>
        <FooterLayout className={style.footer}>
          <div
            className={style.backButton}
            onClick={() => dispatch(resetOrder())}
          >
            <span className={style.title}>Back to home</span>
          </div>
        </FooterLayout>
        <LoginModal />
      </div>
    );
  }
}

const mapStateToProps = (state) => ({
  order: state.order,
  auth: state.auth,
});

export default connect(mapStateToProps)(OrderPending);
