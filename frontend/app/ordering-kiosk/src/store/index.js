import { configureStore } from '@reduxjs/toolkit';
import orderReducer from './order/orderSlice';
import authReducer from './auth/authSlice';

const store = configureStore({
    reducer: {
        order: orderReducer,
        auth: authReducer
    },
});

export default store;
