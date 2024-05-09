import { useState } from "react";
import styles from "./OutletOrder.module.css";
import AddProductToOrder from "./AddProductToOrder";
import { formatNumber } from "../../utils/Common/Price";

function ProductCard({ product }){
    const [addProduct, setAddProduct] = useState(false);

    const selectProduct = () => {
        if(product.status){
            setAddProduct(true);
        }
        
    }

    
    return (
        <>
            <div 
                className={`${styles.productCard} ${product.status ? '' : 'disabled'}`}
                onClick={selectProduct}
            >
                <div className={styles.productImageWrapper}>
                    <img src={`${import.meta.env.VITE_API}/${product.image}`} alt="product" className={styles.productImage}/>
                </div>

                <div className={styles.productDetails}>
                    <p className={styles.name}>
                        <span className={styles.nameText}>{product.name}</span>
                    </p>
                    <span className={styles.price}>&#8369;{formatNumber(product.price)}</span>
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