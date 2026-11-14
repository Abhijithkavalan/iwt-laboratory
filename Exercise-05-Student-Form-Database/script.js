/**
 * IWT Exercise 05: Client-Side Employee Form Validation
 */

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('employeeForm');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        const phone = document.getElementById('phone').value.trim();
        const salary = parseFloat(document.getElementById('salary').value);
        const dobInput = document.getElementById('dob').value;

        // 1. Validate Phone Number (10 digits)
        const phoneRegex = /^[0-9]{10}$/;
        if (!phoneRegex.test(phone)) {
            alert('Validation Error: Please enter a valid 10-digit mobile number without spaces or symbols.');
            document.getElementById('phone').focus();
            e.preventDefault();
            return false;
        }

        // 2. Validate Salary (Must be positive)
        if (isNaN(salary) || salary <= 0) {
            alert('Validation Error: Please enter a valid positive salary amount.');
            document.getElementById('salary').focus();
            e.preventDefault();
            return false;
        }

        // 3. Validate Date of Birth (Must be a past date, age at least 18)
        if (dobInput) {
            const dob = new Date(dobInput);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            if (dob >= today) {
                alert('Validation Error: Date of Birth cannot be in the future.');
                document.getElementById('dob').focus();
                e.preventDefault();
                return false;
            }

            if (age < 18) {
                alert('Validation Error: Employee must be at least 18 years of age.');
                document.getElementById('dob').focus();
                e.preventDefault();
                return false;
            }
        }

        return true;
    });
});
