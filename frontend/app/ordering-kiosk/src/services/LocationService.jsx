import API from '../utils/axiosInstance';

export const getLocations = async () => {
    const request = await API.get(`/api/locations`);
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