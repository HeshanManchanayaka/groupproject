
function updateSubtotal(input) {
      const quantity = parseInt(input.value);
      const priceCell = input.parentNode.nextElementSibling;
      const subtotalCell = priceCell.nextElementSibling;

      const price = parseFloat(priceCell.textContent.replace('LKR', ''));
      const subtotal = quantity * price;

      subtotalCell.textContent = `LKR${subtotal.toFixed(2)}`;
      updateTotalPrice();
    } function removeItem(button) {
      var row = button.parentNode.parentNode;
      row.parentNode.removeChild(row);
    }
    function removeItem(button) {
      // Remove the entire row
      const row = button.parentNode.parentNode;
      row.parentNode.removeChild(row);
    
      // After removing the row, update the total price
      updateTotalPrice();
    }
    
    function updateTotalPrice() {
      const subtotalCells = document.querySelectorAll('.subtotal');
      let totalPrice = 0;
    
      subtotalCells.forEach(subtotalCell => {
        const subtotal = parseFloat(subtotalCell.textContent.replace('LKR', ''));
        totalPrice += subtotal;
      });
    
      const totalElement = document.getElementById('total');
      totalElement.textContent = `LKR ${totalPrice.toFixed(2)}`;
    }
    



    let cart = [];

function addToCart(itemName, author, itemPrice, imagePath) {
  const item = {
    name: itemName,
    author: author,
    price: itemPrice,
    image: imagePath
  };

  cart.push(item);
  updateCartTable();
  alert(`${itemName} added to cart!`);
}

function updateCartTable() {
  const cartBody = document.getElementById('cartBody');
  cartBody.innerHTML = '';

  cart.forEach(item => {
    const row = document.createElement('tr');

    const itemNameCell = document.createElement('td');
    const itemImage = document.createElement('img');
    itemImage.src = item.image;
    itemImage.alt = `${item.name} Image`;
    itemNameCell.appendChild(itemImage);
    itemNameCell.innerHTML += `<p>${item.name}</p>`;
    itemNameCell.innerHTML += `<p>Author: ${item.author}</p>`;
    row.appendChild(itemNameCell);

    const quantityCell = document.createElement('td');
    quantityCell.textContent = '1'; // You can modify this if you want to track quantity
    row.appendChild(quantityCell);

    const priceCell = document.createElement('td');
    priceCell.textContent = `LKR ${item.price.toFixed(2)}`;
    row.appendChild(priceCell);

    const subtotalCell = document.createElement('td');
    subtotalCell.textContent = `LKR ${item.price.toFixed(2)}`;
    row.appendChild(subtotalCell);

    const actionCell = document.createElement('td');
    const removeButton = document.createElement('button');
    removeButton.textContent = 'Remove';
    removeButton.addEventListener('click', function() {
      removeItemFromCart(item);
    });
    actionCell.appendChild(removeButton);
    row.appendChild(actionCell);

    cartBody.appendChild(row);
  });

  updateTotalPrice();
}

function removeItemFromCart(itemToRemove) {
  cart = cart.filter(item => item !== itemToRemove);
  updateCartTable();
}

function updateTotalPrice() {
  const subtotalCells = document.querySelectorAll('#cartBody .subtotal');
  let totalPrice = 0;

  subtotalCells.forEach(subtotalCell => {
    const subtotal = parseFloat(subtotalCell.textContent.replace('LKR', ''));
    totalPrice += subtotal;
  });

  const totalElement = document.getElementById('total');
  totalElement.textContent = `LKR ${totalPrice.toFixed(2)}`;
}

    

