import styles from "./OutletOrder.module.css";

function ProductCard({ product }){

    const selectProduct = () => {
        if(product.status){
            alert('Product selected');
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
                    <span className={styles.price}>{product.price}</span>
                </div>
            </div>
        </>
    );
}

export default ProductCard;