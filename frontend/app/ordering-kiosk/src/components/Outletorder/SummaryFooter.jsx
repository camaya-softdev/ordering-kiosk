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
    showLocationDetails
}){
    const order = useSelector(state => state.order);

    return(
        <FooterLayout className={styles.viewOrderFooter}>
            <div className={styles.viewOrderFooterInner}>
                <div className={styles.viewOrderFooterDetails}>
                    {
                        showDiningDetails &&
                        <p>
                            <span>Dining Option</span>
                            <span>{order.diningOption ? order.diningOption : '-'}</span>
                        </p>
                    }
                    {
                        showLocationDetails &&
                        <>
                            <p style={{marginTop: "40px"}}>
                                <span>Location</span>
                                <span>{order.location ? order.location.name : '-'}</span>
                            </p>
                            <p>
                                <span>Table/Room Number</span>
                                <span>{order.area ? order.area.name : '-'}</span>
                            </p>
                        </>
                    }
                    {
                        (showDiningDetails || showLocationDetails) &&
                        <hr></hr>
                    }
                    <p>
                        <span>Number of order</span>
                        <span>{order.selectedProducts.length}</span>
                    </p>

                    <p className={styles.viewOrderFooterBold}>
                        <span>TOTAL</span>
                        <span>PHP {formatNumber(calculateTotalPrice(order.selectedProducts))}</span>
                    </p>
                </div>

                <div>
                    {
                        showContinueToOrder ? 
                        <Button type="white" onClick={continueToOrderOnClick}>
                            Continue to order
                        </Button>:null
                    }

                    {
                        showSelectDineOption ?
                        <Button type="black" onClick={selectDineOptionOnClick}>
                            Proceed to checkout
                        </Button>:null
                    }

                    {
                        showStartOver ?
                        <Button type="gray" onClick={startOverBtnOnClick}>
                            Start over
                        </Button>:null
                    }

                    {
                        showBackBtn ?
                        <Button type="white" onClick={backOnClick}>
                            Back
                        </Button>:null
                    }
                </div>

            </div>
        </FooterLayout>
    );
}

export default SummaryFooter;