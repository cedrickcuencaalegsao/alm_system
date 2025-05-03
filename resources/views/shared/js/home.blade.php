<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        const forms = document.querySelectorAll('.add-to-cart-form');

        // Initialize tooltips with custom options
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                placement: 'auto',
                html: true,
                container: 'body',
                delay: {
                    show: 200,
                    hide: 100
                },
                boundary: 'window'
            });
        });

        // Prevent form submission and use JavaScript instead
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (form.querySelector('.add-to-cart-btn')) {
                    e.preventDefault();
                    const button = form.querySelector('.add-to-cart-btn');
                    const bookId = button.dataset.bookId;

                    // Create and submit a form to add to cart
                    if (bookId) {
                        const dynamicForm = document.createElement('form');
                        dynamicForm.method = 'POST';
                        dynamicForm.action = '{{ route('add.to.cart') }}';

                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');
                        dynamicForm.appendChild(csrfToken);

                        // Add user ID
                        const userIdInput = document.createElement('input');
                        userIdInput.type = 'hidden';
                        userIdInput.name = 'user_id';
                        userIdInput.value = '{{ Auth::user()->userID }}';
                        dynamicForm.appendChild(userIdInput);

                        // Add book ID
                        const bookIdInput = document.createElement('input');
                        bookIdInput.type = 'hidden';
                        bookIdInput.name = 'book_id';
                        bookIdInput.value = bookId;
                        dynamicForm.appendChild(bookIdInput);

                        // Append to body and submit
                        document.body.appendChild(dynamicForm);

                        button.innerHTML =
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';
                        button.disabled = true;

                        dynamicForm.submit();
                    } else {
                        console.error('Book ID not found');
                        button.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Error';
                        setTimeout(() => {
                            button.innerHTML =
                                '<i class="bi bi-cart-plus me-2"></i>Add to Cart';
                            button.disabled = false;
                        }, 2000);
                    }
                }
            });
        });

        // Prevent tooltips from interfering with buttons
        document.querySelectorAll('.book-card .btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // Sort functionality (placeholder - would need backend implementation)
        document.querySelector('.sort-select')?.addEventListener('change', function() {
            console.log(`Sorting by: ${this.value}`);
            // TODO: Implement sorting functionality
        });
    });
</script>
