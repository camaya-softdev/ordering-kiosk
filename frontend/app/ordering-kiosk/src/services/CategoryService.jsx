import API from '../utils/axiosInstance';

export const getCategories = async ({outlet_id = null}) => {
    const params = new URLSearchParams();

    params.append('outlet_id', outlet_id);
    const request = await API.get(`/api/categories?${params.toString()}`);
    const response = await request.data;
    return response;
};