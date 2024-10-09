import { useSelector } from "react-redux";
import BottomModal from "../Common/BottomModal";
import styles from "./OutletOrder.module.css";
import StepperInput from "../Common/StepperInput";
import { useDispatch } from "react-redux";
import {
  increaseProductQuantity,
  decreaseProductQuantity,
  nextStep,
  setClassAnimate,
  setSpecialInstructions,
} from "../../store/order/orderSlice";
import { useState } from "react";
import RemoveProductConfirmation from "./RemoveProductConfirmation";
import SummaryFooter from "./SummaryFooter";
import { formatNumber } from "../../utils/Common/Price";
import { LazyLoadImage } from "react-lazy-load-image-component";
import noproduct from "../../assets/noprodimage.svg";

function ViewOrder({ open, onClose }) {
  const selectedProducts = useSelector((state) => state.order.selectedProducts);
  const dispatch = useDispatch();
  const [openModal, setOpenModal] = useState({ removeProduct: null });
  const [specialInstruction, setSpecialInstruction] = useState(null);

  const handleChangeSpecialInstruction = (event) => {
    setSpecialInstruction(event.target.value);
    dispatch(setSpecialInstructions(event.target.value));
  };

  const proceedToCheckout = () => {
    dispatch(nextStep());
    dispatch(setClassAnimate("backwardAnimation"));
  };

  return (
    <>
      <BottomModal
        open={open}
        onClose={onClose}
        title="Your order"
        showTitleDivider={true}
        fullViewModal={true}
      >
        {/* <div className={styles.orderWrapperDetails}>
          <div className={styles.viewOrderDetails}>
            {selectedProducts.map((product, index) => (
              <div key={product.details.id} className={styles.viewOrderItem}>
                <span>{index + 1}.</span>

                <div className={styles.viewOrderItemDetails}>
                  <div className={styles.viewOrderImage}>
                    <LazyLoadImage
                      src={
                        product.details.image
                          ? `${import.meta.env.VITE_API}/${
                              product.details.image
                            }`
                          : noproduct
                      }
                      alt={product.details.name}
                    />
                  </div>

                  <div className={styles.viewOrderItemInfo}>
                    <span>{product.details.name}</span>
                    <span>&#8369;{formatNumber(product.details.price)}</span>
                  </div>
                </div>

                <div className={styles.viewOrderItemQuantity}>
                  <div>
                    <StepperInput
                      size="small"
                      initialValue={product.quantity}
                      min={0}
                      max={product.details.stock}
                      onValueChange={(newValue) => {
                        if (newValue > product.quantity) {
                          dispatch(
                            increaseProductQuantity({
                              product: product.details,
                            })
                          );
                        } else if (newValue < product.quantity) {
                          if (newValue === 0) {
                            setOpenModal((prev) => ({
                              ...prev,
                              removeProduct: product.details,
                            }));
                          } else {
                            dispatch(
                              decreaseProductQuantity({
                                product: product.details,
                              })
                            );
                          }
                        }
                      }}
                    />

                    <span>&#8369;{formatNumber(product.details.price)}</span>
                  </div>
                </div>
              </div>
            ))}
            <p>asdfkjdsakjfdsalkjfdsalkjfdsalkj</p>
          </div>
          <div></div>
        </div> */}
        <div className="w-full flex flex-col justify-between h-[1435px] max-h-[1435px] overflow-y-auto">
          <div className={styles.viewOrderDetails}>
            {selectedProducts.map((product, index) => (
              <div key={product.details.id} className={styles.viewOrderItem}>
                <span>{index + 1}.</span>

                <div className={styles.viewOrderItemDetails}>
                  <div className={styles.viewOrderImage}>
                    <LazyLoadImage
                      src={
                        product.details.image
                          ? `${import.meta.env.VITE_API}/${
                              product.details.image
                            }`
                          : noproduct
                      }
                      alt={product.details.name}
                    />
                  </div>

                  <div className={styles.viewOrderItemInfo}>
                    <span>{product.details.name}</span>
                    <span>&#8369;{formatNumber(product.details.price)}</span>
                  </div>
                </div>

                <div className={styles.viewOrderItemQuantity}>
                  <div>
                    <StepperInput
                      size="small"
                      initialValue={product.quantity}
                      min={0}
                      max={product.details.stock}
                      onValueChange={(newValue) => {
                        if (newValue > product.quantity) {
                          dispatch(
                            increaseProductQuantity({
                              product: product.details,
                            })
                          );
                        } else if (newValue < product.quantity) {
                          if (newValue === 0) {
                            setOpenModal((prev) => ({
                              ...prev,
                              removeProduct: product.details,
                            }));
                          } else {
                            dispatch(
                              decreaseProductQuantity({
                                product: product.details,
                              })
                            );
                          }
                        }
                      }}
                    />

                    <span>&#8369;{formatNumber(product.details.price)}</span>
                  </div>
                </div>
              </div>
            ))}
          </div>
          <div className="w-full px-[40px] space-y-[16px]">
            <p className="font-semibold text-[36px]">Special instructions</p>
            <textarea
              onChange={handleChangeSpecialInstruction}
              value={specialInstruction}
              placeholder="Add 2 extra ketchup packets"
              className="w-full bg-gray-200 rounded-lg px-[20px] py-[10px] text-[32px] h-[180px] max-h-[180px] min-h-[180px] focus:outline-none resize-none"
            ></textarea>
          </div>
        </div>
        {selectedProducts.length > 0 ? (
          <SummaryFooter
            continueToOrderOnClick={onClose}
            selectDineOptionOnClick={proceedToCheckout}
            showContinueToOrder={true}
            showSelectDineOption={true}
            footerFullModal={true}
          />
        ) : null}
      </BottomModal>
      <RemoveProductConfirmation
        open={openModal.removeProduct !== null}
        onClose={() => {
          setOpenModal((prev) => ({ ...prev, removeProduct: null }));
        }}
        product={openModal.removeProduct}
        viewOrderOnClose={onClose}
      />
    </>
  );
}

export default ViewOrder;
