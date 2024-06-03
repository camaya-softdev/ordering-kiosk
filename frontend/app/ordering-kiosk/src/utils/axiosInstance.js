import axios from 'axios';
import Cookies from 'js-cookie';
import { useDispatch } from 'react-redux';
import { setAuth } from '../store/auth/authSlice';

const API = axios.create({
  baseURL: import.meta.env.VITE_API,
  headers: {
    'Content-Type': 'application/json'
  },
  withCredentials: true,
});

API.interceptors.request.use((config) => {
  const user = JSON.parse(Cookies.get('user'));

  if (user && user.access_token) {
    config.headers.Authorization = `Bearer ${user.access_token}`;
  }

  return config;
});

API.interceptors.response.use(
  response => response,
  error => {
    if (error.response && error.response.status === 401) {
      Cookies.remove('user');
      const dispatch = useDispatch();
      dispatch(setAuth(null)); 
    }
    return Promise.reject(error);
  }
);

export default API;