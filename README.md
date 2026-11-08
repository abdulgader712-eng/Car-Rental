# Car Rental Management System

A PHP and MySQL web application for a car rental business. It provides a customer site for browsing and searching vehicles, checking availability, registering accounts, and managing bookings, alongside an administration area for vehicles, brands, bookings, users, and site content.

## Technology

- PHP
- MySQL
- HTML, CSS, and JavaScript
- Bootstrap and jQuery

## Main features

- Vehicle catalogue, search, details, and availability checks
- Customer registration, sign-in, profiles, and booking history
- Booking and testimonial workflows
- Admin dashboard for vehicles, brands, bookings, users, and pages
- SQL schema and example vehicle and brand catalogue

## Local setup

1. Install PHP with PDO MySQL support and MySQL or MariaDB. A local Apache/PHP bundle such as XAMPP can also be used.
2. Create a database named `carrental` and import [`db/carrental.sql`](db/carrental.sql).
3. Configure `DB_HOST`, `DB_USER`, `DB_PASS`, and `DB_NAME` in the PHP environment used by your web server. The included config files use local development defaults when variables are not set.
4. Place the project in your web server's document root and open it through the local server.

The SQL file intentionally excludes personal customer, contact, booking, and admin account records. It includes the database schema and an example vehicle and brand catalogue. No default administrator account is provided.

## Notes

This is an academic project. The codebase includes legacy components and should be reviewed and updated before any production deployment. Third-party libraries and media may have separate license terms; check their notices before reuse.

