// Landing Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Theme Management
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    
    // Check for saved theme preference or default to dark mode
    const savedTheme = localStorage.getItem('theme') || 'dark';
    if (savedTheme === 'light') {
        body.classList.add('light-theme');
        updateThemeIcon(true);
    }
    
    // Theme toggle functionality
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            body.classList.toggle('light-theme');
            const isLight = body.classList.contains('light-theme');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
            updateThemeIcon(isLight);
        });
    }
    
    function updateThemeIcon(isLight) {
        const icon = themeToggle.querySelector('i');
        if (icon) {
            icon.className = isLight ? 'fas fa-moon' : 'fas fa-sun';
        }
    }
    
    // Language Selector
    const langBtn = document.getElementById('langBtn');
    const langDropdown = document.getElementById('langDropdown');
    const langOptions = document.querySelectorAll('.lang-option');
    
    if (langBtn && langDropdown) {
        // Toggle dropdown
        langBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            langDropdown.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!langBtn.contains(e.target) && !langDropdown.contains(e.target)) {
                langDropdown.classList.remove('active');
            }
        });
        
        // Handle language selection
        langOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedLang = this.getAttribute('data-lang');
                const langText = this.querySelector('span:last-child').textContent;
                const langCode = selectedLang.toUpperCase();
                
                // Update current language display
                const langCurrent = document.querySelector('.lang-current');
                if (langCurrent) {
                    langCurrent.textContent = langCode;
                }
                
                // Update active state
                langOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                
                // Close dropdown
                langDropdown.classList.remove('active');
                
                // Save preference
                localStorage.setItem('preferredLanguage', selectedLang);
                
                // In a real app, you would load translations here
                console.log(`Language changed to: ${langText} (${selectedLang})`);
                
                // Optional: Show notification
                // showNotification(`Idioma cambiado a ${langText}`, 'success');
            });
        });
        
        // Load saved language preference
        const savedLang = localStorage.getItem('preferredLanguage') || 'es';
        const savedOption = document.querySelector(`.lang-option[data-lang="${savedLang}"]`);
        if (savedOption) {
            savedOption.click();
        }
    }
    
    // Mobile Menu Toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            const icon = mobileMenuToggle.querySelector('i');
            icon.className = mobileMenu.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
        });
        
        // Close mobile menu when clicking on links
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                icon.className = 'fas fa-bars';
            });
        });
    }
    
    // Modal Management
    const modals = {
        login: document.getElementById('loginModal'),
        demo: document.getElementById('demoModal'),
        trial: document.getElementById('trialModal')
    };
    
    // Modal trigger buttons (removed login buttons to allow normal navigation)
    const modalTriggers = {
        demo: ['#heroDemoBtn', '#finalDemoBtn'],
        trial: ['#ctaBtn', '#mobileCtaBtn', '#heroCtaBtn', '#finalCtaBtn']
    };
    
    // Setup modal triggers
    Object.keys(modalTriggers).forEach(modalType => {
        modalTriggers[modalType].forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                if (element) {
                    element.addEventListener('click', function(e) {
                        e.preventDefault();
                        openModal(modalType);
                    });
                }
            });
        });
    });
    
    // Modal close buttons
    const closeButtons = document.querySelectorAll('.modal-close');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = button.closest('.modal-overlay');
            closeModal(modal);
        });
    });
    
    // Close modal when clicking overlay
    Object.values(modals).forEach(modal => {
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal(modal);
                }
            });
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal-overlay.active');
            if (activeModal) {
                closeModal(activeModal);
            }
        }
    });
    
    function openModal(modalType) {
        const modal = modals[modalType];
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus first input in modal
            setTimeout(() => {
                const firstInput = modal.querySelector('input');
                if (firstInput) {
                    firstInput.focus();
                }
            }, 300);
        }
    }
    
    function closeModal(modal) {
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    // Pricing Toggle
    const pricingToggle = document.getElementById('pricingToggle');
    if (pricingToggle) {
        pricingToggle.addEventListener('click', function() {
            pricingToggle.classList.toggle('active');
            const isAnnual = pricingToggle.classList.contains('active');
            
            // Toggle price display
            const monthlyPrices = document.querySelectorAll('.amount.monthly');
            const annualPrices = document.querySelectorAll('.amount.annual');
            
            monthlyPrices.forEach(price => {
                price.classList.toggle('hidden', isAnnual);
            });
            
            annualPrices.forEach(price => {
                price.classList.toggle('hidden', !isAnnual);
            });
        });
    }
    
    // Form Handling
    const loginForm = document.getElementById('loginForm');
    const trialForm = document.getElementById('trialForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleLogin(new FormData(loginForm));
        });
    }
    
    if (trialForm) {
        trialForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleTrialSignup(new FormData(trialForm));
        });
    }
    
    function handleLogin(formData) {
        const email = formData.get('email');
        const password = formData.get('password');
        const remember = formData.get('remember');
        
        // Show loading state
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // For demo purposes, redirect to the CRM dashboard
            // In a real app, you would validate credentials with your backend
            if (email && password) {
                // Store login state
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userEmail', email);
                
                // Redirect to CRM (you could create a separate CRM page)
                alert('Login successful! Redirecting to dashboard...');
                closeModal(modals.login);
                
                // Reset form
                loginForm.reset();
            } else {
                alert('Please fill in all fields');
            }
            
            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 1500);
    }
    
    function handleTrialSignup(formData) {
        const firstName = formData.get('firstName');
        const lastName = formData.get('lastName');
        const email = formData.get('email');
        const company = formData.get('company');
        
        // Show loading state
        const submitBtn = trialForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
        submitBtn.disabled = true;
        
        // Send to webhook
        const webhookUrl = 'https://n.fidora.es/webhook/Fidora-demo';
        
        fetch(webhookUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                firstName,
                lastName,
                email,
                company,
                timestamp: new Date().toISOString(),
                source: 'landing_page'
            })
        })
        .then(response => {
            if (response.ok) {
                alert(`¡Gracias ${firstName}! Hemos recibido tu solicitud. Te contactaremos pronto.`);
                closeModal(modals.trial);
                trialForm.reset();
            } else {
                throw new Error('Error al enviar la solicitud');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al enviar tu solicitud. Por favor, intenta de nuevo.');
        })
        .finally(() => {
            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    }
    
    // Smooth Scrolling for Navigation Links
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const offsetTop = targetElement.offsetTop - 80; // Account for fixed nav
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Navbar Scroll Effect
    const navbar = document.querySelector('.landing-nav');
    if (navbar) {
        let lastScrollY = window.scrollY;
        
        window.addEventListener('scroll', function() {
            const currentScrollY = window.scrollY;
            
            if (currentScrollY > 100) {
                navbar.style.background = 'rgba(0, 0, 0, 0.95)';
                navbar.style.backdropFilter = 'blur(20px)';
            } else {
                navbar.style.background = 'var(--bg-glass)';
                navbar.style.backdropFilter = 'var(--glass-blur)';
            }
            
            // Hide/show navbar on scroll
            if (currentScrollY > lastScrollY && currentScrollY > 200) {
                navbar.style.transform = 'translateY(-100%)';
            } else {
                navbar.style.transform = 'translateY(0)';
            }
            
            lastScrollY = currentScrollY;
        });
    }
    
    // Intersection Observer for Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.feature-card, .testimonial-card, .pricing-card, .kpi-card');
    animatedElements.forEach(element => {
        observer.observe(element);
    });
    
    // Counter Animation for Stats
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format number based on target
            let displayValue;
            if (target >= 1000) {
                displayValue = Math.floor(current / 1000) + 'k+';
            } else if (target.toString().includes('%')) {
                displayValue = Math.floor(current) + '%';
            } else {
                displayValue = Math.floor(current);
            }
            
            element.textContent = displayValue;
        }, 16);
    }
    
    // Animate stats when they come into view
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumber = entry.target;
                const text = statNumber.textContent;
                
                // Extract number from text
                let target;
                if (text.includes('k+')) {
                    target = parseInt(text.replace('k+', '')) * 1000;
                } else if (text.includes('%')) {
                    target = parseInt(text.replace('%', ''));
                } else {
                    target = parseInt(text);
                }
                
                if (!isNaN(target)) {
                    animateCounter(statNumber, target);
                    statsObserver.unobserve(statNumber);
                }
            }
        });
    }, observerOptions);
    
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        statsObserver.observe(stat);
    });
    
    // Social Login Handlers
    const socialButtons = document.querySelectorAll('.social-btn');
    socialButtons.forEach(button => {
        button.addEventListener('click', function() {
            const provider = this.classList.contains('google') ? 'Google' : 'Microsoft';
            
            // Show loading state
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connecting...';
            this.disabled = true;
            
            // Simulate OAuth flow
            setTimeout(() => {
                alert(`${provider} login would be handled here. This is a demo.`);
                
                // Reset button
                this.innerHTML = originalContent;
                this.disabled = false;
            }, 1500);
        });
    });
    
    // Video Play Button
    const videoPlayBtn = document.querySelector('.video-play-btn');
    if (videoPlayBtn) {
        videoPlayBtn.addEventListener('click', function() {
            // In a real implementation, you would load and play the actual video
            alert('Demo video would play here. This is a placeholder.');
        });
    }
    
    // Pricing Card Interactions
    const pricingCards = document.querySelectorAll('.pricing-card');
    pricingCards.forEach(card => {
        const button = card.querySelector('button');
        if (button && button.textContent.includes('Contact Sales')) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                // Open contact form or redirect to contact page
                alert('Contact sales form would open here. This is a demo.');
            });
        } else if (button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                openModal('trial');
            });
        }
    });
    
    // Newsletter Signup (if you add one)
    const newsletterForm = document.getElementById('newsletterForm');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = new FormData(newsletterForm).get('email');
            
            if (email) {
                alert('Thank you for subscribing to our newsletter!');
                newsletterForm.reset();
            }
        });
    }
    
    // Testimonial Carousel (if you want to add auto-rotation)
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    if (testimonialCards.length > 3) {
        let currentTestimonial = 0;
        
        function rotateTestimonials() {
            testimonialCards.forEach((card, index) => {
                card.style.display = index >= currentTestimonial && index < currentTestimonial + 3 ? 'block' : 'none';
            });
            
            currentTestimonial = (currentTestimonial + 1) % (testimonialCards.length - 2);
        }
        
        // Auto-rotate every 5 seconds
        setInterval(rotateTestimonials, 5000);
    }
    
    // Feature Card Hover Effects
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-8px)';
        });
    });
    
    // Add loading states to all CTA buttons
    const ctaButtons = document.querySelectorAll('.btn-primary-large, .btn-secondary-large');
    ctaButtons.forEach(button => {
        if (!button.hasAttribute('data-modal-trigger')) {
            button.addEventListener('click', function(e) {
                if (this.textContent.includes('Demo') || this.textContent.includes('Schedule')) {
                    e.preventDefault();
                    openModal('demo');
                } else if (this.textContent.includes('Trial') || this.textContent.includes('Start')) {
                    e.preventDefault();
                    openModal('trial');
                }
            });
        }
    });
    
    // Initialize tooltips (if you want to add them)
    function initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.textContent = this.getAttribute('data-tooltip');
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
                
                this._tooltip = tooltip;
            });
            
            element.addEventListener('mouseleave', function() {
                if (this._tooltip) {
                    document.body.removeChild(this._tooltip);
                    this._tooltip = null;
                }
            });
        });
    }
    
    // Initialize tooltips
    initTooltips();
    
    // Performance optimization: Lazy load images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.getAttribute('data-src');
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => {
        imageObserver.observe(img);
    });
    
    // Add some Easter eggs for fun
    let konamiCode = [];
    const konamiSequence = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65]; // Up Up Down Down Left Right Left Right B A
    
    document.addEventListener('keydown', function(e) {
        konamiCode.push(e.keyCode);
        if (konamiCode.length > konamiSequence.length) {
            konamiCode.shift();
        }
        
        if (konamiCode.join(',') === konamiSequence.join(',')) {
            // Easter egg activated!
            document.body.style.transform = 'rotate(360deg)';
            document.body.style.transition = 'transform 2s ease-in-out';
            
            setTimeout(() => {
                document.body.style.transform = '';
                document.body.style.transition = '';
                alert('🎉 Easter egg found! You unlocked a secret animation!');
            }, 2000);
            
            konamiCode = [];
        }
    });
    
    console.log('🚀 FIDORA CRM Landing Page Loaded Successfully!');
    console.log('💡 Try the Konami Code for a surprise: ↑↑↓↓←→←→BA');
});

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Export functions for potential use in other scripts
window.FidoraLanding = {
    openModal: function(modalType) {
        const modals = {
            login: document.getElementById('loginModal'),
            demo: document.getElementById('demoModal'),
            trial: document.getElementById('trialModal')
        };
        
        const modal = modals[modalType];
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    },
    
    closeModal: function(modal) {
        if (typeof modal === 'string') {
            modal = document.getElementById(modal);
        }
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    },
    
    toggleTheme: function() {
        document.body.classList.toggle('light-theme');
        const isLight = document.body.classList.contains('light-theme');
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
    }
};
