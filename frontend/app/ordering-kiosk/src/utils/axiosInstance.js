import axios from 'axios';
import Cookies from 'js-cookie';

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
    return Promise.reject(error);
  }
);

export default API;