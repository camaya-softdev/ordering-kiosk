import { useDispatch } from "react-redux";
import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import { resetOrder } from "../../store/order/orderSlice";

function StartOverConfirmation({ open, onClose }) {
  const dispatch = useDispatch();

  const handleStartOver = () => {
    dispatch(resetOrder());
    onClose();
  };

  return (
    <BottomModal
      open={open}
      onClose={onClose}
      title="Are you sure you want to start over?"
      subtitle="Your progress will not be saved."
      extras={
        <div
          style={{
            display: "flex",
            justifyContent: "space-between",
            width: "100%",
            gap: "40px",
            margin: "40px",
          }}
        >
          <Button type="white" onClick={onClose}>
            Cancel
          </Button>

          <Button type="Red" onClick={handleStartOver}>
            Confirm
          </Button>
        </div>
      }
    />
  );
}

export default StartOverConfirmation;
