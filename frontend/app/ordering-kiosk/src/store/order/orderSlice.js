// store/order/orderSlice.js
import { createSlice } from '@reduxjs/toolkit';

const orderSlice = createSlice({
  name: 'order',
  initialState: { 
    orderStep: 0,
    selectedOutlet: null,
    selectedCategory: null,
    classAnimate: null,
    lastWidth: 0,
    selectedProducts: [],
    diningOption: null,
    location: null,
    area: null,
    paymentOption: null,
    gcashPaymentDetails: null,
    createdTransaction: null
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
    setClassAnimate: (state, action) => {
      state.classAnimate = action.payload;
    },
    setLastWidth: (state, action) => {
      state.lastWidth = action.payload;
    },
    resetOrder: state => {
      state.orderStep = 0;
      state.classAnimate = null;
      state.lastWidth = 0;
      state.selectedOutlet = null;
      state.selectedCategory = null;
      state.selectedProducts = [];
      state.diningOption = null;
      state.location = null;
      state.area = null;
      state.paymentOption = null;
      state.gcashPaymentDetails = null;
      state.createdTransaction = null;
    },
    setOrderStep: (state, action) => {
      state.orderStep = action.payload;
    },
    setSelectedOutlet: (state, action) => {
      state.selectedOutlet = action.payload;
      state.selectedCategory = null;
      if(state.selectedOutlet.id !== action.payload.id){
        state.selectedProducts = [];
      }
    },
    setSelectedCategory: (state, action) => {
      state.selectedCategory = action.payload;
    },
    addSelectedProduct: (state, action) => {
      const productIndex = state.selectedProducts.findIndex(
        product => product.details.id === action.payload.product.id
      );
    
      if (productIndex !== -1) {
        // Product found, update quantity
        state.selectedProducts[productIndex].quantity += action.payload.quantity;
      } else {
        // Product not found, add to array
        state.selectedProducts.push({
          details: action.payload.product,
          quantity: action.payload.quantity
        });
      }
    },
    increaseProductQuantity: (state, action) => {
      const productIndex = state.selectedProducts.findIndex(
        product => product.details.id === action.payload.product.id
      );
      if (productIndex !== -1) {
        state.selectedProducts[productIndex].quantity += 1;
      }
    },
    decreaseProductQuantity: (state, action) => {
      const productIndex = state.selectedProducts.findIndex(
        product => product.details.id === action.payload.product.id
      );
      if (productIndex !== -1) {
        if (state.selectedProducts[productIndex].quantity > 1) {
          state.selectedProducts[productIndex].quantity -= 1;
        } else {
          state.selectedProducts.splice(productIndex, 1);
        }
      }
    },
    removeProduct: (state, action) => {
      if (!action.payload.product) {
        return;
      }
    
      const productIndex = state.selectedProducts.findIndex(
        product => product.details.id === action.payload.product.id
      );
    
      if (productIndex !== -1) {
        state.selectedProducts.splice(productIndex, 1);
      }
    },
    setDiningOption: (state, action) => {
      state.diningOption = action.payload;
    },
    setLocation: (state, action) => {
      state.location = action.payload;
    },
    setArea: (state, action) => {
      state.area = action.payload;
    },
    setPaymentOption: (state, action) => {
      state.paymentOption = action.payload;
    },
    setGCashPaymentDetails: (state, action) => {
      state.gcashPaymentDetails = action.payload
    },
    setCreatedTransaction: (state, action) => {
      state.createdTransaction = action.payload;
    }
  },
});

export const {
  nextStep, 
  previousStep, 
  setLastWidth,
  setClassAnimate,
  resetOrder, 
  setOrderStep,
  setSelectedOutlet,
  setSelectedCategory,
  addSelectedProduct,
  increaseProductQuantity,
  decreaseProductQuantity,
  removeProduct,
  setDiningOption,
  setLocation,
  setArea,
  setPaymentOption,
  setGCashPaymentDetails,
  setCreatedTransaction
} = orderSlice.actions;

export default orderSlice.reducer;
