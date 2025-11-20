// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Email submission handler
document.getElementById('enviarEmail').addEventListener('click', function() {
    const emailInput = document.getElementById('emailInput');
    const email = emailInput.value.trim();
    
    // Simple email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email === '') {
        showAlert('Por favor, digite seu email.', 'warning');
        return;
    }
    
    if (!emailRegex.test(email)) {
        showAlert('Por favor, digite um email válido.', 'danger');
        return;
    }
    
    // Success message
    showAlert('Obrigado! Entraremos em contato em breve.', 'success');
    emailInput.value = '';
});

// Allow Enter key to submit email
document.getElementById('emailInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('enviarEmail').click();
    }
});

// Function to show alerts
function showAlert(message, type) {
    // Create alert element
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 4000);
}

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('shadow');
    } else {
        navbar.classList.remove('shadow');
    }
});

// Add fade-in animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe sections for fade-in animation
document.querySelectorAll('section').forEach(section => {
    observer.observe(section);
});

// Add animation to feedback cards
document.querySelectorAll('.feedback-card').forEach((card, index) => {
    card.style.animationDelay = `${index * 0.2}s`;
});

// Console welcome message
console.log('%c🎉 Bem-vindo ao Reintegra!', 'color: #0d6efd; font-size: 20px; font-weight: bold;');
console.log('%cReintegrando vidas, construindo futuros.', 'color: #6c757d; font-size: 14px;');

