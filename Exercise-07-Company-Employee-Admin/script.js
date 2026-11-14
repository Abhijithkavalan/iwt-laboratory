/**
 * IWT Exercise 07: Client-Side Validation
 */

document.addEventListener('DOMContentLoaded', () => {
    const regForm = document.getElementById('companyRegisterForm');
    if (regForm) {
        regForm.addEventListener('submit', (e) => {
            const password = document.getElementById('password').value;
            const phone = document.getElementById('phone').value.trim();

            if (password.length < 6) {
                alert('Validation Error: Password must be at least 6 characters.');
                document.getElementById('password').focus();
                e.preventDefault();
                return false;
            }

            const phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone)) {
                alert('Validation Error: Please enter a 10-digit mobile number.');
                document.getElementById('phone').focus();
                e.preventDefault();
                return false;
            }

            return true;
        });
    }
});
