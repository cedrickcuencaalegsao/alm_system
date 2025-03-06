# ALM Project

This project consists of two main parts:

- Backend: Laravel API (`ALMbackend`)
- Frontend: React application (`almfrontend`)

## Prerequisites

- PHP 8.x
- Composer
- Node.js & npm
- SQLite (or your preferred database)

## Backend Setup (Laravel)

1. Clone the repository:
   ```bash
   git clone https://github.com/cedrickcuencaalegsao/alm_system.git
   cd backend
   ```
2. Install dependencies:
   ```bash
   composer update
   composer install
   ```
3. Set up your `.env` file:

   ```bash
   cp .env.example .env

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=almbackend
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Run the Seeder(note fake data are not available for now):
   ```bash
   php -d memory_limit=1024M artisan db:seed --class=SystemSeeder
   php artisan db:seed --class=SystemSeeder
   ```
7. Run the Server:
   ```bash
   php artisan serve
   ```
   or run the server on you local network
   ```bash
   php artisan serve --host=0.0.0.0
   ```

### Frontend (React.js)

1. Navigate to the frontend directory:
   ```bash
   cd frontend
   ```
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start the development server:
   ```bash
   npm start
   ```

## Usage

- Access the web application at `http://localhost:3000` (react.js).
- The Laravel API will be available at `http://192.168.1.4:8000/api/{endpoints}` and testable on postman application.
- The Laravel Blade will be available at `http://192.168.1.4:8000`.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Open a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
