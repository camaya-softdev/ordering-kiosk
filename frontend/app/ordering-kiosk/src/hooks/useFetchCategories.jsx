import { useState } from "react";
import { useQuery } from "react-query";
import { getCategories } from "../services/CategoryService";

function useFetchCategories (initialFilters = {
    outlet_id: null,
    include_new_added: 1
}){

  const [categoriesFilter, setCategoriesFilter] = useState(initialFilters);

  const { data: categories, isLoading: isCategoriesLoading, isError: isCategoriesError, isSuccess: isCategoriesSuccess, refetch: refetchCategories} = useQuery(
      ['categories', categoriesFilter], 
      () => getCategories(categoriesFilter) 
  );

  return {
        categories,
        isCategoriesLoading,
        isCategoriesError,
        isCategoriesSuccess,
        refetchCategories,
        setCategoriesFilter,
        categoriesFilter
  };

}

export default useFetchCategories;