import styles from "./LocationPage.module.css";

function LocationPage() {
  <>
    <div className={style.dineoptionFooter}>
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
    </div>
  </>;
}

export default LocationPage;
