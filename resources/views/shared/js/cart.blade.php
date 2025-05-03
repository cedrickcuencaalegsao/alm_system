<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const quantityButtons = document.querySelectorAll('.quantity-btn');
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const shippingCost = 5.00;

        // Initial calculation
        updateOrderSummary();

        // Update quantity
        function updateQuantity(input, change) {
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            input.value = value;
            updateOrderSummary();
        }

        // Event listeners for quantity buttons
        quantityButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                const change = this.classList.contains('increase') ? 1 : -1;
                updateQuantity(input, change);
            });
        });

        // Event listeners for quantity inputs
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value < 1) this.value = 1;
                updateOrderSummary();
            });
        });

        // Event listeners for checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateOrderSummary);
        });

        // Update order summary
        function updateOrderSummary() {
            let itemsTotal = 0;
            let itemCalculationsHTML = '';
            let selectedItems = [];

            // Calculate items total from selected items
            checkboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const cartItem = checkbox.closest('.cart-item');
                    const quantity = parseInt(cartItem.querySelector('.quantity-input').value);
                    const priceText = cartItem.querySelector('.text-end h6').textContent;
                    const price = parseFloat(priceText.replace(/[^0-9.-]+/g, ''));
                    const bookName = cartItem.querySelector('h6').textContent.trim();
                    const itemTotal = price * quantity;

                    itemsTotal += itemTotal;

                    // Create HTML for individual item calculation
                    itemCalculationsHTML += `
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small" style="max-width: 70%;" title="${bookName}">
                                ${bookName.length > 20 ? bookName.substring(0, 20) + '...' : bookName}
                                <span class="text-secondary">(${quantity} × $${price.toFixed(2)})</span>
                            </span>
                            <span>$${itemTotal.toFixed(2)}</span>
                        </div>
                    `;

                    selectedItems.push({
                        id: checkbox.value,
                        quantity: quantity,
                        price: price,
                        total: itemTotal
                    });
                }
            });

            // Update the DOM with individual item calculations
            document.getElementById('item-calculations').innerHTML = itemCalculationsHTML ||
                '<div class="text-muted mb-2">No items selected</div>';
            document.getElementById('shipping-cost').textContent = '$' + shippingCost.toFixed(2);

            const orderTotal = itemsTotal + shippingCost;
            document.getElementById('order-total').textContent = '$' + orderTotal.toFixed(2);
            document.getElementById('order-total-input').value = orderTotal.toFixed(2);
        }
    });
</script>
