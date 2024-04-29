import { createSlice } from '@reduxjs/toolkit';

const orderSlice = createSlice({
  name: 'order',
  initialState: { 
    orderStep: 0 
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
    },
  },
});

export const { nextStep, previousStep, resetOrder } = orderSlice.actions;

export default orderSlice.reducer;