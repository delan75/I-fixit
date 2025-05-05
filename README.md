# I-fixit

A web application for tracking car investments through bidding/purchase, repair/parts, and dealership/sale phases. The system provides detailed cost tracking, profitability analysis, and business insights to support future purchasing decisions.

## Project Overview

I-fixit is designed to help users track their car investments through three main phases:
1. **Bidding/Purchase**: Track acquisition costs and initial condition
2. **Repair/Parts**: Monitor repair costs, parts inventory, and labor expenses
3. **Dealership/Sale**: Record sale prices, profit margins, and market performance

## Technology Stack

- **Backend**: Laravel 10 (PHP 8.2+)
- **Database**: MySQL
- **Frontend**: Laravel Blade with Tailwind CSS
- **Authentication**: Laravel Breeze with OTP and email/password options
- **UI Design**: Based on Motiv template with green color scheme

## Live Demo

The application is live at [https://i-fixit.chisolution.io](https://i-fixit.chisolution.io)

## Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js and NPM
- MySQL

### Local Development Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/delan75/I-fixit.git
   cd I-fixit
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Create environment file:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. Run migrations:
   ```bash
   php artisan migrate
   ```

8. Build assets:
   ```bash
   npm run dev
   ```

9. Start the development server:
   ```bash
   php artisan serve
   ```

## Deployment

For detailed deployment instructions, see [DEPLOYMENT.md](DEPLOYMENT.md).

## Features

- **User Authentication**: Email/password and OTP-based authentication
- **Dashboard**: Overview of investments, costs, and profits
- **Vehicle Management**: Track vehicles through the investment lifecycle
- **Cost Tracking**: Detailed breakdown of all expenses
- **Profit Analysis**: Calculate ROI and profit margins
- **Reporting**: Generate reports and export data

## Project Structure

The project follows the standard Laravel directory structure with some customizations:

- `app/` - Contains the core code of the application
- `config/` - Configuration files
- `database/` - Database migrations and seeders
- `public/` - Publicly accessible files
- `resources/` - Views, raw assets, and language files
- `routes/` - Application routes
- `storage/` - Application storage
- `tests/` - Test files
- `_template/` - Original template files for reference

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Submit a pull request

## License

This project is licensed under the MIT License.
