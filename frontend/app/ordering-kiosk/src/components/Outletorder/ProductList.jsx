import styles from "./ProductList.module.css";
import { useSelector } from "react-redux";
import BeatLoader from "react-spinners/BeatLoader";
import useGroupedProducts from "../../hooks/useFetchGroupedProducts";
import { useLayoutEffect, useRef } from "react";

function ProductCard({ product }) {
    return (
        <div className={`${styles.productCard} ${product.status ? '' : 'disabled'}`}>
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
    const selectedCategory = useSelector(state => state.order.selectedCategory);
    const {groupedProducts, isProductsLoading} = useGroupedProducts({outlet_id: selectedOutletId, include_new_added: 1});

    const categoryRefs = useRef({});

    // scroll to the category when selected
    useLayoutEffect(() => {
        if (selectedCategory && categoryRefs.current[selectedCategory.name]) {
            categoryRefs.current[selectedCategory.name].scrollIntoView({ behavior: 'smooth' });
        }
    }, [selectedCategory]);

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
                    .sort(([a], [b]) => {
                        if (a === "Newly Added") return -1;
                        if (b === "Newly Added") return 1;
                        return a.localeCompare(b);
                    })
                    .map(([category, products], index) => (
                        <div  
                            ref={el => categoryRefs.current[category] = el}
                            className={`${styles.byCategoryWrapper} ${index === 0 ? styles.first : ''}`}
                        >
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