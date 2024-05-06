import { configureStore } from '@reduxjs/toolkit';
import orderReducer from './order/orderSlice';
import cartReducer from './cart/cartSlice';

const store = configureStore({
    reducer: {
        order: orderReducer,
        cart: cartReducer,
    },
});

export default store;
