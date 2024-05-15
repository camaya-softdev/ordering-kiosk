import { configureStore } from '@reduxjs/toolkit';
import orderReducer from './order/orderSlice';
import userReducer from './user/userSlice';

const store = configureStore({
    reducer: {
        order: orderReducer,
        user: userReducer,
    },
});

export default store;
