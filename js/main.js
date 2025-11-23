// ===================================
// FIDORA V2.0 - MINIMALIST JAVASCRIPT
// ===================================

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            window.scrollTo({
                top: target.offsetTop - 64,
                behavior: 'smooth'
            });
        }
    });
});

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const nav = document.querySelector('.nav');
    if (nav) {
        if (window.scrollY > 50) {
            nav.style.background = 'rgba(0, 0, 0, 0.95)';
        } else {
            nav.style.background = 'rgba(0, 0, 0, 0.8)';
        }
    }
});

// Mobile menu toggle
const mobileToggle = document.querySelector('.mobile-toggle');
const navLinks = document.querySelector('.nav-links');

if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        mobileToggle.classList.toggle('active');
    });
}

// Animated message flow
function animateMessages() {
    const messages = document.querySelectorAll('.message');
    if (messages.length === 0) return;
    
    messages.forEach((msg, index) => {
        setTimeout(() => {
            msg.style.opacity = '1';
            msg.style.transform = 'translateY(0)';
        }, index * 1500);
    });
    
    // Loop animation
    setTimeout(() => {
        messages.forEach(msg => {
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(20px)';
        });
        setTimeout(animateMessages, 1000);
    }, messages.length * 1500 + 3000);
}

// Start message animation when page loads
window.addEventListener('load', () => {
    setTimeout(animateMessages, 1000);
});

// Intersection Observer for fade-in animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.industry-card, .step, .proof-stat');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// Industry toggle functionality
const toggleButtons = document.querySelectorAll('.toggle-btn');
const chatMessages = document.querySelectorAll('.chat-messages');

// Auto-scroll chat to bottom
function scrollChatToBottom(chatElement) {
    if (chatElement) {
        chatElement.scrollTop = chatElement.scrollHeight;
    }
}

if (toggleButtons.length > 0 && chatMessages.length > 0) {
    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const industry = button.getAttribute('data-industry');
            
            // Update active button
            toggleButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Update active chat messages
            chatMessages.forEach(chat => {
                chat.classList.remove('active');
                if (chat.getAttribute('data-industry') === industry) {
                    chat.classList.add('active');
                    
                    // Reset and restart animations for messages
                    const messages = chat.querySelectorAll('.message');
                    messages.forEach((msg, index) => {
                        msg.style.opacity = '0';
                        msg.style.transform = 'translateY(10px)';
                        setTimeout(() => {
                            msg.style.opacity = '1';
                            msg.style.transform = 'translateY(0)';
                            
                            // Auto-scroll after last message appears
                            if (index === messages.length - 1) {
                                setTimeout(() => scrollChatToBottom(chat), 100);
                            }
                        }, index * 400);
                    });
                }
            });
        });
    });
    
    // Auto-scroll on page load for active chat
    const activeChat = document.querySelector('.chat-messages.active');
    if (activeChat) {
        setTimeout(() => scrollChatToBottom(activeChat), 1000);
    }
}

// Pulse animation for flow nodes
function pulseNodes() {
    const nodes = document.querySelectorAll('.flow-node');
    nodes.forEach((node, index) => {
        setTimeout(() => {
            node.style.transform = node.classList.contains('whatsapp-node') 
                ? 'translate(-50%, -50%) scale(1.05)' 
                : 'translateY(-4px) scale(1.05)';
            
            setTimeout(() => {
                node.style.transform = node.classList.contains('whatsapp-node')
                    ? 'translate(-50%, -50%) scale(1)'
                    : 'translateY(0) scale(1)';
            }, 300);
        }, index * 200);
    });
}

// Start node pulse animation
setInterval(pulseNodes, 3000);

console.log('%c🚀 Fidora', 'font-size: 20px; font-weight: bold; color: #7C3AED;');
console.log('%cTu empleado de WhatsApp que nunca duerme', 'font-size: 12px; color: #B3B3B3;');
