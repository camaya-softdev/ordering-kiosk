import styles from "./ProductList.module.css";
import { useSelector } from "react-redux";
import BeatLoader from "react-spinners/BeatLoader";
import useGroupedProducts from "../../hooks/useFetchGroupedProducts";

function ProductCard({ product }) {
    return (
        <div className={styles.productCard}>
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
    );
}

function ProductList(){
    const selectedOutletId = useSelector(state => state.order.selectedOutlet.id);
    const {groupedProducts, isProductsLoading} = useGroupedProducts({outlet_id: selectedOutletId, include_new_added: 1});

    return(
        <div className={styles.container}>
            {
                isProductsLoading ? 
                <div className={styles.loadingIcon}>
                    <BeatLoader
                        color="#FD3C00"
                        size={35}
                        speedMultiplier={0.5}
                    />
                </div>
                :
                Object.entries(groupedProducts)
                    .sort(([a], [b]) => b === "Newly Added" ? 1 : -1)
                    .map(([category, products], index) => (
                        <div  className={`${styles.byCategoryWrapper} ${index === 0 ? styles.first : ''}`}>
                            <div className={styles.titleWrapper}>
                                <p className={styles.titleText}>{category}</p>
                            </div>

                            <div className={styles.productCards}>
                                {products.map(product => <ProductCard product={product} />)}
                            </div>
                        </div>
                    ))
            }
        </div>
    );
}

export default ProductList;