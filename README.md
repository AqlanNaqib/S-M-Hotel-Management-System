S&M Hotel Booking System
A complete hotel booking management system built with PHP and SQLite.
The system includes a public booking interface for guests and a comprehensive admin panel for staff to manage bookings, guests, rooms, and hotels.

📖 Description
S&M Hotel is a modern hotel chain with multiple locations across the UK. This web application allows guests to search for available rooms, make bookings, and provides hotel administrators with a dashboard to oversee all operations. The admin panel features dynamic charts, pagination, and full CRUD (Create, Read, Update, Delete) functionality for all entities.

✨ Features
Public Side
Responsive homepage with hotel and room information

Room availability search by hotel, room type, and dates

Online booking form with guest details and payment method selection

Success/failure messages after booking

Admin Side
Secure login for administrators

Dashboard with four interactive charts (Chart.js):

Booking status distribution

Revenue by payment status

Room status overview

Most popular room types

Full CRUD operations for:

Bookings (view, add, update, delete)

Guests (view, add, update, delete)

Rooms (view, add, update, delete)

Hotels (view, add, update, delete)

Pagination on all listing pages

Navigation bar with dropdown menus for easy access

🛠️ Technologies Used
Backend: PHP (procedural, SQLite3 extension)

Database: SQLite

Frontend: HTML5, CSS3, JavaScript

Charts: Chart.js (via CDN)

Icons: Font Awesome

Other: Dynamic navbar loading with fetch()

🚀 Installation
Prerequisites
PHP 7.4 or higher (with SQLite extension enabled)

A web server (e.g., Apache, Nginx) or PHP built-in server

Git (optional)

Steps
Clone the repository

bash
git clone https://github.com/yourusername/sm-hotel-booking.git
cd sm-hotel-booking
Start the PHP built-in server

bash
php -S localhost:8000
Open the application

Public site: http://localhost:8000/index.php

Admin login: http://localhost:8000/admin/adminLogin.php

The SQLite database SM_Hotel.db is included in the project. If you need to recreate the database, you can find the schema in the project files (not provided here, but you can export the structure from the existing DB or refer to the code for table definitions).

🔑 Default Admin Credentials
For demonstration purposes, the database contains one admin user:

Username: aqlan

Password: aqlan123

⚠️ Security note: Passwords are stored in plain text. In a production environment, always use password hashing (e.g., password_hash() and password_verify()).

📁 Project Structure
text
sm-hotel-booking/
│
├── index.php                 # Public homepage
├── booking.php               # Booking page (search & book)
├── booking_functions.php     # Functions for public booking
├── functions.php             # Misc helper functions (DB creation, etc.)
├── db_connect.php            # Database connection helper
├── navbar.html               # Navigation bar (loaded via JavaScript)
├── script.js                 # Fetches navbar
├── viewRoom.html             # Room details page
│
├── style/
│   ├── style.css             # Main frontend styling
│   └── booking.css           # Booking page specific styling
│
├── admin/                     # Admin area
│   ├── adminLogin.php        # Login page
│   ├── admin_dashboard.php   # Dashboard with charts
│   ├── admin_navbar.php      # Admin navigation (included in all admin pages)
│   ├── admin_functions.php   # Admin authentication
│   ├── admin.css             # Admin panel styling
│   ├── get_chart_data.php    # JSON data for charts
│   │
│   ├── booking_functions.php # Booking CRUD for admin
│   ├── create_booking.php
│   ├── update_booking.php
│   ├── delete_booking.php
│   ├── viewBookings.php
│   │
│   ├── guest_functions.php   # Guest CRUD
│   ├── create_guest.php
│   ├── update_guest.php
│   ├── delete_guest.php
│   ├── viewGuest.php
│   │
│   ├── room_functions.php    # Room CRUD
│   ├── create_room.php
│   ├── update_room.php
│   ├── delete_room.php
│   ├── viewRooms.php
│   │
│   ├── hotel_functions.php   # Hotel CRUD
│   ├── create_hotel.php
│   ├── update_hotel.php
│   ├── delete_hotel.php
│   ├── viewHotel.php
│
└── SM_Hotel.db               # SQLite database file
