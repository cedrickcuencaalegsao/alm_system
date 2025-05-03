<script>
    function nextSection(currentSection) {
        const current = document.getElementById(`section${currentSection}`);
        const next = document.getElementById(`section${currentSection + 1}`);

        current.style.opacity = '0';
        setTimeout(() => {
            current.classList.add('d-none');
            next.classList.remove('d-none');
            setTimeout(() => {
                next.style.opacity = '1';
            }, 50);
        }, 300);
    }

    function previousSection(currentSection) {
        const current = document.getElementById(`section${currentSection}`);
        const previous = document.getElementById(`section${currentSection - 1}`);

        current.style.opacity = '0';
        setTimeout(() => {
            current.classList.add('d-none');
            previous.classList.remove('d-none');
            setTimeout(() => {
                previous.style.opacity = '1';
            }, 50);
        }, 300);
    }

    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.style.display = 'none';
            }, 300);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const toasts = document.querySelectorAll('.notification-toast');
        toasts.forEach(toast => {
            toast.style.display = 'block';
            // Force a reflow
            toast.offsetHeight;
            toast.classList.add('show');

            // Auto hide after 5 seconds
            setTimeout(() => {
                closeToast(toast.id);
            }, 5000);
        });
    });
</script>
