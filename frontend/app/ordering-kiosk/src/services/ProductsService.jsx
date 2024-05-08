import API from '../utils/axiosInstance';

export const getProducts = async ({outlet_id = null, include_new_added = 0}) => {
    const params = new URLSearchParams();

    params.append('outlet_id', outlet_id);
    params.append('include_new_added', include_new_added);

    const request = await API.get(`/api/products?${params.toString()}`);
    const response = await request.data;
    return response;
};