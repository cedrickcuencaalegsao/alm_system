<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View switching (grid/list)
        const viewOptions = document.querySelectorAll('.view-option');
        const bookContainer = document.querySelector('.book-container');

        viewOptions.forEach(option => {
            option.addEventListener('click', function() {
                viewOptions.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const viewType = this.getAttribute('data-view');
                if (viewType === 'grid') {
                    bookContainer.classList.remove('list-view');
                    bookContainer.classList.add('grid-view');
                } else {
                    bookContainer.classList.remove('grid-view');
                    bookContainer.classList.add('list-view');
                }
            });
        });

        // Sorting functionality
        const sortSelect = document.getElementById('sortSelect');
        const bookItems = document.querySelectorAll('.book-item');

        sortSelect.addEventListener('change', function() {
            const sortType = this.value;
            const bookItemsArray = Array.from(bookItems);

            // Sort the books based on the selected option
            bookItemsArray.sort((a, b) => {
                if (sortType === 'title-asc') {
                    return a.querySelector('.book-title').textContent.trim().localeCompare(
                        b.querySelector('.book-title').textContent.trim()
                    );
                } else if (sortType === 'title-desc') {
                    return b.querySelector('.book-title').textContent.trim().localeCompare(
                        a.querySelector('.book-title').textContent.trim()
                    );
                } else if (sortType === 'price-asc') {
                    const priceA = parseFloat(a.querySelector('.book-price').textContent.trim()
                        .replace('₱', '').replace(',', '')) || 0;
                    const priceB = parseFloat(b.querySelector('.book-price').textContent.trim()
                        .replace('₱', '').replace(',', '')) || 0;
                    return priceA - priceB;
                } else if (sortType === 'price-desc') {
                    const priceA = parseFloat(a.querySelector('.book-price').textContent.trim()
                        .replace('₱', '').replace(',', '')) || 0;
                    const priceB = parseFloat(b.querySelector('.book-price').textContent.trim()
                        .replace('₱', '').replace(',', '')) || 0;
                    return priceB - priceA;
                }
                return 0;
            });

            // Remove all existing items
            bookItemsArray.forEach(item => {
                item.remove();
            });

            // Add them back in the sorted order
            bookItemsArray.forEach(item => {
                bookContainer.appendChild(item);
            });
        });
    });
</script>
