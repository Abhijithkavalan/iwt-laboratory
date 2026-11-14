# Internet &amp; Web Technologies (IWT) Laboratory

**Master Repository and Academic Laboratory Manual**  
**Course:** Master of Computer Applications (MCA) / Computer Science  
**Academic Year:** 2025–2026  

---

## Table of Contents
1. [Overview &amp; Structure](#overview--structure)
2. [Summary Table of All 10 Exercises](#summary-table-of-all-10-exercises)
3. [Detailed Exercise Profiles](#detailed-exercise-profiles)
4. [How to Run Static / HTML Front-End Exercises](#how-to-run-static--html-front-end-exercises)
5. [How to Run PHP &amp; MySQL Exercises (XAMPP Environment)](#how-to-run-php--mysql-exercises-xampp-environment)
6. [Database Setup &amp; phpMyAdmin Guide](#database-setup--phpmyadmin-guide)
7. [AJAX &amp; API Architecture](#ajax--api-architecture)
8. [GitHub Repositories &amp; Push Instructions](#github-repositories--push-instructions)

---

## Overview &amp; Structure

This repository collection comprises all 10 laboratory exercises mandated by the Internet &amp; Web Technologies (IWT) laboratory curriculum. Each exercise has been built as an **independent, self-contained, and fully testable project** housed in its own dedicated directory with local assets, configuration templates, database scripts, and comprehensive documentation.

```
IWT/
├── README.md                                  # Master Laboratory Manual (This File)
├── Exercise-01-Resume/                        # Ex 1: Student Resume Webpage (HTML)
├── Exercise-02-Online-Shopping/               # Ex 2: "ShopEase" Online Shopping Page (HTML, CSS)
├── Exercise-03-Quiz/                          # Ex 3: 20-Question MCQ Quiz Engine (HTML, CSS, JS)
├── Exercise-04-Calculator/                    # Ex 4: Basic & Scientific Calculator (HTML, CSS, JS)
├── Exercise-05-Student-Form-Database/         # Ex 5: Employee Registration Database Form (PHP, MySQL)
├── Exercise-06-Dynamic-Website/               # Ex 6: Dynamic Department Website & Auth (PHP, MySQL)
├── Exercise-07-Company-Employee-Admin/        # Ex 7: Role-Based Company Portal (PHP, MySQL)
├── Exercise-08-Contact-Management/            # Ex 8: Contact CRUD System (PHP, MySQL)
├── Exercise-09-AJAX-Weather/                  # Ex 9: Asynchronous AJAX Weather App (AJAX, Fetch/XHR)
└── Exercise-10-jQuery-Books/                  # Ex 10: jQuery $.ajax() Books Catalog (jQuery, AJAX)
```

---

## Summary Table of All 10 Exercises

| Ex # | Exercise Name | Primary Technologies | Key Files Created | Database Req.? | API Req.? | Target GitHub Repository | Status |
|:---:|:---|:---|:---|:---:|:---:|:---|:---:|
| **01** | Student Resume | HTML5, Semantic Elements | `index.html`, `profile.jpg` | No | No | `iwt-exercise-01-resume` | **Completed & Tested** |
| **02** | Online Shopping | HTML5, CSS3, JavaScript | `index.html`, `style.css`, 6 Images | No | No | `iwt-exercise-02-online-shopping` | **Completed & Tested** |
| **03** | 20-Question Quiz | HTML5, CSS3, JavaScript (ES6) | `index.html`, `style.css`, `script.js` | No | No | `iwt-exercise-03-quiz` | **Completed & Tested** |
| **04** | Scientific Calculator | HTML5, CSS3, JavaScript (OOP) | `index.html`, `style.css`, `script.js` | No | No | `iwt-exercise-04-calculator` | **Completed & Tested** |
| **05** | Employee Database Form | HTML5, CSS3, PHP, MySQL | `index.php`, `db.php`, `view_employees.php`, `database.sql` | `iwt_exercise5` | No | `iwt-exercise-05-database-form` | **Completed & Tested** |
| **06** | Dynamic Department Website | HTML5, CSS3, PHP, MySQL, Sessions | `index.php`, `about.php`, `register.php`, `login.php`, `dashboard.php`, `logout.php`, `database.sql` | `iwt_exercise6` | No | `iwt-exercise-06-dynamic-website` | **Completed & Tested** |
| **07** | Company Employee & Admin | HTML5, CSS3, PHP, MySQL, RBAC | `index.php`, `register.php`, `login.php`, `admin_dashboard.php`, `employee_dashboard.php`, `database.sql` | `iwt_exercise7` | No | `iwt-exercise-07-company-employee-admin` | **Completed & Tested** |
| **08** | Contact CRUD Management | HTML5, CSS3, PHP, MySQL | `index.php`, `add_contact.php`, `edit_contact.php`, `delete_contact.php`, `database.sql` | `iwt_exercise8` | No | `iwt-exercise-08-contact-management` | **Completed & Tested** |
| **09** | AJAX Weather Telemetry | HTML5, CSS3, JavaScript, AJAX | `index.html`, `style.css`, `script.js`, `mock-weather.json` | No | Hypothetical / Mock API | `iwt-exercise-09-ajax-weather` | **Completed & Tested** |
| **10** | jQuery Books API Explorer | HTML5, CSS3, jQuery (v3.7.1), AJAX | `index.html`, `style.css`, `script.js`, `books.json`, `jquery.min.js` | No | Hypothetical / Mock API | `iwt-exercise-10-jquery-books` | **Completed & Tested** |

---

## Detailed Exercise Profiles

### Exercise 01: Static Student Resume Webpage
- **Aim:** Build a professional student resume using semantic HTML elements.
- **Includes:** Profile photograph, career objective, contact details with external links, qualifications table with degree scores, categorized technical skills, projects, certifications, extracurricular interests, and formal signed declaration.
- **Independence:** 100% offline, zero server requirement.

### Exercise 02: "ShopEase" Online Shopping Webpage
- **Aim:** Develop an attractive, responsive e-commerce storefront.
- **Includes:** Brand logo, sticky navigation bar, announcements, hero banner with call to action, category grid, at least 6 products (Laptops, Headphones, Smartwatches, Cameras, Keyboards, Backpacks) with local images, discount tags, star ratings, crossed-out original prices, interactive cart counter badge, and bottom toast notifications.

### Exercise 03: Interactive 20-Question Web Tech Quiz
- **Aim:** Implement a client-side quiz engine with automated scoring.
- **Includes:** Exactly 20 multiple choice questions with 4 options each, real-time progress indicator ("X of 20 Answered"), premature submission prevention, comprehensive score breakdown (Total, Correct, Wrong, Unattempted, Percentage, Grade badge), complete answer review with explanations, and a restart button.

### Exercise 04: Basic & Scientific Calculator
- **Aim:** Build a dual-line scientific calculator.
- **Includes:** Arithmetic operators (`+`, `-`, `×`, `÷`, `%`, `(`, `)`), trigonometric functions (`sin`, `cos`, `tan`), logarithmic and root functions (`log`, `ln`, `sqrt`, `xʸ`), mathematical constants (`π`, `e`), sign toggle (`±`), angle mode switch (DEG/RAD), backspace delete, all-clear, division by zero protection, and calculation history log.

### Exercise 05: Employee Database Form
- **Aim:** Create a PHP/MySQL data entry form with phpMyAdmin integration.
- **Includes:** 10 employee fields (Emp ID, Name, Email, Phone, Gender, DOB, Department, Designation, Salary, Address), dual client/server validation, prepared statement insertions, duplicate checking, and `view_employees.php` presenting records in a clean tabular format.

### Exercise 06: Dynamic Department Website with Authentication
- **Aim:** Multi-page dynamic department portal with session-based access control.
- **Includes:** Home, About Us with faculty roster, Student Registration with bcrypt password hashing (`password_hash`), Login with `password_verify`, session-protected Dashboard with enrolled lab subjects, and secure Logout with complete session destruction.

### Exercise 07: Company Portal (Role-Based Employee & Admin)
- **Aim:** Implement mutual oversight role-based access control.
- **Condition 1 Fulfilled:** When an Employee logs in, they are authenticated and displayed **all Admin details** (Admin Code, Office Room, Designation, Responsibilities, Emergency Desk).
- **Condition 2 Fulfilled:** When an Admin logs in, they are authenticated and displayed **all Employee details** (Employee Code, Designation, Department, Salary, Joining Date, Performance Rating).
- **Security:** Strict route guards block employees from unauthorized access to the admin dashboard.

### Exercise 08: Contact Management System (CRUD)
- **Aim:** Complete Create, Read, Update, Delete (CRUD) contact system.
- **Includes:** Multi-field contacts (Contact ID, Name, Phone, Email, Address, Category), searchable data table, category filter, Add Contact form, Edit Contact form, and Delete Contact action protected by JavaScript `confirm()` dialogs.

### Exercise 09: Asynchronous Weather Application Using AJAX
- **Aim:** Retrieve and display meteorological telemetry without page refreshes.
- **Includes:** Dual AJAX demonstration using both `fetch()` API and `XMLHttpRequest` (XHR), live animated loading spinner, error interceptor, quick-select city chips, separate API configuration object, and bundled `mock-weather.json` containing comprehensive city datasets.

### Exercise 10: jQuery Books Catalog Explorer via $.ajax()
- **Aim:** Asynchronous JSON data retrieval and DOM injection using jQuery.
- **Includes:** Official jQuery v3.7.1 bundled locally for offline execution, `$.ajax()` GET query with `beforeSend`, `success`, and `error` callbacks, dynamic card generation, live search filtering, category dropdowns, and bundled `books.json`.

---

## How to Run Static / HTML Front-End Exercises

Exercises **01, 02, 03, and 04** require only a web browser:

1. Navigate to the respective folder:
   - `Exercise-01-Resume/index.html`
   - `Exercise-02-Online-Shopping/index.html`
   - `Exercise-03-Quiz/index.html`
   - `Exercise-04-Calculator/index.html`
2. Double-click `index.html` or right-click -> **Open With** -> **Google Chrome** (or any browser).
3. The projects run locally with zero server overhead.

---

## How to Run PHP &amp; MySQL Exercises (XAMPP Environment)

Exercises **05, 06, 07, and 08** require the XAMPP stack:

1. **Launch XAMPP Control Panel**:
   - Start **Apache**.
   - Start **MySQL**.
2. **Deploy to htdocs**:
   - Copy the exercise folders into `C:\xampp\htdocs\`:
     * `C:\xampp\htdocs\Exercise-05-Student-Form-Database\`
     * `C:\xampp\htdocs\Exercise-06-Dynamic-Website\`
     * `C:\xampp\htdocs\Exercise-07-Company-Employee-Admin\`
     * `C:\xampp\htdocs\Exercise-08-Contact-Management\`
3. **Open in Browser**:
   - Exercise 05: `http://localhost/Exercise-05-Student-Form-Database/`
   - Exercise 06: `http://localhost/Exercise-06-Dynamic-Website/`
   - Exercise 07: `http://localhost/Exercise-07-Company-Employee-Admin/`
   - Exercise 08: `http://localhost/Exercise-08-Contact-Management/`

---

## Database Setup &amp; phpMyAdmin Guide

Each PHP/MySQL exercise provides a ready-to-run `database.sql` script with table schemas and seed data:

1. Open your browser and navigate to:
   ```
   http://localhost/phpmyadmin/
   ```
2. Click the **Import** tab at the top.
3. Choose the appropriate `database.sql` file and click **Import**:
   - For Exercise 05: `Exercise-05-Student-Form-Database/database.sql` -> creates `iwt_exercise5`
   - For Exercise 06: `Exercise-06-Dynamic-Website/database.sql` -> creates `iwt_exercise6`
   - For Exercise 07: `Exercise-07-Company-Employee-Admin/database.sql` -> creates `iwt_exercise7`
   - For Exercise 08: `Exercise-08-Contact-Management/database.sql` -> creates `iwt_exercise8`
4. The database credentials in all `db.php` files default to:
   - Host: `localhost`
   - Username: `root`
   - Password: ` ` *(blank)*

---

## AJAX &amp; API Architecture

Exercises **09 and 10** demonstrate asynchronous communication using mock JSON files:
- **Exercise 09 (`mock-weather.json`)**: Emulates a meteorological API. Can be connected to OpenWeatherMap by setting `mode: 'live'` in `script.js`.
- **Exercise 10 (`books.json`)**: Emulates a digital library API. Can be connected to Google Books API by toggling `mode: 'live'` in `script.js`.
- **CORS Notice**: Because modern browsers restrict `fetch()` and `XMLHttpRequest` from local `file:///` URLs, run these exercises through Apache (`http://localhost/Exercise-09-AJAX-Weather/`) or a local Python quick server (`python -m http.server 8000`).

---

## GitHub Repositories &amp; Push Instructions

Each exercise has been initialized as an **independent Git repository on branch `main`** with clean commit history, `.gitignore` rules, and zero committed credentials.

To push each exercise to its separate repository on GitHub:

### Step 1: Create the 10 Repositories on GitHub
Log in to your GitHub account and create 10 new empty repositories (do not initialize with README or license):
1. `iwt-exercise-01-resume`
2. `iwt-exercise-02-online-shopping`
3. `iwt-exercise-03-quiz`
4. `iwt-exercise-04-calculator`
5. `iwt-exercise-05-database-form`
6. `iwt-exercise-06-dynamic-website`
7. `iwt-exercise-07-company-employee-admin`
8. `iwt-exercise-08-contact-management`
9. `iwt-exercise-09-ajax-weather`
10. `iwt-exercise-10-jquery-books`

### Step 2: Push Each Project Using Terminal Commands
Replace `<YOUR_GITHUB_USERNAME>` with your GitHub username:

```powershell
# 1. Exercise 01: Resume
cd Exercise-01-Resume
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-01-resume.git
git push -u origin main
cd ..

# 2. Exercise 02: Online Shopping
cd Exercise-02-Online-Shopping
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-02-online-shopping.git
git push -u origin main
cd ..

# 3. Exercise 03: Quiz
cd Exercise-03-Quiz
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-03-quiz.git
git push -u origin main
cd ..

# 4. Exercise 04: Calculator
cd Exercise-04-Calculator
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-04-calculator.git
git push -u origin main
cd ..

# 5. Exercise 05: Database Form
cd Exercise-05-Student-Form-Database
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-05-database-form.git
git push -u origin main
cd ..

# 6. Exercise 06: Dynamic Website
cd Exercise-06-Dynamic-Website
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-06-dynamic-website.git
git push -u origin main
cd ..

# 7. Exercise 07: Company Employee Admin
cd Exercise-07-Company-Employee-Admin
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-07-company-employee-admin.git
git push -u origin main
cd ..

# 8. Exercise 08: Contact Management
cd Exercise-08-Contact-Management
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-08-contact-management.git
git push -u origin main
cd ..

# 9. Exercise 09: AJAX Weather
cd Exercise-09-AJAX-Weather
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-09-ajax-weather.git
git push -u origin main
cd ..

# 10. Exercise 10: jQuery Books
cd Exercise-10-jQuery-Books
git remote add origin https://github.com/<YOUR_GITHUB_USERNAME>/iwt-exercise-10-jquery-books.git
git push -u origin main
cd ..
```

---
*Created for MCA Computer Science - Internet &amp; Web Technologies (IWT) Laboratory Exam Demonstration.*
