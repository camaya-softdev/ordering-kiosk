import React from "react";
import style from "./OrderSummary.module.css";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import Progress from "../../components/DineOption/Progress";
import armynavylogo from "../../assets/army-navy-logo.png";
import classicburger from "../../assets/menuitem/plant-based-1.png";

const OrderSummary = () => {
  return (
    <>
      <Progress width={60} />
      <div className={style.mainContainer}>
        <p className={style.title}>Order Summary</p>
        <div className={style.content}>
          <div className={style.outletNameLogo}>
            <img src={armynavylogo} alt="" srcset="" />
            <span>Army Navy</span>
          </div>
          <div className={style.orderSummarylist}>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
            <div className={style.orderList}>
              <div className={style.leftDetails}>
                <p className={style.countList}>1.</p>
                <div className={style.priceImg}>
                  <img src={classicburger} />
                  <div>
                    <p>Classic burger</p>
                    <span className={style.price}>P250</span>
                  </div>
                </div>
              </div>
              <div className={style.rightDetails}>
                <div>x2</div>
                <div className={style.quantityPrice}>P500</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
        showChoosePaymentBtn={true}
      />
    </>
  );
};

export default OrderSummary;
