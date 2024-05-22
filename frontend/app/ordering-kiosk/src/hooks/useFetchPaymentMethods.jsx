import { useState } from "react";
import { useQuery } from "react-query";
import { getPaymentMethods } from "../services/PaymentMethodService";

function useFetchPaymentMethods (initialFilters = {}){

  const [paymentMethodFilters, setPaymentMethodFilters] = useState(initialFilters);

  const { data: paymentMethods, isLoading: isPaymentMethodsLoading, isError: isPaymentMethodsError, isSuccess: isPaymentMethodsSuccess, refetch: refetchPaymentMethods} = useQuery(
      ['payment_methods', paymentMethodFilters], 
      () => getPaymentMethods(paymentMethodFilters) 
  );

  return {
    paymentMethods,
    isPaymentMethodsLoading,
    isPaymentMethodsError,
    isPaymentMethodsSuccess,
    refetchPaymentMethods,
    setPaymentMethodFilters,
    paymentMethodFilters
  };

}

export default useFetchPaymentMethods;