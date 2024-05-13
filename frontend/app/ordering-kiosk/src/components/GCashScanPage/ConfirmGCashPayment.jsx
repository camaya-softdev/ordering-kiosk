import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import CustomInputField from "./CustomField";
import styles from "./GCashScanPage.module.css";
import Keyboard from "react-simple-keyboard";
import "react-simple-keyboard/build/css/index.css";
import { useState, useEffect, useRef } from "react";
import { useDispatch } from "react-redux";
import { setGCashPaymentDetails } from "../../store/order/orderSlice";

function ConfirmGCashPayment({ open, onClose }) {
    const [gcashPaymentDetails, setGcashPaymentDetails] = useState({
        name: "",
        phoneNumber: "",
        referenceNumber: ""
    });
    const [keyboardInput, setKeyboardInput] = useState('');
    const [layout, setLayout] = useState('default');
    const [selectedField, setSelectedField] = useState('referenceNumber');
    const keyboard = useRef();
    const dispatch = useDispatch();

    useEffect(() => {
        setKeyboardInput(gcashPaymentDetails[selectedField]);
        if (keyboard.current) {
            keyboard.current.setInput(gcashPaymentDetails[selectedField]);
        }
    }, [selectedField]);

    const handleKeyboardInputChange = (input) => {
        setKeyboardInput(input);
        setGcashPaymentDetails({ ...gcashPaymentDetails, [selectedField]: input });
    };

    const handleInputChange = (e, field) => {
        setSelectedField(field);
        setGcashPaymentDetails({ ...gcashPaymentDetails, [field]: e.target.value });
        if (keyboard.current) {
            keyboard.current.setInput(e.target.value);
        }
    };

    const handleKeyPress = (button) => {
        if (button === '{shift}' || button === '{lock}') {
            setLayout(layout === 'default' ? 'shift' : 'default');
        }
    };

    const handleConfirm = () => {
        dispatch(setGCashPaymentDetails(gcashPaymentDetails));
        alert("saved");
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
                    onChange={(e) => handleInputChange(e, 'referenceNumber')}
                    onFocus={() => setSelectedField('referenceNumber')}
                />

                <CustomInputField
                    label="Enter your name"
                    placeholder="John Doe"
                    value={gcashPaymentDetails.name}
                    onChange={(e) => handleInputChange(e, 'name')}
                    onFocus={() => setSelectedField('name')}
                />

                <CustomInputField
                    label="Enter your phone number"
                    placeholder="0912 345 6789"
                    value={gcashPaymentDetails.phoneNumber}
                    onChange={(e) => handleInputChange(e, 'phoneNumber')}
                    onFocus={() => setSelectedField('phoneNumber')}
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

            <Keyboard
                keyboardRef={(r) => { keyboard.current = r; }}
                input={keyboardInput}
                onChange={handleKeyboardInputChange}
                onKeyPress={handleKeyPress}
                layoutName={layout}
            />
        </BottomModal>
    );
}

export default ConfirmGCashPayment;