<script>
    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.main-content').classList.toggle('expanded');
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize toasts
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl);
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Chart !== 'undefined') {
            var ctx = document.getElementById('salesChart');
            if (ctx) {
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                            'Nov', 'Dec'
                        ],
                        datasets: [{
                            label: 'Monthly Sales',
                            data: [5000, 8000, 12000, 9000, 10000, 15000, 16000, 17000, 14000,
                                16000, 18000, 20000
                            ],
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [2],
                                    drawBorder: false
                                },
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                }
                            }
                        }
                    }
                });
            }
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password reset fields
        const resetCheckbox = document.getElementById('resetPassword');
        const passwordFields = document.querySelector('.password-fields');

        if (resetCheckbox && passwordFields) {
            resetCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    passwordFields.classList.remove('d-none');
                } else {
                    passwordFields.classList.add('d-none');
                }
            });
        }

        // Select all checkbox
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('tbody .form-check-input');

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }
    });

    function adjustQuantity(change) {
        const input = document.getElementById('quantityInput');
        let newValue = parseInt(input.value) + change;
        newValue = Math.max(newValue, 0);
        input.value = newValue;
    }
   
</script>
