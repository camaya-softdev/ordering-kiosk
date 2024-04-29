import { useState } from "react";
import { useQuery } from "react-query";
import { getOutlets } from "../services/OutletServices";

function useFetchOutlets (initialFilters = {}){

  const [outletFilter, setOuletFilter] = useState(initialFilters);

  const { data: outlets, isLoading: isOutletsLoading, isError: isOutletsError, isSuccess: isOutletsSuccess, refetch: refetchOutlets } = useQuery(
      ['outlets', outletFilter], 
      () => getOutlets(outletFilter) 
  );

  return {
      outlets,
      isOutletsLoading,
      isOutletsError,
      isOutletsSuccess,
      refetchOutlets,
      setOuletFilter
  };

}

export default useFetchOutlets;