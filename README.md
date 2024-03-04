# Laravel Incidence Manager

## Description

This repository hosts a Laravel-based web application tailored for efficient incident management within municipalities. It offers user-friendly interfaces for incident tracking, reporting, and analysis, empowering municipal authorities to enhance community service and resource allocation.

## Features

### Dashboard
- Users are greeted with a dashboard upon accessing the web application, tailored to their roles.
- Normal Users:
  - Simple navigation bar providing quick access to essential functions:
    - Login as Administrator: Access to a broader set of administrative functions.
    - Create Incident: Ability to anonymously create incidents for prompt resolution.
    - Change website language.
- Administrators:
  - Side navigation menu granting full control over management functions:
    - Home: Main system page.
    - User Control: Facilitates user and role management.
    - Incident Management: Provides comprehensive view and tools for managing incidents.
    - Category Management: Register and edit categories for efficient classification.
    - Company Management: Register and edit associated companies.
    - Additional Options: Includes specific functions as per administrator requirements.

### User Administration
- User management system configured to restrict access to the administration menu to unauthorized users and those with specific privileges.
- User Creation:
  - Form fields include Name, Phone, Email, Password, User Role, and Association with Company.
- User Control Panel:
  - Provides comprehensive overview of registered users in the database.
  - Features a table with user information and options to edit or delete users.

### Incident Management
- Incident Creation:
  - Form for gathering information about a new incident including Personal Information, Attachment of Images, Category Selection, Description, Location, Privacy Policies, and Captcha for human interaction validation.
- Incident Control Panel:
  - Offers a basic view of incidents registered in the database with visual indicators for their status.
  - Provides filtering options and details view for each incident.

### Category Management
- Category Registration:
  - Form for registering categories including Name in multiple languages and Association with Companies.
- Category Control Panel:
  - Presents a complete view of registered categories with options to edit or delete categories.

### Company Management
- Company Registration:
  - Form for registering companies including Name, CIF, Phone, Activity, Address, Email, and Association with Categories.
- Company Control Panel:
  - Displays registered companies with options to edit or delete companies.

## Installation

### Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) installed on your system.
- [Composer](https://getcomposer.org/) installed on your system.
- [Node.js](https://nodejs.org/en) and npm installed on your system.

### Steps
To run this project locally, follow these steps:

1. Clone the repository to your local machine using `git clone`.
2. Navigate to the project directory.
3. Install PHP dependencies using `composer install`.
4. Install JavaScript dependencies using `npm install`. 
5. Copy the .env.example file to .env:
   
   ```bash
   cp .env.example .env
   
6. Generate the application key:
   
    ```bash
   php artisan key:generate
    
7. Configure the .env file with your database connection details. Make sure to set the database name as "webincidencias". Then migrate the database:
    
   ```bash
   php artisan migrate
   
8. Start the development server using `php artisan serve`. 
9. Access the application in your web browser at `http://localhost:8000`.
10. The default user to Login has email `admin@gmail.com` and password `abc123.,`, you can modify this data in the DB.

## Contributing

If you'd like to contribute to this project, feel free to fork the repository and submit a pull request with your changes. Contributions are always welcome!
