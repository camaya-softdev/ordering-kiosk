import { useState } from "react";
import styles from "./OutletOrder.module.css";
import AddProductToOrder from "./AddProductToOrder";
import { formatNumber } from "../../utils/Common/Price";
import { LazyLoadImage } from "react-lazy-load-image-component";
import noproduct from "../../assets/noprodimage.svg";

function ProductCard({ product }) {
  const [addProduct, setAddProduct] = useState(false);

  console.log(product);
  const selectProduct = () => {
    if (product.status && product.stock > 0) {
      setAddProduct(true);
    }
  };

  return (
    <>
      <div
        className={`${styles.productCard} ${product.status ? "" : "disabled"} ${
          product.stock <= 0 ? "hidden" : ""
        }`}
        onClick={selectProduct}
      >
        <div className={styles.productImageWrapper}>
          <LazyLoadImage
            src={
              product.image
                ? `${import.meta.env.VITE_API}/${product.image}`
                : noproduct
            }
            alt="product"
            className={styles.productImage}
          />
        </div>

        <div className={styles.productDetails}>
          <p className={styles.name}>
            <span className={styles.nameText}>{product.name}</span>
          </p>
          <span className={styles.price}>
            &#8369;{formatNumber(product.price)}
          </span>
        </div>
      </div>

      <AddProductToOrder
        product={product}
        open={addProduct}
        onClose={() => setAddProduct(false)}
      />
    </>
  );
}

export default ProductCard;
