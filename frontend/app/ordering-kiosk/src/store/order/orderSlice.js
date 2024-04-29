import { createSlice } from '@reduxjs/toolkit';

const orderSlice = createSlice({
  name: 'order',
  initialState: { 
    orderStep: 0,
    selectedOutletId: null,
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
    setSelectedOutletId: (state, action) => {
      state.selectedOutletId = action.payload;
    },
  },
});

export const { 
  nextStep, 
  previousStep, 
  resetOrder, 
  setSelectedOutletId 
} = orderSlice.actions;

export default orderSlice.reducer;