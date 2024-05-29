import axios from 'axios';
import Cookies from 'js-cookie';
import { setAuth } from '../../store/auth/authSlice';

export const checkCookieValidity = async (dispatch) => {
  try {
    const user = JSON.parse(Cookies.get('user'));
    if (user && user.access_token) {
      const response = await axios.get(import.meta.env.VITE_API + 'api/auth-test', {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${user.access_token}`
        }
      });
      dispatch(setAuth(user));

      if (response.status !== 200) {
        Cookies.remove('user');
        dispatch(setAuth(null));
      }
    }
  } catch (error) {
    Cookies.remove('user');
    dispatch(setAuth(null));
  }
};