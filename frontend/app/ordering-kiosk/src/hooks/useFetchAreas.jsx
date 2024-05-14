import { useState } from "react";
import { useQuery } from "react-query";
import { getAreas } from "../services/LocationService";

function useFetchAreas (initialFilters = {
    location_id: null
}){

  const [areasFilter, setAreasFilter] = useState(initialFilters);

  const { data: areas, isLoading: isAreasLoading, isError: isAreasError, isSuccess: isAreasSuccess, refetch: refetchAreas} = useQuery(
      ['areas', areasFilter], 
      () => getAreas(areasFilter) 
  );

  return {
        areas,
        isAreasLoading,
        isAreasError,
        isAreasSuccess,
        refetchAreas,
        setAreasFilter,
        areasFilter
  };

}

export default useFetchAreas;