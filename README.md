# E-commerce Backend with Laravel

This repository contains the backend implementation for an e-commerce platform built using Laravel, a powerful PHP framework. The backend provides RESTful APIs to manage products, orders, users, and other essential e-commerce functionalities.

## Frontend
- [Frontend](https://github.com/MohamedHamed12/front-end-e-commerce)

## Features

- **User Authentication**: Secure user registration, login, and password management using Laravel Sanctum for API authentication.
- **Product Management**: CRUD operations for products, including categories, inventory, and product details.
- **Order Management**: Create, update, and track orders with status updates.
- **Shopping Cart**: Manage user carts, including adding/removing products and calculating totals.
- **Payment Integration**: Support for integrating payment gateways (e.g., Stripe, PayPal).
- **Search and Filtering**: Advanced search and filtering options for products.
- **Admin Panel**: Role-based access control (RBAC) for admin users to manage the platform.
- **API Documentation**: Comprehensive API documentation using tools like Swagger or Postman.

## Requirements

- PHP >= 8.0
- Composer
- MySQL or any supported database
- Laravel >= 9.x
- Node.js and NPM (for frontend assets if needed)

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/MohamedHamed12/laravel-ecommerce.git
   cd laravel-ecommerce
   ```



2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Run migrations and seeders**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Start the server**:
   ```bash
   php artisan serve
   ```

## Usage

1. **Access the API documentation**:
   ```bash
   http://localhost:8000/api/docs
   ```

2. **Interact with the API**:
   ```bash
   http://localhost:8000/api/products
   ```

## Contributing

Contributions are welcome! Please follow the [Contributing Guidelines](CONTRIBUTING.md).

## License

This project is licensed under the [MIT License](LICENSE).