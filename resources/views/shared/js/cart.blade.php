<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const quantityButtons = document.querySelectorAll('.quantity-btn');
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const shippingCost = 5.00;

        // Initial calculation
        updateOrderSummary();
        initializeButtonStates();

        // Initialize button states for all items
        function initializeButtonStates() {
            quantityInputs.forEach(input => {
                const currentQty = parseInt(input.value);
                const maxStock = parseInt(input.dataset.maxStock);
                const container = input.parentElement;
                const decreaseBtn = container.querySelector('.decrease');
                const increaseBtn = container.querySelector('.increase');

                // Set initial button states
                decreaseBtn.disabled = (currentQty === 1);
                increaseBtn.disabled = (currentQty >= maxStock);
            });
        }

        // Update quantity with stock validation
        function updateQuantity(input, change) {
            const currentQty = parseInt(input.value);
            const maxStock = parseInt(input.dataset.maxStock);
            const newQty = currentQty + change;

            // Validate quantity bounds
            if (newQty < 1 || newQty > maxStock) {
                return;
            }

            // Update quantity
            input.value = newQty;

            // Update button states
            const container = input.parentElement;
            const decreaseBtn = container.querySelector('.decrease');
            const increaseBtn = container.querySelector('.increase');

            decreaseBtn.disabled = (newQty === 1);
            increaseBtn.disabled = (newQty >= maxStock);

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
            const cartItem = input.closest('.cart-item');
            const maxStock = parseInt(cartItem.dataset.maxStock);
            input.setAttribute('max', maxStock);
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