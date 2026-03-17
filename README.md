<h1 align="center">🏨 Hotel Booking Management System</h1>

<p align="center">
  <img src="screenshots/home.png" width="900">
</p>

<p align="center">
A production-style full-stack hotel booking system featuring admin analytics, real-time booking management, and complete CRUD functionality, built with <b>PHP</b>, <b>SQLite</b>, and modern web technologies.
</p>

<p align="center">
  <sub>Built as part of my BSc Computer Science portfolio</sub>
</p>

<p align="center">
  <a href="https://youtu.be/Q2bImjhb4H0?feature=shared">
    <img src="https://img.shields.io/badge/Watch-Demo-red?style=for-the-badge&logo=youtube" />
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/SQLite-003B57?logo=sqlite" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black" />
  <img src="https://img.shields.io/badge/license-MIT-green" />
</p>

<br>

---

# 📖 Project Overview

The **Hotel Booking Management System** is a web-based booking platform that allows guests to search and reserve hotel rooms while giving administrators the ability to manage bookings, rooms, hotels, and guest information.

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

## ⚡ Highlights

- Full-stack CRUD system across multiple entities
- Admin analytics dashboard using Chart.js
- Modular backend architecture in PHP
- Lightweight database integration using SQLite

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
git clone https://github.com/AqlanNaqib/S-M-Hotel-Management-System.git
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

---

# 🔐 Security Considerations

- Passwords are currently stored in plain text (for demonstration purposes only)
- In production, implement:
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

# 📚 What I Learned

- Designing relational database schemas
- Handling CRUD operations across multiple entities
- Structuring a modular PHP application
- Building admin dashboards with data visualisation

---

# 📄 License

This project is licensed under the **MIT License**.

---

# 👨‍💻 Author

**Aqlan Naqib**  
BSc Computer Science @ Sheffield Hallam University  
Aspiring Software Developer  


⭐ If you found this project useful, feel free to star the repository!
