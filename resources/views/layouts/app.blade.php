<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NOBLER - Premium E-commerce Store. Discover luxury fashion, electronics, and accessories.">
    <title>NOBLER - @yield('title', 'Premium Store')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Turbo.js for smooth navigation -->
    <script src="https://unpkg.com/@hotwired/turbo@7.3.0/dist/turbo.es2017-umd.js" defer></script>
    <style>
        :root {
            --primary: #7c3aed;
            --primary-light: #a78bfa;
            --primary-dark: #6d28d9;
            --secondary: #f43f5e;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --bg: #0a0a0f;
            --bg-secondary: #111118;
            --card-bg: #16161d;
            --card-bg-hover: #1c1c25;
            --text-main: #f0f0f5;
            --text-secondary: #c4c4d0;
            --text-muted: #6b6b80;
            --border: #2a2a3a;
            --border-light: #3a3a4a;
            --glass: rgba(22, 22, 29, 0.85);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            --shadow-glow: 0 0 40px rgba(124, 58, 237, 0.15);
            --gradient-primary: linear-gradient(135deg, #7c3aed, #a78bfa);
            --gradient-card: linear-gradient(145deg, #16161d, #1c1c25);
            --radius: 16px;
            --radius-sm: 10px;
            --radius-xs: 6px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        /* ===== HEADER / NAVBAR ===== */
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 5%;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-main);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.5px;
        }

        .logo i {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.6rem;
        }

        nav { display: flex; gap: 0.5rem; }

        nav a {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-xs);
            transition: all 0.2s ease;
        }

        nav a:hover, nav a.active {
            color: var(--text-main);
            background: rgba(124, 58, 237, 0.1);
        }

        .nav-icons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .nav-icons a,
        .nav-icons button {
            color: var(--text-secondary);
            position: relative;
            text-decoration: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-xs);
            transition: all 0.2s;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .nav-icons a:hover,
        .nav-icons button:hover {
            color: var(--text-main);
            background: rgba(124, 58, 237, 0.1);
        }

        .cart-badge {
            position: absolute;
            top: 4px;
            right: 2px;
            background: var(--secondary);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
        }

        /* ===== MOBILE NAV ===== */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-main);
            font-size: 1.3rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        @media (max-width: 768px) {
            .mobile-toggle { display: block; }
            nav {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: var(--bg-secondary);
                border-bottom: 1px solid var(--border);
                flex-direction: column;
                padding: 1rem;
                transform: translateY(-110%);
                transition: transform 0.3s ease;
                z-index: 999;
            }
            nav.open { transform: translateY(0); }
        }

        /* ===== MAIN ===== */
        main {
            min-height: calc(100vh - 70px);
            padding: 2rem 5%;
        }

        /* ===== BUTTONS ===== */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            border: 1px solid transparent;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-main);
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(124, 58, 237, 0.05);
        }

        .btn-ghost {
            background: rgba(124, 58, 237, 0.1);
            color: var(--primary-light);
            border: none;
        }

        .btn-ghost:hover {
            background: rgba(124, 58, 237, 0.2);
        }

        .btn-danger {
            background: rgba(244, 63, 94, 0.1);
            color: var(--secondary);
            border: none;
        }

        .btn-danger:hover {
            background: rgba(244, 63, 94, 0.2);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        /* ===== SECTION ===== */
        .section-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .section-subtitle {
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            font-size: 1rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header .section-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--gradient-primary);
            margin: 12px auto 0;
            border-radius: 2px;
        }

        /* ===== PRODUCT GRID ===== */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-6px);
            border-color: var(--border-light);
            box-shadow: var(--shadow), var(--shadow-glow);
        }

        .product-card .product-image {
            height: 280px;
            background: var(--bg-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .product-card .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-card .product-image .placeholder-icon {
            font-size: 3rem;
            color: var(--text-muted);
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--secondary);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-info {
            padding: 1.25rem;
        }

        .product-category {
            font-size: 0.75rem;
            color: var(--primary-light);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.4rem;
            display: block;
        }

        .product-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .product-name a {
            text-decoration: none;
            color: inherit;
            transition: color 0.2s;
        }

        .product-name a:hover {
            color: var(--primary-light);
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 0.75rem;
            font-size: 0.8rem;
        }

        .product-rating .stars {
            color: var(--warning);
        }

        .product-rating .count {
            color: var(--text-muted);
        }

        .product-price-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .current-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .old-price {
            font-size: 0.9rem;
            text-decoration: line-through;
            color: var(--text-muted);
        }

        .discount-tag {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--success);
            background: rgba(16, 185, 129, 0.1);
            padding: 2px 8px;
            border-radius: 4px;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
        }

        .card-actions .btn { flex: 1; }

        .card-actions .btn-icon {
            width: 42px;
            flex: none;
            padding: 0;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .alert-error {
            background: rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(244, 63, 94, 0.2);
            color: var(--secondary);
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--bg-secondary);
            padding: 4rem 5% 2rem;
            border-top: 1px solid var(--border);
            margin-top: 6rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-grid h4 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 1.2rem;
        }

        .footer-grid ul {
            list-style: none;
        }

        .footer-grid ul li { margin-bottom: 0.6rem; }

        .footer-grid ul li a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-grid ul li a:hover {
            color: var(--primary-light);
        }

        .footer-brand p {
            color: var(--text-muted);
            margin-top: 1rem;
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .footer-socials {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .footer-socials a {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.85rem;
        }

        .footer-socials a:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(124, 58, 237, 0.1);
        }

        .footer-bottom {
            border-top: 1px solid var(--border);
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate { animation: fadeInUp 0.6s ease forwards; }
        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }

        /* ===== FORM ELEMENTS ===== */
        .form-group { margin-bottom: 1.25rem; }

        .form-group label {
            display: block;
            font-weight: 500;
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-xs);
            color: var(--text-main);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            main { padding: 1.5rem 4%; }
            .product-grid { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
            .section-title { font-size: 1.6rem; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <header>
        <a href="/" class="logo">
            <i class="fas fa-gem"></i> NOBLER
        </a>

        <button class="mobile-toggle" onclick="document.querySelector('nav').classList.toggle('open')" aria-label="Toggle Menu">
            <i class="fas fa-bars"></i>
        </button>

        <nav>
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/shop" class="{{ request()->is('shop*') ? 'active' : '' }}">Shop</a>
            <a href="/categories" class="{{ request()->is('categories*') || request()->is('category*') ? 'active' : '' }}">Categories</a>
            <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}" style="color: var(--secondary);">Admin</a>
                @elseif(auth()->user()->isProvider())
                    <a href="{{ route('provider.dashboard') }}" class="{{ request()->routeIs('provider.*') ? 'active' : '' }}" style="color: var(--primary-light);">Dashboard</a>
                @else
                    <a href="{{ route('customer.dashboard') }}" class="{{ request()->is('customer/dashboard') ? 'active' : '' }}">My Orders</a>
                @endif
            @endauth
        </nav>

        <div class="nav-icons">
            <button id="theme-toggle" title="Toggle Theme" style="font-size: 1.1rem; color: var(--warning);">
                <i class="fas fa-moon"></i>
            </button>
            <a href="/search" title="Search"><i class="fas fa-search"></i></a>
            <a href="/cart" title="Cart">
                <i class="fas fa-shopping-bag"></i>
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>
            @auth
                <a href="{{ route('profile.edit') }}" title="My Profile"><i class="fas fa-user-cog"></i></a>
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            @else
                <a href="/login" title="Login"><i class="fas fa-user-circle"></i></a>
            @endauth
        </div>
    </header>

    <!-- FLOATING AI CHATBOT -->
    <div id="chatbot-container" style="position: fixed; bottom: 30px; right: 30px; z-index: 9999; font-family: 'Inter', sans-serif;">
        <button id="chatbot-toggle" style="width: 60px; height: 60px; border-radius: 50%; background: var(--gradient-primary); color: white; border: none; cursor: pointer; box-shadow: 0 10px 25px rgba(124, 58, 237, 0.4); display: flex; align-items: center; justify-content: center; transition: all 0.3s; font-size: 1.5rem;">
            <i class="fas fa-comment-dots"></i>
        </button>
        
        <div id="chatbot-window" style="display: none; position: absolute; bottom: 80px; right: 0; width: 350px; background: var(--card-bg); border: 1px solid var(--border); border-radius: 20px; box-shadow: var(--shadow); overflow: hidden; flex-direction: column; animation: fadeInUp 0.3s ease;">
            <div style="background: var(--gradient-primary); padding: 1.5rem; color: white;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; border: 2px solid white;"></div>
                        <span style="font-weight: 700; font-size: 1rem;">NOBLER Support</span>
                    </div>
                    <button id="chatbot-close" style="background: none; border: none; color: white; cursor: pointer; font-size: 1.2rem;">&times;</button>
                </div>
                <p style="font-size: 0.75rem; opacity: 0.8; margin-top: 5px;">Always here to help you shop better.</p>
            </div>
            
            <div id="chatbot-messages" style="height: 300px; padding: 1.25rem; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem;">
                <div style="background: var(--bg); padding: 0.8rem 1rem; border-radius: 12px 12px 12px 0; font-size: 0.85rem; max-width: 85%; align-self: flex-start; color: var(--text-secondary);">
                    Hi there! I'm your NOBLER assistant. How can I help you today?
                </div>
            </div>
            
            <div style="padding: 1.25rem; border-top: 1px solid var(--border); display: flex; gap: 10px;">
                <input type="text" id="chatbot-input" placeholder="Type a message..." style="flex: 1; padding: 0.6rem 1rem; background: var(--bg); border: 1px solid var(--border); border-radius: 50px; color: var(--text-main); font-size: 0.85rem; outline: none;">
                <button id="chatbot-send" style="width: 35px; height: 35px; border-radius: 50%; background: var(--primary); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-paper-plane" style="font-size: 0.8rem;"></i>
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="padding: 0 5%;">
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 0 5%;">
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        </div>
    @endif

    @yield('content')

    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="/" class="logo" style="margin-bottom: 0.5rem;">
                    <i class="fas fa-gem"></i> NOBLER
                </a>
                <p>Discover premium fashion and cutting-edge electronics. Quality meets elegance in every product we curate.</p>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
            <div>
                <h4>Shop</h4>
                <ul>
                    <li><a href="/category/clothing">Clothing</a></li>
                    <li><a href="/category/electronics">Electronics</a></li>
                    <li><a href="/category/accessories">Accessories</a></li>
                    <li><a href="/shop">All Products</a></li>
                </ul>
            </div>
            <div>
                <h4>Company</h4>
                <ul>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4>Support</h4>
                <ul>
                    <li><a href="/help-center">Help Center</a></li>
                    <li><a href="/shipping">Shipping Info</a></li>
                    <li><a href="/customer/dashboard">Returns</a></li>
                    <li><a href="mailto:support@nobler.com">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} NOBLER. All rights reserved.</span>
            <span>Created by <b>syedDev</b> | Crafted with <i class="fas fa-heart" style="color: var(--secondary); font-size: 0.75rem;"></i> for premium shopping</span>
        </div>
    </footer>

    <script>
        // Auto-dismiss alerts
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                alert.style.transition = 'all 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            }, 4000);
        });

        // Global Theme State
        window.isDark = localStorage.getItem('theme') !== 'light';

        function applyTheme() {
            const root = document.documentElement;
            const themeToggle = document.getElementById('theme-toggle');
            
            if (window.isDark) {
                root.style.setProperty('--bg', '#0a0a0f');
                root.style.setProperty('--bg-secondary', '#111118');
                root.style.setProperty('--card-bg', '#16161d');
                root.style.setProperty('--card-bg-hover', '#1c1c25');
                root.style.setProperty('--text-main', '#f0f0f5');
                root.style.setProperty('--text-secondary', '#c4c4d0');
                root.style.setProperty('--text-muted', '#6b6b80');
                root.style.setProperty('--border', '#2a2a3a');
                root.style.setProperty('--border-light', '#3a3a4a');
                root.style.setProperty('--glass', 'rgba(22, 22, 29, 0.85)');
                if (themeToggle) {
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                    themeToggle.style.color = '#f59e0b';
                }
                localStorage.setItem('theme', 'dark');
            } else {
                root.style.setProperty('--bg', '#f9fafb');
                root.style.setProperty('--bg-secondary', '#ffffff');
                root.style.setProperty('--card-bg', '#ffffff');
                root.style.setProperty('--card-bg-hover', '#f3f4f6');
                root.style.setProperty('--text-main', '#111827');
                root.style.setProperty('--text-secondary', '#4b5563');
                root.style.setProperty('--text-muted', '#9ca3af');
                root.style.setProperty('--border', '#e5e7eb');
                root.style.setProperty('--border-light', '#f3f4f6');
                root.style.setProperty('--glass', 'rgba(255, 255, 255, 0.85)');
                if (themeToggle) {
                    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                    themeToggle.style.color = '#1e1b4b';
                }
                localStorage.setItem('theme', 'light');
            }
        }

        // Initialize on load
        applyTheme();

        // Handle page navigations and interactions
        document.addEventListener('turbo:load', () => {
            applyTheme();
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                // Remove any existing listeners to prevent duplicates
                themeToggle.replaceWith(themeToggle.cloneNode(true));
                const newToggle = document.getElementById('theme-toggle');
                newToggle.addEventListener('click', () => {
                    window.isDark = !window.isDark;
                    applyTheme();
                });
            }
        });

        // Chatbot Logic
        function initChatbot() {
            const cbToggle = document.getElementById('chatbot-toggle');
            const cbWindow = document.getElementById('chatbot-window');
            const cbClose = document.getElementById('chatbot-close');
            const cbInput = document.getElementById('chatbot-input');
            const cbSend = document.getElementById('chatbot-send');
            const cbMessages = document.getElementById('chatbot-messages');

            if (!cbToggle) return;

            cbToggle.addEventListener('click', () => {
                cbWindow.style.display = cbWindow.style.display === 'none' ? 'flex' : 'none';
            });

            cbClose.addEventListener('click', () => {
                cbWindow.style.display = 'none';
            });

            cbSend.addEventListener('click', handleChat);
            cbInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') handleChat(); });
        }

        document.addEventListener('turbo:load', initChatbot);

        function addMessage(text, isUser = false) {
            const cbMessages = document.getElementById('chatbot-messages');
            if (!cbMessages) return;
            const msg = document.createElement('div');
            msg.style.cssText = isUser 
                ? 'background: var(--primary); padding: 0.8rem 1rem; border-radius: 12px 12px 0 12px; font-size: 0.85rem; max-width: 85%; align-self: flex-end; color: white;'
                : 'background: var(--bg); padding: 0.8rem 1rem; border-radius: 12px 12px 12px 0; font-size: 0.85rem; max-width: 85%; align-self: flex-start; color: var(--text-secondary); border: 1px solid var(--border);';
            msg.innerHTML = text; // Changed to innerHTML to support links
            cbMessages.appendChild(msg);
            cbMessages.scrollTop = cbMessages.scrollHeight;
        }

        function handleChat() {
            const val = cbInput.value.trim();
            if(!val) return;
            addMessage(val, true);
            cbInput.value = '';

            setTimeout(() => {
                let response = "I'm currently processing your request. How else can I help you today?";
                const lower = val.toLowerCase();
                if(lower.includes('order')) response = "You can track your orders in the 'My Orders' section of your dashboard.";
                else if(lower.includes('ship')) response = "We offer premium shipping worldwide. Details can be found on our <a href='/shipping' style='color:white;text-decoration:underline;'>Shipping Info</a> page.";
                else if(lower.includes('help') || lower.includes('center')) response = "Visit our <a href='/help-center' style='color:white;text-decoration:underline;'>Help Center</a> for FAQs and support articles.";
                else if(lower.includes('return')) response = "You can request a return for delivered orders directly from your <a href='/customer/dashboard' style='color:white;text-decoration:underline;'>Dashboard</a>.";
                else if(lower.includes('creator') || lower.includes('dev')) response = "I was created by syedDev, a lead developer dedicated to premium experiences.";
                
                addMessage(response);
            }, 1000);
        }

        cbSend.addEventListener('click', handleChat);
        cbInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') handleChat(); });
    </script>
    @yield('scripts')
</body>
</html>
