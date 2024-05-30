import API from '../utils/axiosInstance';

export const getLocations = async ({outlet_id = null}) => {
    const params = new URLSearchParams();

    if(outlet_id){
        params.append('outlet_id', outlet_id);
    }
    const request = await API.get(`/api/locations?${params.toString()}`);
    const response = await request.data;
    return response;
};

export const getAreas = async ({location_id = null}) => {
    const params = new URLSearchParams();

    if(location_id){
        params.append('location_id', location_id);
    }

    const request = await API.get(`/api/location-numbers?${params.toString()}`);
    const response = await request.data;
    return response;
};