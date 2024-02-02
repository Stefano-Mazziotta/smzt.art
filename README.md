# Photography Website Backend - Laravel

Welcome to the backend repository of my photography website, built with Laravel. This backend is designed to provide secure endpoints for uploading and optimizing pictures, creating new albums, and managing metadata. These services are intended to be utilized by your private dashboard frontend, allowing you to efficiently administer public content on your photography website.

## Table of Contents

-   [Getting Started](#getting-started)
    -   [Prerequisites](#prerequisites)
    -   [Installation](#installation)
-   [Features](#features)
    -   [1. Picture Upload and Optimization](#1-picture-upload-and-optimization)
    -   [2. Album Creation](#2-album-creation)
    -   [3. Metadata Management](#3-metadata-management)
-   [Usage](#usage)
    -   [Authentication](#authentication)
    -   [Endpoints](#endpoints)
-   [Contributing](#contributing)
-   [License](#license)

## Getting Started

### Prerequisites

Before you begin, ensure that you have the following dependencies installed:

-   PHP (>= 7.4)
-   Composer
-   MySQL or any other compatible database
-   Laravel CLI

### Installation

1. Clone this repository:

    ```bash
    git clone https://github.com/stefano-mazziotta/smzt.art.git
    ```

2. Install the project dependencies:

    ```cd photography-backend
    composer install
    ```

3. Copy the .env.example file to create a new .env file:

    ```
    cp .env.example .env
    ```

4. Configure the database connection and other settings in the .env file.

5. Generate the application key:

    ```
    php artisan key:generate
    ```

6. Run the database migrations and seed the database:

    ```
    php artisan migrate --seed
    ```

7. Start the Laravel development server:

    ```
    php artisan serve
    ```

Now, your backend is up and running!

## Features

1. Picture Upload and Optimization </br>
   The backend provides a secure endpoint for uploading pictures. Uploaded pictures are automatically optimized for performance.

2. Album Creation </br>
   You can create new albums using dedicated endpoints. Each album can be associated with a collection of pictures.

3. Metadata Management </br>
   Manage metadata for pictures and albums, including titles, descriptions, and tags.

## Usage

To access the protected endpoints, authentication is required. Use the provided authentication tokens in your private dashboard frontend to make requests.

Endpoints
Detailed documentation for each endpoint can be found in the docs folder. It includes information on request formats, parameters, and expected responses.

## Contributing

Contributing
We welcome contributions! If you find any issues or have suggestions for improvement, please open an issue or create a pull request.

## License

Working on it

## Useful links

https://medium.com/@tsubasakondo_36683/make-laravel-api-only-2da47a0f92b7
https://www.youtube.com/watch?v=BVNgCzt2pjY

https://medium.com/@antoine.lame/which-laravel-authentication-package-to-choose-290551a82a44
https://laravel.com/docs/10.x/passport#main-content

https://github.com/thephpleague/oauth2-server
https://oauth2.thephpleague.com/

https://github.com/laravel/breeze-next
https://laravel.com/docs/10.x/starter-kits#breeze-and-next
https://www.youtube.com/watch?v=s_7Pw0ACGGw&t=42s

https://www.youtube.com/watch?v=fsiPXKzcH2M

https://laravel.com/docs/10.x/eloquent-relationships#one-to-many

https://www.iankumu.com/blog/laravel-one-to-many-relationship/

https://stackoverflow.com/questions/45269146/laravel-seeding-many-to-many-relationship
