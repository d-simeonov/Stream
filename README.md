## What is this?

A simple CRUD application implementing the "Test Task Back End - CRUD Laravel Standard MVC or REST API" challenge.

The UI was generated with the help of AI and adjusted with a few manual refinements. Authentication is handled via
Laravel Breeze.

## Setup

The project uses SQLite. To get started:

1. Create an empty SQLite database file in the database/ directory (for example: database/database.sqlite).
2. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   npm install
   npm run dev
   ```

## Security

Input validation and Laravel policy-based authorization are used to secure the application and enforce permissions.

## Notes

- Total development time for this project was approximately ~~2.3~~ 3.5 hours.
