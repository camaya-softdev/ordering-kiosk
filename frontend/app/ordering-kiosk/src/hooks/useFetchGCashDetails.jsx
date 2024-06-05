import { useEffect, useState } from "react";
import { useQuery } from "react-query";
import { getGCashDetails } from "../services/PaymentMethodService";

function useFetchGCashDetails (initialFilters = {outlet_id: null}){

  const [gcashFilters, setGcashFilter] = useState(initialFilters);

  const { data: gcashDetails, isLoading: isGcashDetailsLoading, isError: isGcashDetailsError, isSuccess: isGcashDetailsSuccess, refetch: refetchGcashDetails} = useQuery(
      ['gcash_details', gcashFilters], 
      () => getGCashDetails(gcashFilters) 
  );

  useEffect(() => {
    refetchGcashDetails();
  }, [gcashFilters, refetchGcashDetails]);

  return {
    gcashDetails,
    isGcashDetailsLoading,
    isGcashDetailsError,
    isGcashDetailsSuccess,
    refetchGcashDetails,
    setGcashFilter,
    gcashFilters
  };

}

export default useFetchGCashDetails;