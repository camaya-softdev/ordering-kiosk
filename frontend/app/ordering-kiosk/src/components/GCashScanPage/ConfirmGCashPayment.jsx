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
  setCashPaymentDetails,
  setOrderStep,
} from "../../store/order/orderSlice";
import { useCreateTransaction } from "../../services/TransactionService";
import {
  GCASH_PAYMENT,
  CASH_PAYMENT,
} from "../../utils/Constants/PaymentOptions";

function ConfirmPayment({ open, onClose }) {
  const order = useSelector((state) => state.order);
  const dispatch = useDispatch();
  const placeOrderQuery = useCreateTransaction();
  const [fieldErrors, setFieldErrors] = useState({
    phoneNumber: null,
    referenceNumber: null,
    name: null,
  });
  const [paymentDetails, setPaymentDetails] = useState({
    name: "",
    phoneNumber: "",
    referenceNumber: "",
  });

  const handleConfirm = () => {
    if (order.paymentOption === GCASH_PAYMENT) {
      dispatch(setGCashPaymentDetails(paymentDetails));
    } else if (order.paymentOption === CASH_PAYMENT) {
      dispatch(setCashPaymentDetails(paymentDetails));
    }
  };

  const handleSave = async () => {
    try {
      const response = await (await placeOrderQuery).mutateAsync(order);
      console.log(order);
      dispatch(setCreatedTransaction(response.data.transaction));
      order.paymentOption === GCASH_PAYMENT &&
      order.gcashPaymentDetails !== null
        ? dispatch(nextStep())
        : dispatch(setOrderStep(8));
    } catch (error) {
      alert("Cannot create transaction. Please try again.");
    }
  };

  useEffect(() => {
    if (
      (order.paymentOption === GCASH_PAYMENT &&
        order.gcashPaymentDetails !== null) ||
      (order.paymentOption === CASH_PAYMENT &&
        order.cashPaymentDetails !== null)
    ) {
      handleSave();
    }
  }, [
    order.paymentOption,
    order.gcashPaymentDetails,
    order.cashPaymentDetails,
  ]);

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
        {order.paymentOption === GCASH_PAYMENT && (
          <CustomInputField
            label="Enter reference number"
            placeholder="e.g 0123456789"
            value={paymentDetails.referenceNumber}
            onChange={(e) => {
              setPaymentDetails({
                ...paymentDetails,
                referenceNumber: e.target.value,
              });
              validateReferenceNumber(e.target.value);
            }}
            error={fieldErrors.referenceNumber}
          />
        )}

        <CustomInputField
          label="Enter your name"
          placeholder="John Doe"
          value={paymentDetails.name}
          onChange={(e) => {
            setPaymentDetails({
              ...paymentDetails,
              name: e.target.value,
            });
            validateName(e.target.value);
          }}
          error={fieldErrors.name}
        />

        <CustomInputField
          label="Enter your phone number"
          placeholder="0912 345 6789"
          value={paymentDetails.phoneNumber}
          onChange={(e) => {
            setPaymentDetails({
              ...paymentDetails,
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
            (order.paymentOption === GCASH_PAYMENT &&
              fieldErrors.referenceNumber !== null) ||
            !paymentDetails.name ||
            !paymentDetails.phoneNumber ||
            (order.paymentOption === GCASH_PAYMENT &&
              !paymentDetails.referenceNumber) ||
            placeOrderQuery.isLoading
          }
        >
          Confirm
        </Button>
      </div>
    </BottomModal>
  );
}

export default ConfirmPayment;
