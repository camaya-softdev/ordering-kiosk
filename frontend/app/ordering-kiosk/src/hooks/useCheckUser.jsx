import { useEffect } from 'react';
import { useDispatch } from 'react-redux';
import Cookies from 'js-cookie';
import { setUser } from '../store/user/userSlice';

export const useCheckUser = () => {
    const dispatch = useDispatch();

    useEffect(() => {
        const userCookie = Cookies.get('user');
        if (userCookie) {
            try {
                const user = JSON.parse(userCookie);
                dispatch(setUser(user));
            } catch (error) {
                console.error('Error parsing user cookie:', error);
            }
        }
    }, [dispatch]);
}