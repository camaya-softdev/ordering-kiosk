import axios from 'axios';
import Cookies from 'js-cookie';

export const checkCookieValidity = async () => {
  try {
    const user = JSON.parse(Cookies.get('user'));
    if (user && user.access_token) {
      const response = await axios.get(import.meta.env.VITE_API + 'api/auth-test', {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${user.access_token}`
        }
      });

      if (response.status !== 200) {
        Cookies.remove('user');
      }
    }
  } catch (error) {
    Cookies.remove('user');
  }
};
