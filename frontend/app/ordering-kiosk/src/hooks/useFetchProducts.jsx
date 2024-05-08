import { useState } from "react";
import { useQuery } from "react-query";
import { getProducts } from "../services/ProductsService";

function useFetchProducts (initialFilters = {
    outlet_id: null,
    include_new_added: 0
}){

  const [productsFilter, setProductsFilter] = useState(initialFilters);

  const { data: products, isLoading: isProductsLoading, isError: isProductsError, isSuccess: isProductsSuccess, refetch: refetchProducts} = useQuery(
      ['products', productsFilter], 
      () => getProducts(productsFilter) 
  );

  return {
        products,
        isProductsLoading,
        isProductsError,
        isProductsSuccess,
        refetchProducts,
        setProductsFilter,
        productsFilter
  };

}

export default useFetchProducts;