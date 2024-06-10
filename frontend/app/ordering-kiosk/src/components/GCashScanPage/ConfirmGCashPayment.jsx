import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import CustomInputField from "./CustomField";
import styles from "./GCashScanPage.module.css";
import { useDispatch, useSelector } from "react-redux";
import { useEffect, useState } from "react";
import {
  nextStep,
  setCreatedTransaction,
  setGCashPaymentDetails,
} from "../../store/order/orderSlice";
import { useCreateTransaction } from "../../services/TransactionService";
import { GCASH_PAYMENT } from "../../utils/Constants/PaymentOptions";

function ConfirmGCashPayment({ open, onClose }) {
  const order = useSelector((state) => state.order);
  const dispatch = useDispatch();
  const placeOrderQuery = useCreateTransaction();
  const [fieldErrors, setFieldErrors] = useState({
    phoneNumber: null,
    referenceNumber: null,
    name: null,
  });
  const [gcashPaymentDetails, setGcashPaymentDetails] = useState({
    name: "",
    phoneNumber: "",
    referenceNumber: "",
  });

  const handleConfirm = () => {
    dispatch(setGCashPaymentDetails(gcashPaymentDetails));
  };

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
    if (
      order.paymentOption === GCASH_PAYMENT &&
      order.gcashPaymentDetails !== null
    ) {
      handleSave();
    }
  }, [order.paymentOption, order.gcashPaymentDetails]);

  const validatePhoneNumber = (phoneNumber) => {
    const phoneNumberPattern = /^(\+63|0)\d{10}$/;
    const isValid = phoneNumberPattern.test(phoneNumber);
    setFieldErrors({
      ...fieldErrors,
      phoneNumber: isValid ? null : "Invalid phone number",
    });
  };

  const validateReferenceNumber = (referenceNumber) => {
    const isValidReferenceNumber = /^\d{13}$/.test(referenceNumber);
    setFieldErrors({
      ...fieldErrors,
      referenceNumber: isValidReferenceNumber
        ? null
        : "Reference number should contain 13 digits",
    });
  };

  const validateName = (name) => {
    const isValidName = /^[A-Za-z\s]+$/.test(name);
    setFieldErrors({
      ...fieldErrors,
      name: isValidName ? null : "Name should contain alphabets only",
    });
  };

  return (
    <BottomModal open={open} onClose={onClose}>
      <div className={styles.modalFields}>
        <CustomInputField
          label="Enter reference number"
          placeholder="e.g 0123456789"
          value={gcashPaymentDetails.referenceNumber}
          onChange={(e) => {
            setGcashPaymentDetails({
              ...gcashPaymentDetails,
              referenceNumber: e.target.value,
            });
            validateReferenceNumber(e.target.value);
          }}
          error={fieldErrors.referenceNumber}
        />

        <CustomInputField
          label="Enter your name"
          placeholder="John Doe"
          value={gcashPaymentDetails.name}
          onChange={(e) => {
            setGcashPaymentDetails({
              ...gcashPaymentDetails,
              name: e.target.value,
            });
            validateName(e.target.value);
          }}
          error={fieldErrors.name}
        />

        <CustomInputField
          label="Enter your phone number"
          placeholder="0912 345 6789"
          value={gcashPaymentDetails.phoneNumber}
          onChange={(e) => {
            setGcashPaymentDetails({
              ...gcashPaymentDetails,
              phoneNumber: e.target.value,
            });
            validatePhoneNumber(e.target.value);
          }}
          error={fieldErrors.phoneNumber}
        />
      </div>

      <div className={styles.modalButtons}>
        <Button type="white" onClick={onClose}>
          Back
        </Button>

        <Button
          type="Red"
          onClick={handleConfirm}
          loading={placeOrderQuery.isLoading}
          disabled={
            fieldErrors.phoneNumber !== null ||
            fieldErrors.name !== null ||
            fieldErrors.referenceNumber !== null ||
            !gcashPaymentDetails.name ||
            !gcashPaymentDetails.phoneNumber ||
            !gcashPaymentDetails.referenceNumber ||
            placeOrderQuery.isLoading
          }
        >
          Confirm
        </Button>
      </div>
    </BottomModal>
  );
}

export default ConfirmGCashPayment;
