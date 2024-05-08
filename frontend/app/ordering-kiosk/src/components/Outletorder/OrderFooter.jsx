import Footer from "../../layout/FooterLayout";
import Button from "../Common/Button";
import styles from './OutletOrder.module.css';
import { useDispatch } from "react-redux";
import { previousStep } from "../../store/order/orderSlice";
import BagIcon from "../Common/BagIcon";
import { useState } from "react";
import StartOverConfirmation from "./StartOverConfirmation";

function OrderFooter(){
    const dispatch = useDispatch();
    const [startOverModal, setStartOverModal] = useState(false);

    return(
        <Footer className={styles.footer}>
            <div className={styles.footerButtons}>
                <Button onClick={() => dispatch(previousStep())}>
                    Back to Outlets
                </Button>

                <Button onClick={() => setStartOverModal(true)}>
                    Start Over
                </Button>
            </div>

            <div className={styles.summaryWrapper}>
                <div className={styles.priceWrapper}>
                    <div className={styles.iconBag}>
                        <BagIcon number={0}/>
                    </div>

                    <p className={styles.totalPrice}>
                        PHP 0.00
                    </p>
                </div>


                <div className={styles.summaryButtons}>
                    <Button 
                        type="white"
                        disabled={true}
                        onClick={() => alert("View order")}
                    >
                        View order
                    </Button>

                    <Button 
                        type="black"
                        disabled={true}
                    >
                        Proceed to checkout
                    </Button>
                </div>
            </div>

            <StartOverConfirmation
                open={startOverModal}
                onClose={() => setStartOverModal(false)}
            />
        </Footer>
    );
}

export default OrderFooter;