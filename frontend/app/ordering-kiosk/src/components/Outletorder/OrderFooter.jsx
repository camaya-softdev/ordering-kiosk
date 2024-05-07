import Footer from "../../layout/FooterLayout";
import Button from "../Common/Button";
import styles from './OrderFooter.module.css';
import { useDispatch } from "react-redux";
import { previousStep, resetOrder } from "../../store/order/orderSlice";
import BagIcon from "../Common/BagIcon";

function OrderFooter(){

    const dispatch = useDispatch();

    return(
        <Footer className={styles.footer}>
            <div className={styles.footerButtons}>
                <Button onClick={() => dispatch(previousStep())}>
                    Back to Outlets
                </Button>

                <Button onClick={() => dispatch(resetOrder())}>
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
                    <Button type="white">
                        View order
                    </Button>

                    <Button type="black">
                        Proceed to checkout
                    </Button>
                </div>
            </div>

        </Footer>
    );
}

export default OrderFooter;