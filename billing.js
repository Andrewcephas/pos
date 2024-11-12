$(document).ready(function () {
    // Load categories and items on page load
    loadCategories();
    loadItems(); // Load all items by default
  
    // Fetch and display all categories
    function loadCategories() {
      $.get('fetch_categories.php', function (data) {
        $('#categoryList').html(data);
      });
    }
  
    // Fetch and display items for a specific category
    function loadItems(category = '') {
      $.get('fetch_items.php', { category: category }, function (data) {
        $('#itemList').html(data);
      });
    }
  
    // Load items of a specific category when clicked
    $(document).on('click', '.category-item', function () {
      const category = $(this).data('category');
      loadItems(category);
    });
  
    // Handle adding an item to the bill
    $(document).on('click', '.item-card', function () {
      const itemName = $(this).data('name');
      const itemPrice = parseFloat($(this).data('price'));
  
      $('#billList').append(`<li>${itemName} - $${itemPrice.toFixed(2)}</li>`);
  
      // Update total price
      let total = parseFloat($('#totalPrice').text());
      total += itemPrice;
      $('#totalPrice').text(total.toFixed(2));
    });
  });

  // Handle checkout and print receipt
$(document).on('click', '#checkoutButton', function () {
    const billItems = $('#billList').html();
    const total = $('#totalPrice').text();

    if (billItems.trim() === "") {
        alert("No items in the bill to checkout!");
        return;
    }

    // Generate receipt content
    const receiptContent = `
        <div style="text-align: center;">
            <h3>Receipt</h3>
            <ul>${billItems}</ul>
            <h4>Total: $${total}</h4>
        </div>
    `;

    // Open a new window for printing the receipt
    const printWindow = window.open('', '_blank', 'width=400,height=600');
    printWindow.document.write(`
        <html>
        <head><title>Print Receipt</title></head>
        <body>${receiptContent}</body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
});
