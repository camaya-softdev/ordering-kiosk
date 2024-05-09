function calculateTotalPrice(selectedProducts) {
    return selectedProducts.reduce((total, product) => {
      return total + product.details.price * product.quantity;
    }, 0);
}

function formatNumber(num) {
  return parseFloat(num).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

export {
    calculateTotalPrice,
    formatNumber
}