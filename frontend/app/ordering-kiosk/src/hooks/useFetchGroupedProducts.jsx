import { useEffect, useState } from "react";
import useFetchProducts from "./useFetchProducts";

function useGroupedProducts(params) {
    const { products, isProductsLoading } = useFetchProducts(params);
    const [groupedProducts, setGroupedProducts] = useState([]);

    useEffect(() => {
        if (products && products.data) {
            const grouped = products.data.reduce((acc, product) => {
                const key = product.category.name;
                if (!acc[key]) {
                    acc[key] = [];
                }
                acc[key].push(product);
                return acc;
            }, {});
            setGroupedProducts(grouped);
        }
    }, [products]);

    return { groupedProducts, isProductsLoading };
}

export default useGroupedProducts;