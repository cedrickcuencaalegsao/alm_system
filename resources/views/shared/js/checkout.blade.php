<script>
    const maxStock = {{ $book->getStock() }};

    function updateQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const currentQty = parseInt(quantityInput.value);

        // Calculate new quantity
        const newQty = currentQty + change;

        // Validate quantity bounds
        if (newQty < 1 || newQty > maxStock) {
            return; // Don't allow invalid quantities
        }

        // Update quantity if valid
        quantityInput.value = newQty;
        updateOrderSummary(newQty);

        // Update button states - Changed this logic
        decreaseBtn.disabled = (newQty === 1); // Only disable when quantity is 1
        increaseBtn.disabled = (newQty === maxStock); // Only disable when quantity equals max stock
    }

    // Also update the DOMContentLoaded event handler with the same logic
    window.addEventListener('DOMContentLoaded', (event) => {
        const currentQty = parseInt(document.getElementById('quantity').value);
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');

        decreaseBtn.disabled = (currentQty === 1); // Changed from <= to ===
        increaseBtn.disabled = (currentQty === maxStock);
    });

    function updateOrderSummary(qty) {
        // Update quantity in summary
        document.getElementById('summary-qty').textContent = qty;

        // Get book price
        const bookPrice = {{ $book->getPrice() }};

        // Calculate and update subtotal
        const subtotal = bookPrice * qty;
        document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);

        // Calculate and update tax
        const tax = subtotal * 0.1;
        document.getElementById('tax').textContent = '$' + tax.toFixed(2);

        // Calculate and update total
        const total = subtotal + tax;
        document.getElementById('total').textContent = '$' + total.toFixed(2);

        // Update hidden form quantity
        document.getElementById('form-quantity').value = qty;
    }
</script>
