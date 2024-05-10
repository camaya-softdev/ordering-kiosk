import style from "./DineOptions.module.css";
import dineinlogo from "../../assets/dineoptionlogo/dinein.svg";
import deliverlogo from "../../assets/dineoptionlogo/deliver.svg";
import takeawaylogo from "../../assets/dineoptionlogo/takeaway.svg";
import Progress from "../../components/DineOption/Progress";
import FooterLayout from "../../layout/FooterLayout";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";

function DineOptions() {
  return (
    <>
      <div className={style.topContainer}>
        <Progress width={30} />
      </div>
      <div className={style.mainContainer}>
        <div className={style.wrapper}>
          <span className={style.text}>Where would you like to eat?</span>
          <div className={style.section}>
            <div className={style.wrapperOption}>
              <div className={style.buttonOption}>
                <span>DINE IN</span>
                <img src={dineinlogo} alt="Dine In Logo" />
              </div>
              <div className={style.buttonOption}>
                <span>PICKUP TAKEAWAY</span>
                <img src={takeawaylogo} alt="Takeaway Logo" />
              </div>
              <div className={style.buttonOption}>
                <span>DELIVERY</span>
                <img src={deliverlogo} alt="Delivery Logo" />
              </div>
            </div>
          </div>
        </div>
        <div className={style.circleBlur}></div>
      </div>
      {/* <div className={style.dineoptionFooter}>
        <div className={style.topDetails}>
          <div className={style.diningOptionTitle}>
            <span className={style.spanTitle}>Dining option</span>
            <span className={style.spanDetails}>DINE</span>
          </div>
          <div className={style.rowPerDetails}>
            <span className={style.spanTitle}>Location</span>
            <span className={style.spanDetails}>-</span>
          </div>
          <div className={style.rowPerDetails}>
            <span className={style.spanTitle}>Table/Room Number</span>
            <span className={style.spanDetails}>-</span>
          </div>
        </div>
        <div className={style.bottomDetails}>
          <div className={style.topDetails}>
            <div className={style.rowPerDetails}>
              <span className={style.spanTitle}>Number of order</span>
              <span className={style.spanDetails}>-</span>
            </div>
            <div className={style.rowPerDetails}>
              <span className={style.spanTotalTitle}>Total</span>
              <span className={style.spanTotalDetails}>-</span>
            </div>
          </div>
          <div className={style.buttonContainer}>
            <div className={style.proceedPaymentBtn}>Choose payment method</div>
            <div className={style.backOptionsBtn}>
              <div className={style.startOverBtn}>Start over</div>
              <div className={style.backBtn}>Back</div>
            </div>
          </div>
        </div>
      </div> */}
      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
      />
    </>
  );
}

export default DineOptions;
