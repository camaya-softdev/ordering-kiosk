import { useState } from "react";
import BottomModal from "../Common/BottomModal";
import styles from "./OutletOrder.module.css";
import Button from "../Common/Button";
import StepperInput from "../Common/StepperInput";
import { useDispatch, useSelector } from "react-redux";
import { addSelectedProduct } from "../../store/order/orderSlice";
import { formatNumber } from "../../utils/Common/Price";
import { LazyLoadImage } from "react-lazy-load-image-component";
import noproduct from "../../assets/noprodimage.svg";

function AddProductToOrder({ product, open, onClose }) {
  const [quantity, setQuantity] = useState(0);
  const dispatch = useDispatch();
  const outlet = useSelector((state) => state.order.selectedOutlet);

  const handleQuantityChange = (value) => {
    setQuantity(value);
  };

  const handleAddProduct = () => {
    if (quantity > 0) {
      dispatch(addSelectedProduct({ product, quantity, outlet }));
      handleClose();
    }
  };

  const handleClose = () => {
    setQuantity(0);
    onClose();
  };

  return (
    <BottomModal open={open} onClose={handleClose} addProductOrder={true}>
      <div className={styles.addProductModalBody}>
        <div className={styles.addModalImageWrapper}>
          <LazyLoadImage
            src={
              product.image
                ? `${import.meta.env.VITE_API}/${product.image}`
                : noproduct
            }
            alt="product"
          />
        </div>

        <div className={styles.addModalFields}>
          <div className={styles.addModalProductDetails}>
            <span className={styles.addModalProductName}>{product.name}</span>
            <span className={styles.addModalProductDesc}>
              {product.description ?? ""}
            </span>
            <span className={styles.addModalProductPrice}>
              &#8369;{formatNumber(product.price)}
            </span>
          </div>

          <StepperInput
            min={0}
            max={product.stock}
            onValueChange={handleQuantityChange}
          />

          <div className={styles.addModalButtons}>
            <Button
              type="Red"
              onClick={handleAddProduct}
              disabled={quantity === 0}
            >
              Add to order
            </Button>

            <Button type="white" onClick={handleClose}>
              Cancel
            </Button>
          </div>
        </div>
      </div>
    </BottomModal>
  );
}

export default AddProductToOrder;
