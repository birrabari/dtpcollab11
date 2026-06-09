// app.js - Portal Ekskul with Premium Micro-interactions

// Mock Data
const MOCK_USER = { username: 'admin', password: 'password' };

const initialTransactions = [
    { id: 1, date: '2026-06-05', desc: 'Iuran Kas Bulanan - Budi', amount: 50000, type: 'in' },
    { id: 2, date: '2026-06-06', desc: 'Beli Bola Futsal', amount: 150000, type: 'out' },
    { id: 3, date: '2026-06-07', desc: 'Iuran Kas Bulanan - Andi', amount: 50000, type: 'in' },
    { id: 4, date: '2026-06-08', desc: 'Sumbangan Donatur', amount: 350000, type: 'in' },
];

// Initialize Local Storage if empty
if (!localStorage.getItem('transactions')) {
    localStorage.setItem('transactions', JSON.stringify(initialTransactions));
}

// Formatter for Rupiah with animation support
const formatRp = (number) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
};

// Animate number counting
const animateNumber = (element, finalValue, duration = 1000) => {
    const isNegative = finalValue < 0;
    const absoluteValue = Math.abs(finalValue);
    let currentValue = 0;
    const increment = absoluteValue / (duration / 16);
    
    const interval = setInterval(() => {
        currentValue += increment;
        if (currentValue >= absoluteValue) {
            currentValue = absoluteValue;
            clearInterval(interval);
        }
        element.textContent = formatRp(isNegative ? -currentValue : currentValue);
    }, 16);
};

// Add smooth page transitions
const addPageTransition = () => {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.3s ease';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 10);
};

// Check Auth State
const checkAuth = () => {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const path = window.location.pathname;

    if (!isLoggedIn && !path.includes('index.html') && path !== '/' && !path.endsWith('UKLKELAS11/')) {
        window.location.href = 'index.html';
    }

    if (isLoggedIn && (path.includes('index.html') || path.endsWith('UKLKELAS11/') || path === '/')) {
        window.location.href = 'dashboard.html';
    }
};

// Handle Login with enhanced UX
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    const submitBtn = loginForm.querySelector('.btn-primary');
    
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const user = document.getElementById('username').value.trim();
        const pass = document.getElementById('password').value;

        // Add loading state
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Memverifikasi...';

        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 800));

        if (user === MOCK_USER.username && pass === MOCK_USER.password) {
            submitBtn.textContent = '✓ Berhasil!';
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('currentUser', user);
            
            // Smooth transition to dashboard
            setTimeout(() => {
                window.location.href = 'dashboard.html';
            }, 400);
        } else {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            
            // Shake animation for error
            loginForm.style.animation = 'none';
            setTimeout(() => {
                loginForm.style.animation = 'shake 0.5s ease';
            }, 10);
            
            alert('❌ Username atau password salah!\n\nDemo: admin / password');
            document.getElementById('password').value = '';
            document.getElementById('username').focus();
        }
    });
    
    // Form input animations
    const inputs = loginForm.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.style.transform = 'scale(1.02)';
        });
        input.addEventListener('blur', () => {
            input.parentElement.style.transform = 'scale(1)';
        });
    });
}

// Add shake animation to stylesheet
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-8px); }
        75% { transform: translateX(8px); }
    }
`;
document.head.appendChild(style);

// Handle Logout with confirmation
const logoutBtn = document.getElementById('logoutBtn');
if (logoutBtn) {
    logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('currentUser');
            window.location.href = 'index.html';
        }
    });
}

// Dashboard Logic with Animations
const recentTransactionsBody = document.getElementById('recentTransactions');
if (recentTransactionsBody) {
    // Populate username with animation
    const userNameDisplay = document.getElementById('userNameDisplay');
    if (userNameDisplay) {
        const currentUser = localStorage.getItem('currentUser') || 'Admin';
        userNameDisplay.textContent = currentUser;
        userNameDisplay.style.animation = 'fadeInUp 0.6s ease-out';
    }

    // Load Data
    const transactions = JSON.parse(localStorage.getItem('transactions'));
    
    // Calculate Totals
    let totalIn = 0;
    let totalOut = 0;

    transactions.forEach(t => {
        if (t.type === 'in') totalIn += t.amount;
        if (t.type === 'out') totalOut += t.amount;
    });

    const totalSaldo = totalIn - totalOut;

    // Animate counter values
    const kasMasukEl = document.getElementById('totalKasMasuk');
    const kasKeluarEl = document.getElementById('totalKasKeluar');
    const saldoKasEl = document.getElementById('totalSaldoKas');
    
    if (saldoKasEl) {
        saldoKasEl.style.animation = 'fadeInUp 0.8s ease-out';
        setTimeout(() => animateNumber(saldoKasEl, totalSaldo, 1500), 200);
    }
    
    if (kasMasukEl) {
        kasMasukEl.style.animation = 'fadeInUp 0.8s ease-out 0.1s both';
        setTimeout(() => animateNumber(kasMasukEl, totalIn, 1500), 300);
    }
    
    if (kasKeluarEl) {
        kasKeluarEl.style.animation = 'fadeInUp 0.8s ease-out 0.2s both';
        setTimeout(() => animateNumber(kasKeluarEl, totalOut, 1500), 400);
    }

    // Render Table with staggered animation
    const sortedTransactions = transactions.sort((a, b) => new Date(b.date) - new Date(a.date)).slice(0, 5);
    
    sortedTransactions.forEach((t, index) => {
        const tr = document.createElement('tr');
        
        const badgeClass = t.type === 'in' ? 'status-in' : 'status-out';
        const statusText = t.type === 'in' ? 'Masuk' : 'Keluar';
        
        tr.innerHTML = `
            <td>${t.date}</td>
            <td>${t.desc}</td>
            <td style="font-weight: 700;">${formatRp(t.amount)}</td>
            <td><span class="status-badge ${badgeClass}">${statusText}</span></td>
        `;
        
        // Stagger animation
        tr.style.animation = `fadeInUp 0.5s ease-out ${0.1 * index}s both`;
        
        // Add hover effect
        tr.addEventListener('mouseenter', () => {
            tr.style.transform = 'translateX(4px)';
        });
        tr.addEventListener('mouseleave', () => {
            tr.style.transform = 'translateX(0)';
        });
        
        recentTransactionsBody.appendChild(tr);
    });
    
    // Add card hover animations
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.animation = `fadeInUp 0.6s ease-out ${0.15 * index}s both`;
        
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-12px) scale(1.03)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Hero section animation
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.style.animation = 'fadeInUp 0.7s ease-out';
    }
}

// Add refined event listeners for interactive elements
document.addEventListener('DOMContentLoaded', () => {
    // Theme Toggle Logic
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    if (themeToggle && themeIcon) {
        const currentTheme = localStorage.getItem('theme') || 'light';
        const setTheme = (theme) => {
            if (theme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeIcon.innerHTML = '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>';
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.removeAttribute('data-theme');
                themeIcon.innerHTML = '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>';
                localStorage.setItem('theme', 'light');
            }
        };
        setTheme(currentTheme);
        themeToggle.addEventListener('click', () => {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            setTheme(isDark ? 'light' : 'dark');
        });
    }

    // Sidebar Toggle Logic
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#logout' && href !== '#anggota' && href !== '#pengaturan') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });
    
    // Button ripple effect
    const buttons = document.querySelectorAll('.btn-small, .btn-primary, .logout-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                background: rgba(255,255,255,0.5);
                border-radius: 50%;
                left: ${x}px;
                top: ${y}px;
                pointer-events: none;
                animation: ripple 0.6s ease-out;
            `;
            
            if (!this.style.position || this.style.position === 'static') {
                this.style.position = 'relative';
            }
            
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
});

// Ripple animation
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
`;
document.head.appendChild(rippleStyle);

// Run auth check on load
checkAuth();
