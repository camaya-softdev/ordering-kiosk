// store/order/orderSlice.js
import { createSlice } from '@reduxjs/toolkit';

const orderSlice = createSlice({
  name: 'order',
  initialState: { 
    orderStep: 0,
    selectedOutlet: null,
    selectedCategory: null,
  },
  reducers: {
    nextStep: state => {
      state.orderStep += 1;
    },
    previousStep: state => {
      if (state.orderStep > 0) {
        state.orderStep -= 1;
      }
    },
    resetOrder: state => {
      state.orderStep = 0;
      state.selectedOutlet = null;
      state.selectedCategory = null;
    },
    setSelectedOutlet: (state, action) => {
      state.selectedOutlet = action.payload;
      state.selectedCategory = null;
    },
    setSelectedCategory: (state, action) => {
      state.selectedCategory = action.payload;
    },
  },
});

export const { 
  nextStep, 
  previousStep, 
  resetOrder, 
  setSelectedOutlet,
  setSelectedCategory
} = orderSlice.actions;

export default orderSlice.reducer;
