# Laravel RESTful API

a RESTful API using Laravel includes authentication, store database into database and manage external API

## Table of Contents
- [Requirements](#requirements)
- [Installation](#installation)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)
- [Screenshot](#screenshot)
---

## Requirements

Before setting up the project, make sure your system meets the following requirements:

- **PHP**: 8.2 or higher
- **Laravel**: 10.x
- **MySQL**:  5.7
- **Composer**: PHP dependency manager

---

## Installation

Follow the steps below to set up the project on your local machine.

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Devajayantha/jb-api-test
    ```

2. **Navigate into the project directory**:
    ```bash
    cd jb-api-test
    ```

3. **Install the required dependencies** using Composer:
    ```bash
    composer install
    ```

4. **Copy the `.env.example` file to `.env`**:
    ```bash
    cp .env.example .env
    ```

5. **Generate the application key**:
    ```bash
    php artisan key:generate
    ```

6. **Set up the database**:
    - Configure your database connection in the `.env` file.
    - Run migrations to create the necessary tables:
      ```bash
      php artisan migrate
      ```

7. **Set up your OpenWeather API key in `.env`**:

Currently, I am using the **openweathermap** API to fetch weather data. You can get your own API key by signing up on their website  [OpenWeather API](https://openweathermap.org/api). More details [WEATHER_API.md](./WEATHER_API.md)

    ```env
    WEATHER_API_KEY=your-api-key-here
    ```

8. **Start the local development server**:
    ```bash
    php artisan serve
    ```

Your Laravel application will be running at `http://localhost:8000`.

---

### Setting Up Queues:
For background jobs (e.g., fetching weather data periodically), run the queue worker:

```bash
php artisan queue:work
```

It can also be run alongside this command if you want to run the job manually.

```bash
php artisan app:dispatch-weather-scheduler
```

## API Endpoints
Currently, I am utilizing the version specified in the API URL. This approach allows for better version management.

The following API endpoints are available:

| **Method** | **Endpoint**                          | **Description**                                           | **Parameters**                                     |
|------------|---------------------------------------|-----------------------------------------------------------|---------------------------------------------------|
| `POST`     | `/api/v1/register`                   | Register a new user for the app.                          | `name` (string), `email` (string), `password` (string) |
| `POST`     | `/api/v1/login`                      | Log in a user and return an authentication token.         | `email` (string), `password` (string)             |
| `GET`      | `/api/v1/users/user`                 | Get details of the authenticated user.                    | Authorization header with `Bearer token`          |
| `GET`      | `/api/v1/users`                      | List all users.                                           | `limit` (int), `search` (string, optional)        |
| `POST`     | `/api/v1/logout`                     | Log out the user and invalidate the token.                | Authorization header with `Bearer token`          |
| `POST`     | `/api/v1/posts`                      | Create a new post for an authenticated user.              | `title` (string), `content` (string), `is_active` (boolean) |
| `PATCH`    | `/api/v1/posts/{post}`                | Update an existing post by ID.                            | `title` (string), `content` (string), `is_active` (boolean) |
| `GET`      | `/api/v1/posts/{post}`                | View the details of a specific post.                      | `post` (int) - Post ID                            |
| `DELETE`   | `/api/v1/posts/{post}`                | Delete a post by ID.                                      | `post` (int) - Post ID                            |
| `GET`      | `/api/v1/posts`                       | List posts owned by the authenticated user.               | `limit` (int), `search` (string, optional)        |
| `GET`      | `/api/v1/current-weather`             | Get the current weather details.                          | None                                              |

---

#### Example Usage:

1. **Register a New User**:
   To register a new user, make a `POST` request to `/api/v1/register`.

   Example:
   ```bash
   curl -X POST http://localhost:8000/api/v1/register \
     -d "name=John Doe&email=john@example.com&password=password123"

## Testing

This project uses **PHPUnit** for testing.

To run all the tests, use the following command:

```bash
php artisan test
```
## Screenshot

Here’s some screenshoot from my work.

![Screenshot](https://devajayantha.github.io/assets/image-jb/image_4.png)

![Screenshot](https://devajayantha.github.io/assets/image-jb/image_1.png)

![Screenshot](https://devajayantha.github.io/assets/image-jb/image_2.png)

![Screenshot](https://devajayantha.github.io/assets/image-jb/image_3.png)

![Screenshot](https://devajayantha.github.io/assets/image-jb/image_5.png)

![Screenshot](https://devajayantha.github.io/assets/image-jb/image_6.png)

### Thank You
