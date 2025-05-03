<script>
    // Client-side filtering for orders
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to all needed elements
        const filterButtonsContainer = document.getElementById('filter-buttons-container');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const orderItems = document.querySelectorAll('.order-item-col');
        const emptyState = document.getElementById('empty-state');
        const emptyStateTitle = document.getElementById('empty-state-title');
        const emptyStateMessage = document.getElementById('empty-state-message');

        // Set default filter if not already set
        if (!localStorage.getItem('orderFilterStatus')) {
            localStorage.setItem('orderFilterStatus', 'all');
        }

        // Get the saved filter or default to 'all'
        const savedFilter = localStorage.getItem('orderFilterStatus') || 'all';

        // Function to apply the active class to a button
        function setActiveButton(status) {
            // First remove active class from all buttons
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Find the button for the current status
            const targetButton = document.getElementById(`filter-${status}`);

            // If found, set it as active
            if (targetButton) {
                targetButton.classList.add('active');
            }
        }

        // Function to filter orders by status
        function filterOrders(status) {
            // Save the current filter
            localStorage.setItem('orderFilterStatus', status);

            // Apply the active class to button
            setActiveButton(status);

            // Counter for visible items
            let visibleCount = 0;

            // Loop through all order items and show/hide based on status
            orderItems.forEach(item => {
                if (status === 'all' || item.getAttribute('data-status') === status) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Update empty state if needed
            if (visibleCount === 0 && orderItems.length > 0) {
                // Show empty state with appropriate message
                emptyState.style.display = 'block';
                if (status !== 'all') {
                    emptyStateTitle.textContent =
                        `No ${status.charAt(0).toUpperCase() + status.slice(1)} Orders Found`;
                    emptyStateMessage.textContent = `You don't have any orders with ${status} status.`;
                } else {
                    emptyStateTitle.textContent = 'No Orders Found';
                    emptyStateMessage.textContent = 'You haven\'t placed any orders yet.';
                }
            } else {
                // Hide empty state if we have items
                emptyState.style.display = 'none';
            }
        }

        // Add click event listeners to buttons through delegation
        filterButtonsContainer.addEventListener('click', function(event) {
            // Find the closest button if we clicked on a child element
            const button = event.target.closest('.filter-btn');

            // If we found a button, filter by its status
            if (button) {
                const status = button.getAttribute('data-filter');
                filterOrders(status);
            }
        });

        // Apply the initial filter on page load
        filterOrders(savedFilter);
    });
</script>