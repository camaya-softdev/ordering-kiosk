import React from "react";
import style from "./Modal.module.css";
import { useSelector, useDispatch } from "react-redux";
import burger from "../../assets/menuitem/plant-based-1.png";
import { setModalState } from "../../store/order/orderSlice";

const Modal = () => {
  const dispatch = useDispatch();

  // Retrieve product details from Redux store
  const { secId, prodId, prodName, prodPrice } = useSelector(
    (state) => state.order.modalData
  );

  const [quantity, setQuantity] = useState(1);

  // Function to handle adding item to the cart
  const handleAddToCart = () => {
    // Dispatch the addItem action with product details and quantity
    dispatch(addItem({ secId, prodId, prodName, prodPrice, quantity }));
    // Close the modal
    dispatch(setModalState(false));
  };

  return (
    <div className={style.modalBackdrop}>
      <div className={style.modalContent}>
        <div>{secId}</div>
        <div>{prodId}</div>
        <div className={style.leftModal}>
          <img src={burger} alt={prodName} />
        </div>
        <div className={style.rightModal}>
          <div className={style.product_price}>
            <p>{prodName}</p>
            <b>
              P<span>{prodPrice}</span>
            </b>
          </div>
          <div>
            <div>
              <input
                type="number"
                min={1}
                value={quantity}
                onChange={(e) => setQuantity(e.target.value)}
              />
            </div>
            <div onClick={handleAddToCart}>Add to order</div>

            <div onClick={() => dispatch(setModalState(false))}>cancel</div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Modal;
