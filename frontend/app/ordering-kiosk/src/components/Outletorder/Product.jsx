import React from "react";
import style from "./Product.module.css";

import { useDispatch } from "react-redux";
import { setModalData, setModalState } from "../../store/order/orderSlice";

const Product = () => {
  const dispatch = useDispatch();

  const sectionContent = [
    {
      id: 1,
      name: "Newly added",
      items: [
        {
          id: 1,
          imgurl: "linkurl_dapat_ng_image/new1.png",
          prodName: "Charlie Bravo Quesadilla",
          price: "220.0",
        },
        {
          id: 2,
          imgurl: "linkurl_dapat_ng_image/new2.png",
          prodName: "Tortang itlog",
          price: "250.0",
        },
        {
          id: 3,
          imgurl: "linkurl_dapat_ng_image/new1.png",
          prodName: "Tortang egg",
          price: "300.0",
        },
      ],
    },
    {
      id: 2,
      name: "Burgers",
      items: [
        {
          id: 1,
          imgurl: "linkurl_dapat_ng_image/new1.png",
          prodName: "Burger 1",
          price: "220.0",
        },
        {
          id: 2,
          imgurl: "linkurl_dapat_ng_image/new2.png",
          prodName: "Burger 2",
          price: "250.0",
        },
        {
          id: 3,
          imgurl: "linkurl_dapat_ng_image/new1.png",
          prodName: "Burger 3",
          price: "300.0",
        },
        {
          id: 4,
          imgurl: "linkurl_dapat_ng_image/new1.png",
          prodName: "Burger 2",
          price: "250.0",
        },
        {
          id: 5,
          imgurl: "linkurl_dapat_ng_image/new2.png",
          prodName: "Burger 3",
          price: "300.0",
        },
      ],
    },
  ];

  const orderProduct = (secId, prodId, prodName, prodPrice) => {
    console.log(secId, prodId, prodName, prodPrice);
    dispatch(setModalState({ isOpen: true }));
    dispatch(
      setModalData({
        secId: secId,
        prodId: prodId,
        prodName: prodName,
        prodPrice: prodPrice,
      })
    );
  };

  return (
    <>
      {sectionContent.map((sec) => (
        <div className={style.productCard} key={sec.id}>
          <div className={style.productWrap}>
            <div className={style.productContent}>
              <div className={style.productTitle}>
                <span className={style.spanTitle}>{sec.name}</span>
              </div>
              <div className={style.sectionContent}>
                {sec.items.map((prod) => (
                  <div
                    className={style.productSection}
                    onClick={() =>
                      orderProduct(sec.id, prod.id, prod.prodName, prod.price)
                    }
                    key={prod.id}
                  >
                    <div className={style.productImgwrap}>
                      <img
                        src={prod.imgurl}
                        alt={prod.prodName}
                        className={style.pica}
                      />
                    </div>
                    <div className={style.productDetails}>
                      <div className={style.productNameDiv}>
                        <span className={style.productNameSpan}>
                          {prod.prodName}
                        </span>
                      </div>
                      <span className={style.productPriceSpan}>
                        {prod.price}
                      </span>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      ))}
    </>
  );
};

export default Product;
