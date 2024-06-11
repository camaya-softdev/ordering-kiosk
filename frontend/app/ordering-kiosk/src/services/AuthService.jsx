import axios from 'axios';
import { useMutation } from "react-query";
import Cookies from 'js-cookie';
import { useDispatch } from 'react-redux';
import { setAuth } from '../store/auth/authSlice';

export const useLogin = () => {
    const dispatch = useDispatch();

    return useMutation(async formData => {
        const response = await axios.post(import.meta.env.VITE_API + 'api/login', formData, {
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (response.status === 200) {
            Cookies.set('user', JSON.stringify(response.data) );
            dispatch(setAuth(response.data));
        }

        return response;
    });
}