import { useDispatch, useSelector } from "react-redux";
import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import { removeProduct } from "../../store/order/orderSlice";
import { useState } from "react";

function RemoveProductConfirmation({
  open,
  onClose,
  product,
  viewOrderOnClose,
}) {
  const dispatch = useDispatch();
  const [confirmModal, setConfirmModal] = useState(false);
  const selectedProducts = useSelector((state) => state.order.selectedProducts);

  const handleRemoveProduct = () => {
    dispatch(removeProduct({ product: product }));
    setConfirmModal(true);
    onClose();
  };

  const closeRemoveDone = () => {
    if (selectedProducts.length === 0) {
      viewOrderOnClose();
    }
    setConfirmModal(false);
  };

  return (
    <>
      <BottomModal
        open={open}
        onClose={onClose}
        title="Are you sure you want to remove order?"
        subtitle="This cannot be undone."
        extras={
          <>
            <Button
              type="white"
              onClick={onClose}
              style={{ margin: "40px 0 40px 40px" }}
            >
              Cancel
            </Button>

            <Button
              type="Red"
              onClick={handleRemoveProduct}
              style={{ margin: "40px 40px 40px 0" }}
            >
              Confirm
            </Button>
          </>
        }
      />

      <BottomModal
        open={confirmModal}
        onClose={closeRemoveDone}
        title="Order removed."
        extras={
          <Button
            type="Red"
            onClick={closeRemoveDone}
            style={{ margin: "40px" }}
          >
            Close
          </Button>
        }
      />
    </>
  );
}

export default RemoveProductConfirmation;
