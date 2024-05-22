import API from '../utils/axiosInstance';

export const getPaymentMethods = async () => {
    const request = await API.get(`/api/payment-method`);
    const response = await request.data;
    return response;
};