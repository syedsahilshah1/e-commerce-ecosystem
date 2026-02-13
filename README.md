# NOBLER - Premium E-commerce Platform 💎

NOBLER is a high-end, full-stack e-commerce application built with **Laravel 12**. Designed for luxury fashion and premium electronics, it features a sophisticated dark-mode aesthetic, unique Bento-style collections, and a robust multi-role architecture.

![NOBLER Preview](https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80)

## ✨ Premium Features

-   **🎨 Aesthetic Web Design**: Advanced glassmorphism, dynamic mesh backgrounds, and smooth micro-animations.
-   **🍱 Bento Collections**: A unique, asymmetric grid layout for category browsing.
-   **🔐 Multi-Role System**: Dedicated environments for:
    -   **Customers**: Order tracking, 5-step progress bars, and automated return requests.
    -   **Providers (Vendors)**: Product management, sales analytics, and return approval workflow.
    -   **Admins**: Full platform oversight and user management.
-   **⚡ Turbo Integration**: High-performance, SPA-like navigation using Turbo.js.
-   **🌖 Smart Theme Engine**: Persistent Dark/Light mode toggle with unified CSS variables.
-   **🛍️ Sunday Flash Sales**: A specialized wholesale-price window every Sunday with real-time countdown.
-   **💬 AI Support Chatbot**: Integrated floating assistant for instant customer queries.
-   **📦 Order Lifecycle**: Complete flow from dynamic cart -> secure checkout -> real-time delivery tracking.

## 🚀 Tech Stack

-   **Backend**: Laravel 12.x (PHP 8.2)
-   **Frontend**: Blade Templates, Vanilla CSS (Modern CSS3 Variables)
-   **Interactions**: Alpine.js / Turbo.js
-   **Database**: MySQL
-   **Icons**: FontAwesome 6 (Pro-grade integration)

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL

### Step-by-Step Guide

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/yourusername/nobler-ecommerce.git
    cd nobler-ecommerce
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Environment Configuration:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your DB settings in `.env`*

4.  **Database Migration & Seeding:**
    ```bash
    php artisan migrate --seed
    ```

5.  **Run Locally:**
    ```bash
    php artisan serve
    ```
    *Visit: `http://127.0.0.1:8000`*

## 📁 Project Structure Highlights

-   `/resources/views/customer`: Order tracking and customer specific logic.
-   `/resources/views/provider`: Vendor dash with sale management.
-   `/resources/views/layouts/app.blade.php`: The core design system and theme engine.
-   `/app/Http/Controllers`: Lightweight controllers for high-performance routing.

## ⚖️ License

Distributed under the MIT License. See `LICENSE` for more information.

---
Created with ❤️ by **syedDev** - *Crafting Premium Digital Experiences.*
