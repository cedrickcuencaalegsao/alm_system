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

### Mail (Mailtrap) — Email testing setup
To test outgoing emails during development, we recommend using Mailtrap. Create a free account at https://mailtrap.io and get the SMTP credentials for your inbox. Then set these values in your project's `.env` file:

```ini
# Mailtrap SMTP settings (development/testing)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
# Use null or tls depending on Mailtrap inbox settings
MAIL_ENCRYPTION=null

# Recommended from address
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="BookHaven"
```

Notes:
- Replace `your_mailtrap_username` and `your_mailtrap_password` with the credentials shown in your Mailtrap inbox settings.
- If you prefer a different port, Mailtrap also supports 465 and 587 depending on your plan; use the port shown in your Mailtrap dashboard.

How to test emails:
- Visit Mailtrap inbox (web) to inspect captured emails.
- From the app you can trigger an email (for example, register a new user or use password reset) and verify it appears in Mailtrap.
- Send a quick test using tinker:

```bash
php artisan tinker
\Pest\TestSuite::app()?->call('GET', '/');
# or a simple Mail send example in tinker:
use Illuminate\Support\Facades\Mail;
Mail::raw('Test Mail', function($m){ $m->to('test@example.com')->subject('Test'); });
```

- Run your test suite that includes mail assertions (if available):

```bash
php artisan test
```

If you want to use Mailhog locally instead, switch `MAIL_HOST`/`MAIL_PORT` to your Mailhog instance (e.g., `mailhog:1025`) as shown earlier.

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
