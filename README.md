
# ✨ A Photography & Videography Service Booking Website

This is a dynamic, full-stack web application designed for professional photographers and videographers. It allows clients to browse services and book appointments for events (Weddings, Birthdays, Corporate, etc.) through an integrated system.

## 🚀 Features

* **Dynamic Booking System:** Clients can choose between photography, videography, or combo packages.
* **Responsive Design:** Fully mobile-friendly UI built with Bootstrap.
* **Database Management:** Stores appointment details, client info, and event types securely in MySQL.
* **Admin Dashboard:** Manage client's appointments by approve,penidng,delete bookings and view upcoming event schedules.

## 🧰 Tech Stack

* **Backend:** PHP
* **Database:** MySQL
* **Frontend:** HTML5, JavaScript (AJAX for form handling)
* **Styling:** CSS3, Bootstrap 5, Google Fonts

## 📂 Project Structure

```text
A-photography-website/
├── admin/                     # Admin Panel (Child of Root)
│   ├── css/                   # Child of Admin
│   │   ├── appointments_ap.css
│   │   └── gallery.css
│   ├── index.php
│   ├── dashboard.php
│   ├── sidebar.php
│   ├── client_appointment.php
│   ├── approved.php
│   ├── pendding.php
│   ├── categories.php
│   ├── gallery.php
│   ├── all_photo.php
│   ├── function.php
│   ├── delete.php
│   ├── upload.php
│   ├── users.php
│   └── logout.php
├── css/                       # User-side styling
│   └── style.css
├── images/                       # User-side styling
│   └── logo-icons/                # Assets folder
├── uploads/                   # Containing images dynamically uploded photos by admin 
├── sql/                        # Database file
│   └── photolensdb.sql         #containg 4 tables
├── config.php                 # Core settings of database connection
├── header.php
├── footer.php
├── home.php
├── gallery.php
├── contact.php
├── book.php
├── registration.php
├── login.php
└── logout.php
```

## 🛠️ Installation & Setup

1. **Clone the repo:** `https://github.com/YourUsername/A-photography-website.git`
2. **Database:** Import the `photolensdb.sql` file from the `/sql` folder into your local phpMyAdmin.
3. **Four Tables :** users, categories, appointment, photos 
4. **Configure:** Update `includes/db_connection.php` with your local database credentials.
5. **Run:** Open the project in XAMPP/WAMP (e.g., `http://localhost/A-photography-website`).

---
