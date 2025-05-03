<script>
    function updateQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        const currentQty = parseInt(quantityInput.value);
        const newQty = Math.max(1, Math.min(10, currentQty + change));

        if (newQty !== currentQty) {
            quantityInput.value = newQty;
            updateOrderSummary(newQty);
        }
    }

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
