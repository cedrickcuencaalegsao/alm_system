<script>
    // Preview profile picture before upload
    document.getElementById('profilePicture').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);

            // Add a console log for debugging
            console.log('File selected:', e.target.files[0].name);
        }
    });

    // Auto-hide success message after 5 seconds
    const successMessage = document.querySelector('.alert-success');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.transition = 'opacity 1s ease';
            successMessage.style.opacity = '0';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 1000);
        }, 5000);
    }

    // Toggle password visibility
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const passwordIcon = document.getElementById(inputId + 'Icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }

    // Password strength indicator
    document.getElementById('newPassword').addEventListener('input', function() {
        const password = this.value;
        const strengthDiv = document.getElementById('passwordStrength');
        strengthDiv.style.display = 'block';

        // Check password strength
        if (password.length === 0) {
            strengthDiv.style.display = 'none';
        } else if (password.length < 6) {
            strengthDiv.className = 'alert-feedback alert-danger';
            strengthDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> Password is too short';
        } else if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password)) {
            strengthDiv.className = 'alert-feedback alert-warning';
            strengthDiv.innerHTML =
                '<i class="fas fa-exclamation-triangle me-1"></i> Medium (add uppercase, lowercase and numbers)';
        } else {
            strengthDiv.className = 'alert-feedback alert-success';
            strengthDiv.innerHTML = '<i class="fas fa-check-circle me-1"></i> Strong password';
        }
    });
</script>
