import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import CustomInputField from "./CustomField";
import styles from "./GCashScanPage.module.css";
import { useDispatch } from "react-redux";
import { useState } from "react";
import { setGCashPaymentDetails } from "../../store/order/orderSlice";

function ConfirmGCashPayment({ open, onClose }) {
    const dispatch = useDispatch();
    const [gcashPaymentDetails, setGcashPaymentDetails] = useState({
        name: "",
        phoneNumber: "",
        referenceNumber: ""
    });

    const handleConfirm = () => {
        dispatch(setGCashPaymentDetails(gcashPaymentDetails));
        alert("Payment details saved successfully!");
    }

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
                    disabled={!gcashPaymentDetails.name || !gcashPaymentDetails.phoneNumber || !gcashPaymentDetails.referenceNumber}
                >
                    Confirm
                </Button>
            </div>
        </BottomModal>
    );
}

export default ConfirmGCashPayment;