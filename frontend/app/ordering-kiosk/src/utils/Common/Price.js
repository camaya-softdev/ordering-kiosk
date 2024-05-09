function calculateTotalPrice(selectedProducts) {
    return selectedProducts.reduce((total, product) => {
      return total + product.details.price * product.quantity;
    }, 0);
}

export {
    calculateTotalPrice
}