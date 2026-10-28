# Laravel Project Manager

A small learning project built with PHP and Laravel. It lets you create projects, view them, and mark them as completed.

## Features

- List projects
- Create a project with a name and optional description
- Mark a project as completed
- Validate form input
- Store projects in a database
- Feature tests for the main flows

## Requirements

- PHP and Composer, with versions supported by the Laravel version installed
- Node.js and npm are only needed if you compile frontend assets

## Setup

This repository's application files are designed to be added to a fresh Laravel application. See the repository setup instructions provided with the project bundle. After the Laravel skeleton is in place:

1. Configure SQLite in `.env` with `DB_CONNECTION=sqlite`.
2. Create an empty file at `database/database.sqlite`.
3. Run the commands below.

```bash
php artisan migrate
php artisan test
php artisan serve
```

Open the local address printed by `artisan serve`.

## Laravel concepts used

- **Route:** maps an HTTP method and URL to application logic.
- **Controller:** validates requests and handles application actions.
- **Eloquent model:** represents a database record.
- **Migration:** versions changes to the database schema.
- **Blade:** renders server-side HTML.
- **Feature test:** exercises an HTTP request through the Laravel application.

## Scope

This is intentionally small. It is meant for learning Laravel's request flow and database basics, not as a production-ready project management system.
