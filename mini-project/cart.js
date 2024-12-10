// Assuming you have a list of products, each with an "add-to-cart" button

const addToCartButtons = document.querySelectorAll('.add-to-cart');

addToCartButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Get the product details (e.g., name, price, image) from the button's parent element or data attributes
    const productName = button.parentNode.querySelector('.product-name').textContent;
    const productPrice = button.parentNode.querySelector('.product-price').textContent;
    const productImage = button.parentNode.querySelector('.product-image').src;

    // Create a new cart item object
    const cartItem = {
      name: productName,
      price: productPrice,
      image: productImage,
      quantity: 1
    };

    // Add the cart item to the cart (e.g., using local storage or a backend API)
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(cartItem);
    localStorage.setItem('cart', JSON.stringify(cart));

    // Update the cart UI or display a success message
    updateCartUI();
    alert('Item added to cart!');
  });
});

// Function to update the cart UI (optional)
function updateCartUI() {
  const cartItems = JSON.parse(localStorage.getItem('cart'));
  const cartContainer = document.getElementById('cart-container');
  cartContainer.innerHTML = ''; // Clear the cart container

  cartItems.forEach(item => {
    // Create a cart item element and append it to the cart container
    const cartItemElement = document.createElement('div');
    cartItemElement.innerHTML = `
      <img src="${item.image}" alt="${item.name}">
      <p>${item.name}</p>
      <p>${item.price}</p>
      <p>Quantity: ${item.quantity}</p>
    `;
    cartContainer.appendChild(cartItemElement);
  });
}