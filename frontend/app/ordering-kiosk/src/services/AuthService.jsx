import axios from 'axios';
import { useMutation } from "react-query";
import Cookies from 'js-cookie';

export const useLogin = () => {
    return useMutation(async formData => {
        const response = await axios.post(import.meta.env.VITE_API + 'api/login', formData, {
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (response.status === 200) {
            Cookies.set('user', JSON.stringify(response.data), { expires: 10000 } );
        }

        return response;
    });
}