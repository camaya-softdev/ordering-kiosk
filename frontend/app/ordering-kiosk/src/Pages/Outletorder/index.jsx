import React, { useState } from "react";
import style from "./Outletorder.module.css";
import Product from "../../components/Outletorder/Product";
import { previousStep, resetOrder } from "../../store/order/orderSlice";
import { useDispatch, useSelector } from "react-redux";
import Modal from "../../components/Outletorder/Modal";

const Outletorder = () => {
  const dispatch = useDispatch();
  const isModalOpen = useSelector((state) => state.order.isModalOpen);
  // const isModalOpen = true;

  return (
    <div className={style.mainContainer}>
      <div className={style.mainWrapper}>
        <div className={style.category}>
          <div className={style.section}>
            <div className={style.outletLogo} />
          </div>
          <div className={style.group}>
            <div className={style.categorySection}>
              <div className={style.categoryMenu}>
                <div className={style.categoryIcon} />
                <div className={style.box}>
                  <span className={style.text}>Newly Added</span>
                </div>
                <div className={style.indicator} />
              </div>
            </div>
          </div>
        </div>
        <div className={style.productList}>
          <Product />
        </div>
      </div>
      <div className={style.footer}>
        <div className={style.leftFooter}>
          <div className={style.backCategoryDiv}>
            <div className={style.btnBackCategory}>
              <span
                className={style.textBtnBack}
                onClick={() => {
                  dispatch(previousStep());
                }}
              >
                Back to category
              </span>
            </div>
          </div>
          <div className={style.rightFooter}>
            <div className={style.startOverBtn}>
              <span
                className={style.startoverSpan}
                onClick={() => {
                  dispatch(resetOrder());
                }}
              >
                Start over
              </span>
            </div>
          </div>
        </div>
        <div className={style.priceContainer}>
          <div className={style.priceGroup}>
            <div className={style.priceWrap}>
              <div className={style.pic11}></div>
            </div>
            <span className={style.priceSpan}>PHP 0.00</span>
          </div>
          <div className={style.viewOrderGroup}>
            <div className={style.viewOrderSection}>
              <div className={style.vieworderBtn}>
                <span className={style.vieworderSpan}>View order</span>
              </div>
            </div>
            <div className={style.checkoutWrap}>
              <div className={style.checkoutBtn}>
                <span className={style.checkoutSpan}>Proceed to checkout</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      {isModalOpen && <Modal />}
    </div>
  );
};

export default Outletorder;
