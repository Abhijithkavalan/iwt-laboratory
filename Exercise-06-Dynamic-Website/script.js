/**
 * IWT Exercise 06: Client-Side Validation
 */

document.addEventListener('DOMContentLoaded', () => {
    const regForm = document.getElementById('registerForm');
    if (regForm) {
        regForm.addEventListener('submit', (e) => {
            const password = document.getElementById('password').value;
            const phone = document.getElementById('phone').value.trim();

            if (password.length < 6) {
                alert('Validation Error: Password must be at least 6 characters long.');
                document.getElementById('password').focus();
                e.preventDefault();
                return false;
            }

            const phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone)) {
                alert('Validation Error: Phone number must be exactly 10 digits.');
                document.getElementById('phone').focus();
                e.preventDefault();
                return false;
            }

            return true;
        });
    }
});
