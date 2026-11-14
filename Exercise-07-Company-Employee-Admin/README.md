# Exercise 07: Company Portal with Employee & Admin Role Authentication

## 1. Exercise Number
**Exercise 07**

## 2. Exercise Title
**Company Webpage with Front-End and Back-End Role-Based Authentication for Employee and Admin**

## 3. Aim
To design and develop a company web portal using PHP, MySQL, and phpMyAdmin implementing strict role-based access control (RBAC) such that:
1. When an **Employee** logs in, they are authenticated and displayed **all Admin details**.
2. When an **Admin** logs in, they are authenticated and displayed **all Employee details**.

## 4. Problem Statement
Build an enterprise web application satisfying the following criteria:
- **Pages**:
  * Home (`index.php`)
  * Role Registration (`register.php`)
  * Unified Login (`login.php`)
  * Employee Dashboard (`employee_dashboard.php`)
  * Admin Dashboard (`admin_dashboard.php`)
  * Logout (`logout.php`)
- **Question Conditions**:
  * **Condition 1**: Employee login authenticates the employee and displays all administrator profiles (code, designation, office room, responsibilities, emergency contact).
  * **Condition 2**: Admin login authenticates the administrator and displays all workforce employee profiles (code, designation, department, salary, joining date, performance rating).
  * **Security Requirement**: Employees must NOT be allowed to access `admin_dashboard.php`. Unauthorized attempts must be blocked and redirected.
  * Passwords must be hashed using PHP `password_hash()`.
  * Passwords must be verified using `password_verify()`.
  * Prepared statements must be used across all database interactions.
  * Provide pre-seeded test accounts for both roles in `database.sql`.

## 5. Technologies Used
- **Front-End**: HTML5, CSS3, JavaScript (form validation).
- **Back-End**: PHP (Sessions, Role Access Control, Prepared Statements).
- **Database**: MySQL / MariaDB via phpMyAdmin (`iwt_exercise7`).
- **Server**: Apache via XAMPP.

## 6. Features
- **Strict Role-Based Routing**: Automatically directs the user to their respective dashboard based on database role.
- **Mutual Oversight Feature**: Employees see leadership/administrative contacts; administrators see complete workforce rosters with salaries and ratings.
- **Privilege Separation**: Enforces server-side checks on every dashboard request to block privilege escalation.
- **Relational Schema**: Normalized schema with foreign key constraints linking `users` with `admin_profiles` and `employee_profiles`.
- **Pre-Configured Accounts**: Includes ready-to-test credentials for viva examiners.

## 7. Folder and File Description
```
Exercise-07-Company-Employee-Admin/
├── index.php                   # Portal landing page with lab criteria explanation
├── register.php                # Role-based user registration
├── login.php                   # Unified login gateway with role redirection
├── admin_dashboard.php         # Admin view displaying ALL employee records
├── employee_dashboard.php      # Employee view displaying ALL admin records
├── logout.php                  # Session destruction script
├── db.php                      # MySQL database connector
├── style.css                   # Custom corporate styling and role badges
├── script.js                   # Client-side form validation
├── database.sql                # Complete schema and seed accounts
├── .env.example                # Sample database environment file
├── README.md                   # Full documentation and test guide
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- **XAMPP**: Apache & MySQL services.
- **PHP**: 7.4 or 8.x.
- **Modern Web Browser**: Chrome, Edge, Firefox.

## 9. Installation and Setup (XAMPP & phpMyAdmin)

### Step 1: Start XAMPP
1. Open **XAMPP Control Panel**.
2. Start **Apache** and **MySQL**.

### Step 2: Import Database in phpMyAdmin
1. Go to `http://localhost/phpmyadmin/`
2. Select **Import** tab.
3. Choose `database.sql` from this folder and click **Import**.
4. The database `iwt_exercise7` with tables `users`, `admin_profiles`, and `employee_profiles` will be established.

### Step 3: Deploy Project to htdocs
Copy this directory to:
```
C:\xampp\htdocs\Exercise-07-Company-Employee-Admin\
```

## 10. How to Run
Open in browser:
```
http://localhost/Exercise-07-Company-Employee-Admin/
```

## 11. Demonstration Credentials
- **Admin Account**:
  * Username: `admin1`
  * Password: `admin123`
- **Employee Account**:
  * Username: `emp1`
  * Password: `emp123`

## 12. How to Test (Step-by-Step Lab Protocol)

### Test 1: Admin Login & Viewing Employee Details (Condition 2)
1. Go to `login.php`.
2. Enter Username: `admin1` and Password: `admin123`.
3. Click **Authenticate**.
4. **Result**:
   - You are redirected to `admin_dashboard.php`.
   - Your name appears as Dr. Rajeshwari Murthy (System Administrator).
   - Under **Workforce Employee Records**, the table lists all company employees (Kavita Menon, Manoj Kumar, Divya Nair) with codes, departments, designations, salaries, joining dates, and ratings.

### Test 2: Employee Login & Viewing Admin Details (Condition 1)
1. Log out, then go back to `login.php`.
2. Enter Username: `emp1` and Password: `emp123`.
3. Click **Authenticate**.
4. **Result**:
   - You are redirected to `employee_dashboard.php`.
   - Your name appears as Kavita Menon (Lead Full-Stack Developer).
   - Under **Executive Administrator Directory**, the table lists all company administrators (Dr. Rajeshwari Murthy, Suresh Chandra) with admin codes, departments, designations, office suites, responsibilities, and emergency desk contacts.

### Test 3: Unauthorized Access Prevention
1. While logged in as employee (`emp1`), manually type in the browser URL bar:
   ```
   http://localhost/Exercise-07-Company-Employee-Admin/admin_dashboard.php
   ```
2. **Result**: The server intercepts the request and immediately redirects you to `employee_dashboard.php` with an authorization denial notice.

### Test 4: Logout Verification
1. Click **Logout**.
2. **Result**: Session is destroyed and you are returned to `login.php` with a success notice.

## 13. Expected Output
A secure corporate intranet web application demonstrating role-based authentication where employees access administrative contacts and administrators access comprehensive workforce records with strict privilege boundaries.

## 14. Important Notes
- All database passwords are encrypted via bcrypt `password_hash()`.
- Complies fully with the 2 key question conditions of Exercise 07.
