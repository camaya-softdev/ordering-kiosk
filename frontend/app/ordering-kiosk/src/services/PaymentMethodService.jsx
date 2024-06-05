import API from '../utils/axiosInstance';

export const getPaymentMethods = async () => {
    const request = await API.get(`/api/payment-method`);
    const response = await request.data;
    return response;
};

export const getGCashDetails = async ({outlet_id = null}) => {
    const params = new URLSearchParams();

    if(outlet_id){
        params.append('outlet_id', outlet_id);
    }
    const request = await API.get(`/api/gcash-details?${params.toString()}`);
    const response = await request.data;
    return response;
}