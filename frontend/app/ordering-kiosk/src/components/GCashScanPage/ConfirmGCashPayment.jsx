import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import CustomInputField from "./CustomField";
import styles from "./GCashScanPage.module.css";
import { useDispatch, useSelector } from "react-redux";
import { useEffect, useState } from "react";
import { nextStep, setCreatedTransaction, setGCashPaymentDetails } from "../../store/order/orderSlice";
import { useCreateTransaction } from "../../services/TransactionService";
import { GCASH_PAYMENT } from "../../utils/Constants/PaymentOptions";

function ConfirmGCashPayment({ open, onClose }) {
    const order = useSelector(state => state.order);
    const dispatch = useDispatch();
    const placeOrderQuery = useCreateTransaction();
    const [gcashPaymentDetails, setGcashPaymentDetails] = useState({
        name: "",
        phoneNumber: "",
        referenceNumber: ""
    });
    

    const handleConfirm = () => {
        dispatch(setGCashPaymentDetails(gcashPaymentDetails));
    }

    const handleSave = async () => {
        try {
            const response = await (await placeOrderQuery).mutateAsync(order);
            dispatch(setCreatedTransaction(response.data.transaction));
            dispatch(nextStep());
        } catch (error) {
            alert("Cannot create transaction. Please try again.");
        }
    };

    useEffect(() => {
        if (order.paymentOption === GCASH_PAYMENT && order.gcashPaymentDetails !== null) {
          handleSave();
        }
    }, [order.paymentOption, order.gcashPaymentDetails]);

    return (
        <BottomModal
            open={open}
            onClose={onClose}
        >
            <div className={styles.modalFields}>
                <CustomInputField
                    label="Enter reference number"
                    placeholder="e.g 0123456789"
                    value={gcashPaymentDetails.referenceNumber}
                    onChange={(e) => setGcashPaymentDetails({ ...gcashPaymentDetails, referenceNumber: e.target.value })}
                />

                <CustomInputField
                    label="Enter your name"
                    placeholder="John Doe"
                    value={gcashPaymentDetails.name}
                    onChange={(e) => setGcashPaymentDetails({ ...gcashPaymentDetails, name: e.target.value })}
                />

                <CustomInputField
                    label="Enter your phone number"
                    placeholder="0912 345 6789"
                    value={gcashPaymentDetails.phoneNumber}
                    onChange={(e) => setGcashPaymentDetails({ ...gcashPaymentDetails, phoneNumber: e.target.value })}
                />
            </div>

            <div className={styles.modalButtons}>
                <Button type="white" onClick={onClose}>Back</Button>

                <Button 
                    type="black"
                    onClick={handleConfirm}
                    loading={placeOrderQuery.isLoading}
                    disabled={!gcashPaymentDetails.name || !gcashPaymentDetails.phoneNumber || !gcashPaymentDetails.referenceNumber || placeOrderQuery.isLoading}
                >
                    Confirm
                </Button>
            </div>
        </BottomModal>
    );
}

export default ConfirmGCashPayment;