import API from '../utils/axiosInstance';

export const getOutlets = async ({id = null}) => {
    const params = new URLSearchParams();

    if(id){
        params.append('id', id);
    }

    const request = await API.get(`/api/outlets?${params.toString()}`);
    const response = await request.data;
    return response;
};