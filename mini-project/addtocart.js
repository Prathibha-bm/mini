document.getElementById('add-to-cart').addEventListener('click', function() {
    const items = document.querySelectorAll('input[name="item"]:checked');
    const cartItems = []; // Array to store cart items
    const cartTable = document.getElementById('cart-table').getElementsByTagName('tbody')[0];
    const totalPriceElement = document.getElementById('total-price');
  
    let totalPrice = 0;
  
    items.forEach(item => {
      const quantityInput = document.querySelector(`input[name="${item.value}-quantity"]`);
      const quantity = parseInt(quantityInput.value);
      const price = parseFloat(item.value.split('$')[1]);
  
      // Create an object for the cart item
      const cartItem = {
        name: item.value.split('$')[0],
        quantity: quantity,
        price: price
      };
  
      cartItems.push(cartItem); // Add item to the cart items array
  
      const row = cartTable.insertRow();
      row.insertCell(0).textContent = cartItem.name;
      row.insertCell(1).textContent = cartItem.quantity;
      row.insertCell(2).textContent = `$${(cartItem.quantity * cartItem.price).toFixed(2)}`;
  
      totalPrice += cartItem.quantity * cartItem.price;
    });
  
    totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
  
    // Store the cart items in localStorage (optional)
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
  });