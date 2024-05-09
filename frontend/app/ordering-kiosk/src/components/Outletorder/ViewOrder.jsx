import { useSelector } from "react-redux";
import BottomModal from "../Common/BottomModal";
import styles from "./OutletOrder.module.css";

function ViewOrder({open, onClose}){
    const selectedProducts = useSelector(state => state.order.selectedProducts);

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
                            
                        </div>
                    </div>
                ))}
            </div>
        </BottomModal>
    );
}

export default ViewOrder;