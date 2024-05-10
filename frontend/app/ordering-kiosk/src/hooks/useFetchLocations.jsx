import { useState } from "react";
import { useQuery } from "react-query";
import { getLocations } from "../services/LocationService";

function useFetchLocations (initialFilters = {}){

  const [locationsFilter, setLocationsFilter] = useState(initialFilters);

  const { data: locations, isLoading: isLocationsLoading, isError: isLocationsError, isSuccess: isLocationsSuccess, refetch: refetchLocations} = useQuery(
      ['locations', locationsFilter], 
      () => getLocations(locationsFilter) 
  );

  return {
    locations,
    isLocationsLoading,
    isLocationsError,
    isLocationsSuccess,
    refetchLocations,
    setLocationsFilter,
    locationsFilter
  };

}

export default useFetchLocations;