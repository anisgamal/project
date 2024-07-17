// script.js

// Function to add an item to the cart
function addToCart(productId) {
    // Normally, you would send a request to your backend to add the product to the cart
    // For demonstration purposes, we'll just log the productId to the console
    console.log(`Product added to cart: ${productId}`);

    // You can optionally update the UI to reflect the addition (e.g., show a message)
}

// Function to handle checkout
function checkout() {
    // Here, you would typically send the entire cart data to your backend
    // For demonstration, we'll just log a message indicating checkout
    console.log('Checkout initiated');

    // Optionally, you can redirect the user to a checkout page or perform other actions
}

// Event listener for "Add to Cart" buttons
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.getAttribute('data-product-id');
        addToCart(productId);
    });
});

// Event listener for "Place Order" button (assuming on a checkout page)
let placeOrderButton = document.querySelector('.btn.place-order');
if (placeOrderButton) {
    placeOrderButton.addEventListener('click', function() {
        checkout();
    });
}
