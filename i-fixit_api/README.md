# I-fixit API

A Django REST Framework API for the I-fixit car investment tracking system. This API provides backend services for scraping auction websites and providing insights to the PHP Laravel application.

## Features

- RESTful API with N-tier architecture
- JWT authentication
- Web scraping using Selenium and BeautifulSoup
- Opportunity analysis and scoring
- User preference management
- Comprehensive API documentation

## Project Structure

The project follows an N-tier architecture with the following components:

1. **Models**: Database schema definitions
2. **Repositories**: Data access layer
3. **Services**: Business logic layer
4. **Serializers**: Data transformation layer
5. **Views/ViewSets**: API endpoints
6. **URLs**: Routing

## Installation

### Prerequisites

- Python 3.8+
- pip
- Virtual environment (recommended)

### Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/i-fixit-api.git
   cd i-fixit-api
   ```

2. Create and activate a virtual environment:
   ```bash
   python -m venv venv
   source venv/bin/activate  # On Windows: venv\Scripts\activate
   ```

3. Install dependencies:
   ```bash
   pip install -r requirements.txt
   ```

4. Apply migrations:
   ```bash
   python manage.py migrate
   ```

5. Create a superuser:
   ```bash
   python manage.py createsuperuser
   ```

6. Run the development server:
   ```bash
   python manage.py runserver
   ```

## API Endpoints

### Authentication

- `POST /api/v1/auth/login/`: Obtain JWT token
- `POST /api/v1/auth/refresh/`: Refresh JWT token
- `POST /api/v1/auth/verify/`: Verify JWT token

### Cars

- `GET /api/v1/cars/`: List cars with filtering and pagination
- `GET /api/v1/cars/{id}/`: Get detailed car information
- `POST /api/v1/cars/`: Create a new car record
- `PUT /api/v1/cars/{id}/`: Update car information
- `DELETE /api/v1/cars/{id}/`: Delete/archive a car
- `GET /api/v1/cars/{id}/parts/`: Get parts for a specific car
- `GET /api/v1/cars/{id}/financial-summary/`: Get financial summary for a specific car

### Opportunities

- `GET /api/v1/opportunities/`: List opportunities with filtering
- `GET /api/v1/opportunities/{id}/`: Get detailed opportunity information
- `POST /api/v1/opportunities/`: Create a new opportunity

### User Preferences

- `GET /api/v1/preferences/`: Get user preferences
- `POST /api/v1/preferences/`: Update user preferences
- `GET /api/v1/preferences/matching-opportunities/`: Get matching opportunities based on user preferences

## Web Scraping

The API includes functionality to scrape auction websites for potential car investment opportunities. The scraping is done using Selenium and BeautifulSoup, and the results are stored in the database as opportunities.

### Supported Auction Sites

- SMD Auctions
- Bidvest Auctions

## Documentation

API documentation is available at:

- Swagger UI: `/swagger/`
- ReDoc: `/redoc/`

## Testing

Run tests with:

```bash
python manage.py test
```

## License

This project is proprietary and confidential. Unauthorized copying, distribution, or use is strictly prohibited.

## Contact

For questions or support, please contact the project maintainers.
