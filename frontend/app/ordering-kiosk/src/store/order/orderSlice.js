// store/order/orderSlice.js
import { createSlice } from '@reduxjs/toolkit';

const orderSlice = createSlice({
  name: 'order',
  initialState: { 
    orderStep: 0,
    selectedOutletId: null,
    isModalOpen: false,
    modalData: {
      secId: null,
      prodId: null,
      prodName: '',
      prodPrice: '',
    },
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
    setModalState: (state, action) => {
      state.isModalOpen = action.payload;
    },
    setModalData: (state, action) => {
      state.modalData = action.payload;
    },
  },
});

export const { 
  nextStep, 
  previousStep, 
  resetOrder, 
  setSelectedOutletId,
  setModalState,
  setModalData,
} = orderSlice.actions;

export default orderSlice.reducer;
