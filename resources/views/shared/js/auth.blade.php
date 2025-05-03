<script>
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById(modalId.replace('Modal', 'Backdrop'));
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.visibility = 'hidden';
                if (backdrop) backdrop.style.display = 'none';
            }, 300);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal-notification');
        const backdrops = document.querySelectorAll('.modal-backdrop');

        if (modals.length > 0) {
            modals.forEach(modal => {
                modal.style.visibility = 'visible';
                modal.offsetHeight; // Force reflow
                modal.classList.add('show');
            });

            backdrops.forEach(backdrop => {
                backdrop.style.display = 'block';
            });

            setTimeout(() => {
                modals.forEach(modal => {
                    const modalId = modal.id;
                    closeModal(modalId);
                });
            }, 5000);
        }
    });
</script>
