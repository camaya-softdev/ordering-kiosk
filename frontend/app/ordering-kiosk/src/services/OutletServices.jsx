import API from '../utils/axiosInstance';

export const getOutlets = async () => {
    const request = await API.get(`/api/outlets`);
    const response = await request.data;
    return response;
};