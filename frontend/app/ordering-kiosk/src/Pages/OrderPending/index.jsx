import React from "react";
import style from "./OrderPending.module.css";
import FooterLayout from "../../layout/FooterLayout";
import CamayaLogo from "../../assets/camaya-logo.svg";
import ClockIcon from "../../assets/ClockIcon.svg";
import { connect } from "react-redux";
import { resetOrder } from "../../store/order/orderSlice";
import { calculateTotalPrice, formatNumber } from "../../utils/Common/Price";
import ReactToPrint from 'react-to-print';

class OrderPending extends React.Component {
  printRef = React.createRef();

  componentDidMount() {
    if (this.printRef.current) {
      this.printRef.current.handlePrint();
    }
  }
  render() {
    const { order, dispatch } = this.props;

    return (
      <div>
        <ReactToPrint
          trigger={() => <></>}
          content={() => this.componentRef}
          ref={this.printRef}
          onAfterPrint={() => console.log('Print dialog closed.')}
        />
        <div className={style.mainContainer} id="print-me" ref={el => (this.componentRef = el)}>
          <div className={style.pOrderConfirm}>
            <img src={ClockIcon} />
            <p>Order Pending...</p>
          </div>
          <div className={style.prcdOutlet}>
            <p>
              Kindly take a picture of your order details for reference then
              proceed to <span>{order.selectedOutlet.name}</span> to pay.
            </p>
          </div>
          <div className={style.OrderContent}>
            <div className={style.frstCol}>Order Details</div>
            <div className={style.flexStyleFirst}>
              <p>Order number</p>
              <span>{order.createdTransaction?.id ?? '-'}</span>
            </div>
            <div className={style.flexStyle}>
              <div className={style.flexStyleFirstChld}>
                <p>Dining Option</p>
                <span>{order.diningOption.toUpperCase()}</span>
              </div>
              {
                order.location !== null && order.area !== null ?
                <div className={style.flexStyleScndChld}>
                  <div className={style.flexStyleChild}>
                    <p>Location</p>
                    <span>{order.location.name}</span>
                  </div>
                  <div className={style.flexStyleChild}>
                    <p>Table/Room Number</p>
                    <span>{order.area.name}</span>
                  </div>
                </div> : null
              }
            </div>
            <div className={style.flexStyle}>
              <div className={style.flexStyleFirstChld}>
                <span>{order.selectedOutlet.name}</span>
              </div>

              {
                Object.entries(order.selectedProducts).map(([key, product]) => {
                  return (
                    <div className={style.flexStyleScndChld} key={key}>
                      <div className={style.flexStyleChild}>
                        <div>
                          <label className={style.productName}>
                            {product.details.name}
                          </label>
                          {` (PHP ${formatNumber(product.details.price)})`}
                        </div>
                        <p>{`x${product.quantity}`}</p>
                      </div>
                      <p className={style.overAllTotal}>{`PHP ${formatNumber(product.details.price * product.quantity)}`}</p>
                    </div>
                  );
                })
              }
            </div>
            <div className={style.flexStyle}>
              <div className={style.flexStyleScndChld}>
                <div className={style.flexStyleChild}>
                  <p>Total</p>
                  <span>PHP {formatNumber(calculateTotalPrice(order.selectedProducts))}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <FooterLayout className={style.footer}>
          <img src={CamayaLogo} />
          <div className={style.backButton} onClick={() => dispatch(resetOrder())}>
            <span className={style.title}>Back to home</span>
          </div>
        </FooterLayout>
      </div>
    );
  }
}

const mapStateToProps = state => ({
  order: state.order
});

export default connect(mapStateToProps)(OrderPending);