import { useSelector } from "react-redux";
import BottomModal from "../Common/BottomModal";
import styles from "./OutletOrder.module.css";
import StepperInput from "../Common/StepperInput";
import FooterLayout from '../../layout/FooterLayout';
import { calculateTotalPrice, formatNumber } from "../../utils/Common/Price";
import Button from "../Common/Button";
import { useDispatch } from 'react-redux';
import { increaseProductQuantity, decreaseProductQuantity } from '../../store/order/orderSlice';

function ViewOrder({open, onClose}){
    const selectedProducts = useSelector(state => state.order.selectedProducts);
    const dispatch = useDispatch();

    return(
        <BottomModal 
            open={open} 
            onClose={onClose}
            title="Your order"
            showTitleDivider={true}
        >
            <div className={styles.viewOrderDetails}>
            {selectedProducts.map((product, index) => (
                    <div 
                        key={index}
                        className={styles.viewOrderItem}
                    >
                        <span>{index+1}.</span>

                        <div className={styles.viewOrderItemDetails}>
                            <div className={styles.viewOrderImage}>
                                <img src={`${import.meta.env.VITE_API}${product.details.image}`} alt={product.details.name} />
                            </div>

                            <div className={styles.viewOrderItemInfo}>
                                <span>{product.details.name}</span>
                                <span>&#8369;{formatNumber(product.details.price)}</span>
                            </div>
                        </div>

                        <div className={styles.viewOrderItemQuantity}>
                            <div>
                                <StepperInput
                                    size="small"
                                    initialValue={product.quantity}
                                    min={0}
                                    max={product.details.stock}
                                    onValueChange={newValue => {
                                        if (newValue > product.quantity) {
                                            dispatch(increaseProductQuantity({ product: product.details }));
                                        } else if (newValue < product.quantity) {
                                            if(newValue === 0) alert("are you sure?");
                                            dispatch(decreaseProductQuantity({ product: product.details }));
                                        }
                                    }}
                                />

                                <span>&#8369;{formatNumber(product.details.price)}</span>
                            </div>
                        </div>

                    </div>
                ))}
            </div>
            
            <FooterLayout className={styles.viewOrderFooter}>
                <div>
                    <div>
                        <p>
                            <span>Number of order</span>
                            <span>{selectedProducts.length}</span>
                        </p>

                        <p>
                            <span>TOTAL</span>
                            <span>PHP {formatNumber(calculateTotalPrice(selectedProducts))}</span>
                        </p>
                    </div>

                    <div>
                        <Button type="white" onClick={onClose}>
                            Continue to order
                        </Button>

                        <Button type="black">
                            Proceed to checkout
                        </Button>
                    </div>

                </div>
            </FooterLayout>
        </BottomModal>
    );
}

export default ViewOrder;