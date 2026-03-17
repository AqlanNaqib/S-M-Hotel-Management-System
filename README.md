<p align="center">
<h1 align="center">🏨 S&M Hotel Booking System</h1>
<img src="screenshots/home.png" width="900">
<p align="center">
A full-stack hotel booking web application built with <b>PHP</b> and <b>SQLite</b>.
</p>

<p align="center">

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?logo=sqlite)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/license-MIT-green)

</p>

---

# 📖 Project Overview

The **S&M Hotel Booking System** is a web-based booking platform that allows guests to search and reserve hotel rooms while giving administrators the ability to manage bookings, rooms, hotels, and guest information.

This project demonstrates **full-stack web development** using **PHP, SQLite, HTML, CSS, and JavaScript**, including CRUD operations and data visualization using **Chart.js**.

---

## 🎯 Purpose
This system simulates a real-world hotel booking platform, allowing efficient management of reservations, customers, and room availability.

It is designed to demonstrate full-stack development skills and database-driven application design.

---

## 🧠 System Design

- Follows a modular PHP structure
- Uses SQLite for lightweight database management
- Implements CRUD operations across all entities
- Admin dashboard uses Chart.js for data visualization

---

# 🚀 Key Features

## 👤 Guest Features

- Browse hotels and available rooms
- Search rooms by date and type
- Submit room booking requests
- Instant booking confirmation

## 🛠️ Admin Features

- Secure admin authentication
- Interactive dashboard with **Chart.js**
- Manage bookings
- Manage guest records
- Manage room availability
- Manage hotels
- Pagination for large datasets

---

# 🧰 Tech Stack

| Technology | Purpose |
|-----------|---------|
| HTML5 | Page structure |
| CSS3 | Styling |
| JavaScript | Client-side interaction |
| PHP | Backend logic |
| SQLite | Database |
| Chart.js | Dashboard analytics |
| Font Awesome | UI icons |

---

# 🖥️ Screenshots

## Homepage

![Homepage](screenshots/home.png)

---

## Rooms Page

![Rooms](screenshots/rooms.png)

---

## Booking Page

![Booking](screenshots/booking.png)

---

## Admin Dashboard

![Dashboard](screenshots/dashboard.png)

---

## Manage Bookings

![Bookings](screenshots/view.png)

---

# ⚙️ Installation

## Prerequisites

- PHP **7.4+**
- SQLite extension enabled
- Web server (Apache / Nginx / XAMPP)

---

## 1. Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/sm-hotel-booking.git
cd sm-hotel-booking
```

---

## 2. Start PHP Server

```bash
php -S localhost:8000
```

---

## 3. Open in Browser

Public site

```
http://localhost:8000/index.php
```

Admin panel

```
http://localhost:8000/admin/adminLogin.php
```

---

# 🔑 Default Admin Credentials

| Username | Password |
|--------|--------|
| james.manager | admin2024! |

⚠️ Security Notice:  
Passwords are stored in **plain text** for demonstration purposes.

Production systems should use:

```
password_hash()
password_verify()
```
- Passwords currently stored in plain text (demo purpose)
- Should be replaced with:
  - password_hash()
  - password_verify()
- Input validation and sanitisation should be added to prevent SQL injection

---

# 📂 Project Structure

```
sm-hotel-booking/

index.php
booking.php
booking_functions.php
functions.php
db_connect.php
navbar.html
script.js
viewRoom.html

style/
   style.css
   booking.css

admin/
   adminLogin.php
   admin_dashboard.php
   admin_navbar.php
   admin_functions.php
   admin.css
   get_chart_data.php

   create_booking.php
   update_booking.php
   delete_booking.php
   viewBookings.php

   create_guest.php
   update_guest.php
   delete_guest.php
   viewGuest.php

   create_room.php
   update_room.php
   delete_room.php
   viewRooms.php

   create_hotel.php
   update_hotel.php
   delete_hotel.php
   viewHotel.php

SM_Hotel.db
```

---

# 🔮 Future Improvements

- Implement password hashing
- Email confirmation after booking
- Payment gateway integration (Stripe / PayPal)
- UI improvements using Bootstrap or Tailwind
- Multi-language support
- Printable booking invoices

---

## 🎥 Demo
https://youtu.be/Q2bImjhb4H0?feature=shared


---

# 📄 License

This project is licensed under the **MIT License**.

---

# 👨‍💻 Author

**Aqlan Naqib**


Feel free to fork this project, suggest improvements, or submit pull requests.
