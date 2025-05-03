# BookHaven - Modern Bookstore Management System

[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-orange.svg)](https://laravel.com)

![BookHaven Interface Preview](https://via.placeholder.com/800x400.png?text=BookHaven+Interface+Preview)

## Project Overview
BookHaven is a full-stack web application for managing book inventory, sales, and customer interactions. It features:
- 📚 Modern book catalog management
- 🛒 Interactive shopping cart
- 💳 Secure checkout system
- 🔍 Advanced search capabilities
- 📊 Inventory tracking
- 👤 User authentication system

## Key Features
### Core Functionality
- **User Authentication System**
  - Secure registration/login
  - Password reset functionality
  - Role-based access control

### Book Management
- CRUD operations for book inventory
- Book categorization system
- Inventory tracking with stock alerts
- Book details with cover images

### E-commerce Features
- Shopping cart persistence
- Multiple payment gateway integration
- Order history tracking
- Real-time stock updates

### Additional Features
- Responsive UI with dark/light themes
- Advanced search with filters
- Email notifications
- Sales analytics dashboard

## Technology Stack
**Backend**
- PHP 8.1+
- Laravel 12
- MySQL
- RESTful API

**Frontend**
- Bootstrap 5
- JavaScript (ES6+)
- Blade templating
- JavaScript for analytics

## Installation
```bash
# Clone repository
git clone https://github.com/yourusername/bookhaven.git
cd bookhaven

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate --seed

# Start development server
php artisan serve
```

## Configuration
Set these environment variables in `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookhaven
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null

PAYMENT_GATEWAY=stripe
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
```

## API Documentation
```http
GET /api/books
Authorization: Bearer <token>

POST /api/checkout
Content-Type: application/json
{
  "items": [
    {"book_id": 1, "quantity": 2}
  ],
  "payment_method": "credit_card"
}
```
## Acknowledgments
- Laravel community
- Bootstrap team
- Open library API
- DigitalOcean for hosting support
- OpenAI, DeepSeek, Claude Sonnet, and GitHub for inspiration and assistance
