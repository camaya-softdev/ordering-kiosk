import React from "react";
import style from "./OrderPending.module.css";
import FooterLayout from "../../layout/FooterLayout";
import CamayaLogo from "../../assets/camaya-logo.svg";
import ClockIcon from "../../assets/ClockIcon.svg";
import Button from "../../components/Common/Button";

const OrderPending = () => {
  return (
    <div>
      <div className={style.mainContainer}>
        <div className={style.pOrderConfirm}>
          <img src={ClockIcon} />
          <p>Order Pending...</p>
        </div>
        <div className={style.prcdOutlet}>
          <p>
            Kindly take a picture of your order details for reference then
            proceed to <span>Army Navy</span> to pay.
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
            </div>
          </div>
        </div>
        <div className={style.paragraphMsg}>
          <Button type="white" style={{ width: "100%" }}>
            Back
          </Button>
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

export default OrderPending;
