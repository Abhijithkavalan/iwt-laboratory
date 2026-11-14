/**
 * IWT Exercise 08: Contact Management Client Scripts
 */

function confirmDelete(contactName) {
    return confirm(`Are you sure you want to permanently delete the contact for "${contactName}"? This operation cannot be undone.`);
}

document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            const phone = document.getElementById('phone').value.trim();
            const phonePattern = /^[0-9]{10}$/;

            if (!phonePattern.test(phone)) {
                alert('Validation Error: Please enter a valid 10-digit mobile number.');
                document.getElementById('phone').focus();
                e.preventDefault();
                return false;
            }

            return true;
        });
    }
});
