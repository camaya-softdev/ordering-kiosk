import React from "react";
import style from "./OrderConfirmed.module.css";
import FooterLayout from "../../layout/FooterLayout";
import CamayaLogo from "../../assets/camaya-logo.svg";
import CheckIcon from "../../assets/CheckIcon.svg";
const OrderConfirmed = () => {
  return (
    <div>
      <div className={style.mainContainer}>
        <div>
          <img src={CheckIcon} />
        </div>
        <div className={style.pOrderConfirm}>
          <p>Order Confirmed!</p>
        </div>
        <div className={style.prcdOutlet}>
          <p>
            Please proceed to
            <span> Outlet name </span>
            to pick up your order.
          </p>
        </div>
        <div className={style.OrderContent}>
          <div className={style.frstCol}>Order Details</div>
          <div className={style.flexStyleFirst}>
            <p>Order number</p>
            <span>12</span>
          </div>
          <div className={style.flexStyle}>
            <div className={style.flexStyleFirstChld}>
              <p>Dining Option</p>
              <span>DELIVER</span>
            </div>
            <div className={style.flexStyleScndChld}>
              <div className={style.flexStyleChild}>
                <p>Location</p>
                <span>Aqua Fun Hotel</span>
              </div>
              <div className={style.flexStyleChild}>
                <p>Table/Room Number</p>
                <span>Room 101</span>
              </div>
            </div>
          </div>
          <div className={style.flexStyle}>
            <div className={style.flexStyleFirstChld}>
              <span>Army Navy</span>
            </div>
            <div className={style.flexStyleScndChld}>
              <div className={style.flexStyleChild}>
                <p>Classic Burder (PHP 250.00)</p>
                <p>x1</p>
              </div>
              <p className={style.overAllTotal}>PHP 250.00</p>
            </div>
          </div>
          <div className={style.flexStyle}>
            <div className={style.flexStyleScndChld}>
              <div className={style.flexStyleChild}>
                <p>Total</p>
                <p>PHP 250</p>
              </div>
              <div className={style.flexStyleChild}>
                <p>Payment (VIA GCASH)</p>
                <p>PHP 250</p>
              </div>
              <div className={style.flexStyleLastChld}>
                <span>REFERENCE NUMBER</span>
                <span>1016553664530</span>
              </div>
            </div>
          </div>
        </div>
        <div className={style.paragraphMsg}>
          <p>Take a picture of your order details for reference.</p>
        </div>
      </div>
      <FooterLayout className={style.footer}>
        <img src={CamayaLogo} />
        <div className={style.backButton}>
          <span className={style.title}>Back to home</span>
        </div>
      </FooterLayout>
    </div>
  );
};

export default OrderConfirmed;
