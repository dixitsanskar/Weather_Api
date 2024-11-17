# Weather API Project

This project is a simple weather API built using Laravel. It allows users to register, log in, and obtain a unique API key. Users can make up to **100 requests per month** to fetch weather data for a specific city.

---

## Features
- **User Registration and Login**: Users can register and log in to access their API key.
- **API Key Management**: Each user is assigned a unique API key upon registration, viewable after login.
- **Weather Data Retrieval**: Fetch weather information for a specific city using the `api/api/weather/{city}` endpoint.
- **Rate Limiting**: Each user is limited to 100 requests per month.
- **Error Handling**: Gracefully handles errors, including invalid city names and API downtime.
- **Database Request Logging**: Tracks and limits API requests per user using the database.

---

## Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or PostgreSQL
- Redis (optional)
- Laravel

### Steps to Install
1. Clone the repository:
   
bash
   git clone https://github.com/dixitsanskar/Weather_Api.git
   cd weather-api
  

2. Install dependencies:
   
bash
   composer install
  

3. Set up the environment:
   - Copy `.env.example` to `.env`:
     
bash
     cp .env.example .env
    
   - Configure database, Redis (optional), and API keys in the `.env` file:
     
env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=weather_api
     DB_USERNAME=root
     DB_PASSWORD=

     WEATHER_API_KEY=your_visual_crossing_api_key
     WEATHER_API_URL=https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/
    

4. Run migrations:
   
bash
   php artisan migrate
  

5. Start the Laravel development server:
   
bash
   php artisan serve
  

---

## API Endpoints

### 1. User Registration
- **Endpoint**: `POST api/api/register`
- **Description**: Register a new user and generate an API key.
- **Parameters**:
  - `name` (string)
  - `email` (string)
  - `password` (string)

### 2. User Login
- **Endpoint**: `POST api/api/login`
- **Description**: Log in to retrieve a Sanctum token.

### 3. View API Key
**Endpoint**: `POST api/api/login`
- **Description**: Log in to retrieve a Sanctum token.

### 4. Fetch Weather Data
- **Endpoint**: `GET api/api/weather/{city}`
- **Description**: Retrieve weather data for the specified city.
- **Headers**:
  - `Authorization: Bearer <api_key>`
- **Rate Limit**: 100 requests per user per month.

---

## Project URL
The live project can be accessed at: https://weather-api-omega-eight.vercel.app/

---


## License
This project is licensed under the MIT License.


