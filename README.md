# 📝 PHP To-Do App

A simple **To-Do List web application** built with **PHP, MySQL, HTML, and CSS**.  
This project demonstrates **user authentication** (register, login, logout) and full **CRUD operations** on tasks.

---

## 🚀 Features
- User registration with hashed passwords
- Login & logout with sessions
- Add tasks
- View personal task list
- Mark tasks as completed
- Delete tasks (with confirmation)
- Only logged-in users can access tasks
- Clean separation of PHP logic and HTML templates
- Secure prepared statements for database queries
- Post/Redirect/Get pattern to prevent duplicate submissions
- CSS using custom properties with consistent measurement rules (rem, %, px, em)

---

## 📂 Folder Structure
```
todo_app/
├── assets/                 # (CSS, JS, images)
│   └── style.css
├── templates/              # HTML templates for views
│   ├── index_view.php      # Dashboard view
│   ├── login_form.php      # Login form
│   └── register_form.php   # Register form
│
├── db_connect.php          # Database connection (PDO)
├── index.php               # Task dashboard (CRUD logic)
├── login.php               # Login logic
├── logout.php              # Logout
├── register.php            # Registration logic
└── test.php                # Debug/testing file
```

---

## 🗄️ Database Setup

You can set up the database in two ways:

### Option 1: Import SQL file
1. Open **phpMyAdmin**.  
2. Go to the **Import** tab.  
3. Select the `todo_app.sql` file included in this repo.  
4. Click **Go** → database and tables will be created automatically.  

### Option 2: Run SQL manually
```sql
CREATE DATABASE todo_app;
USE todo_app;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tasks table
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    task VARCHAR(255) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 🛠️ Tech Stack
- **Backend:** PHP 8+
- **Database:** MySQL (MariaDB)
- **Frontend:** HTML, CSS
- **Server:** Apache (XAMPP/WAMP/MAMP)

---

## ▶️ How to Run
1. Clone the repository:
   ```bash
   git clone https://github.com/pascal-vuong/php-todo-app.git
   ```
2. Import the database (see Database Setup above).  
3. Place the project in your local server’s web directory (e.g., `htdocs/` for XAMPP).  
4. Open in your browser:  
   ```
   http://localhost/php-todo-app/index.php
   ```

---

## 📚 What I Learned
- How to implement authentication with **sessions** and **password hashing**.  
- How to build a secure CRUD app with **PDO + prepared statements**.  
- How to use the **Post/Redirect/Get pattern** to prevent duplicate form submissions.  
- How to structure a PHP project by separating **logic and templates**.  

---

## 🔮 Upcoming Improvements
- Add **styling** with `style.css` for a more polished UI  
- Implement **undo for completed tasks** (mark tasks back to “pending”)  
- Add **task editing** to allow updating existing task descriptions  

---

## 📏 CSS Measurement Rules for This Project

- **`rem` → for**  
  - Font sizes  
  - Padding & margins  
  - Card widths / component widths  
  - Border-radius (curves, rounded corners)  
  - Shadows blur/spread values  

- **`%` → for**  
  - Container widths (e.g., `width: 90%`)  
  - Flexible layouts  
  - Used together with `max-width` in `rem` for responsiveness  

- **`px` → for**  
  - Borders (`1px solid …`)  
  - Thin dividers  
  - Shadow offsets (when you want crispness that shouldn’t scale)  

- **`em` → for**  
  - Button padding (`padding: 0.5em 1em`)  
  - Text-related spacing inside components  
  - Ensures button sizing adapts if text size changes

## 📈 Progression Log

- **2025-09-12** – Initial version of the project completed  
  (full PHP To-Do app with authentication, CRUD, separation of logic & templates)  

- **2025-09-13** – Styled `register_form.php` and `login_form.php` using CSS custom properties with consistent measurement rules (rem, %, px, em)  

- **2025-09-14** – Refactored `index_view.php` into a card layout matching the login/register style.  
  Added structured sections (`dashboard-header`, `task-form`, `task-list`, `logout-footer`).  
  Introduced `.message-box` for success/error messages placed between the add-task form and the task list.  
  Updated `style.css` with:  
  - bulletin board style for tasks (border, background, spacing, actions under each task)  
  - relocated logout link to bottom with spacing  
  - flexible page layout (`align-items: flex-start`, `min-height: 100vh`) to prevent header clipping when many tasks are added  
  - success message styling with green border/background

---

