import { useMutation } from "react-query";
import API from '../utils/axiosInstance';

export const useCreateTransaction = async () => {
    return useMutation(async formData => {
        return await API.post('/api/create-transactions', formData);
    });
}