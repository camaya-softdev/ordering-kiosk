import axios from 'axios';

const API = axios.create({
  baseURL: import.meta.env.VITE_API,
  headers: {
    'Content-Type': 'application/json'
  },
});

API.interceptors.response.use(
  response => response,
  error => {
    return Promise.reject(error);
  }
);

export default API;