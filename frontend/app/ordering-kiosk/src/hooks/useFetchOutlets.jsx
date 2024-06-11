import { useEffect, useState } from "react";
import { useQuery } from "react-query";
import { getOutlets } from "../services/OutletServices";

function useFetchOutlets (initialFilters = {id: null}){

  const [outletFilter, setOuletFilter] = useState(initialFilters);

  const { data: outlets, isLoading: isOutletsLoading, isError: isOutletsError, isSuccess: isOutletsSuccess, refetch: refetchOutlets } = useQuery(
      ['outlets', outletFilter], 
      () => getOutlets(outletFilter) 
  );

  useEffect(() => {
    refetchOutlets();
  }, [outletFilter, refetchOutlets]);

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