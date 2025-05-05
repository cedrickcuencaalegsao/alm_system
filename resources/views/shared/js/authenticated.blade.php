<script>
    document.addEventListener('DOMContentLoaded', function() {

    });
    document.addEventListener('DOMContentLoaded', function() {

        const sections = document.querySelectorAll('section[id]');
        const categoryLinks = document.querySelectorAll('.category-link');

        // Show success modal on page load if success message exists
        const successModal = document.getElementById('successModal');
        const errorModal = document.getElementById('errorModal');
        if (successModal) {
            const modal = new bootstrap.Modal(successModal);
            modal.show();
        }

        // Show error modal if exists

        if (errorModal) {
            var modal = new bootstrap.Modal(errorModal);
            modal.show();
        }

        // Function to update active state
        function updateActiveLink() {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 300)) {
                    current = '#' + section.getAttribute('id');
                }
            });

            categoryLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === current) {
                    link.classList.add('active');
                }
            });
        }

        // Update active state on scroll
        window.addEventListener('scroll', updateActiveLink);

        // Update active state on page load
        updateActiveLink();

        // Handle click events on category links
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    const offsetTop = targetSection.offsetTop - 100; // Adjust offset as needed
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });

                    // Update active state
                    categoryLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    });

    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.style.animation = 'slideOutRight 0.5s ease-out forwards';
            setTimeout(() => {
                toast.remove();
            }, 500);
        }
    }

    // Auto-close toasts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const toasts = document.querySelectorAll('.notification-toast');
        toasts.forEach(toast => {
            setTimeout(() => {
                if (toast) {
                    toast.style.animation = 'slideOutRight 0.5s ease-out forwards';
                    setTimeout(() => {
                        toast.remove();
                    }, 500);
                }
            }, 5000);
        });
    });

    // Add slideOutRight animation keyframes
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideOutRight {
            0% {
                transform: translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
