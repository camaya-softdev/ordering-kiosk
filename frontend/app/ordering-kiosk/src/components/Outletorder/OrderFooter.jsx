import Footer from "../../layout/FooterLayout";
import Button from "../Common/Button";
import styles from './OutletOrder.module.css';
import { useDispatch, useSelector } from "react-redux";
import { previousStep } from "../../store/order/orderSlice";
import BagIcon from "../Common/BagIcon";
import { useState } from "react";
import StartOverConfirmation from "./StartOverConfirmation";
import { calculateTotalPrice } from "../../utils/Common/Price";
import ViewOrder from "./ViewOrder";

function OrderFooter(){
    const dispatch = useDispatch();
    const [openModal, setOpenModal] = useState({
        startOver: false,
        viewOrder: false
    });
    const selectedProducts = useSelector(state => state.order.selectedProducts);

    return(
        <Footer className={styles.footer}>
            <div className={styles.footerButtons}>
                <Button onClick={() => dispatch(previousStep())}>
                    Back to Outlets
                </Button>

                <Button onClick={() => setOpenModal((prev) => ({...prev, startOver: true}))}>
                    Start Over
                </Button>
            </div>

            <div className={styles.summaryWrapper}>
                <div className={styles.priceWrapper}>
                    <div className={styles.iconBag}>
                        <BagIcon number={selectedProducts.length}/>
                    </div>

                    <p className={styles.totalPrice}>
                        PHP {calculateTotalPrice(selectedProducts).toFixed(2)}
                    </p>
                </div>


                <div className={styles.summaryButtons}>
                    <Button 
                        type="white"
                        disabled={!selectedProducts.length}
                        onClick={() => setOpenModal((prev) => ({...prev, viewOrder: true}))}
                    >
                        View order
                    </Button>

                    <Button 
                        type="black"
                        disabled={!selectedProducts.length}
                    >
                        Proceed to checkout
                    </Button>
                </div>
            </div>

            <StartOverConfirmation
                open={openModal.startOver}
                onClose={() => setOpenModal((prev) => ({...prev, startOver: false}))}
            />

            <ViewOrder
                open={openModal.viewOrder}
                onClose={() => setOpenModal((prev) => ({...prev, viewOrder: false}))}
            />
        </Footer>
    );
}

export default OrderFooter;