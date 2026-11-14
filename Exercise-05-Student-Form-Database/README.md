# Exercise 05: Employee Details Form & Database Integration

## 1. Exercise Number
**Exercise 05**

## 2. Exercise Title
**Employee Registration Form with MySQL Database Storage in phpMyAdmin**

## 3. Aim
To design an Employee Details entry form and develop server-side PHP scripts utilizing parameterized MySQL queries (Prepared Statements) to validate, store, and display employee records in phpMyAdmin.

## 4. Problem Statement
Develop an Employee Management application containing:
- **Employee Fields**:
  1. Employee ID (`emp_id`)
  2. Full Name (`full_name`)
  3. Corporate Email (`email`)
  4. Phone Number (`phone`)
  5. Gender (`gender`)
  6. Date of Birth (`dob`)
  7. Department (`department`)
  8. Designation (`designation`)
  9. Monthly Salary (`salary`)
  10. Residential Address (`address`)
- **Functional Requirements**:
  * Clean form interface with client-side and server-side validation.
  * Prevention of duplicate Employee IDs and Emails.
  * Parameterized `mysqli` prepared statements (`bind_param`) to prevent SQL injection.
  * Instant success notification banner upon insertion.
  * Dedicated employee directory page (`view_employees.php`) rendering all records in a formatted data table with currency symbols.
  * Graceful database error interceptor if MySQL is stopped or database uninitialized.
  * Full XAMPP / Apache / MySQL / phpMyAdmin compatibility.

## 5. Technologies Used
- **Front-End**: HTML5, CSS3, JavaScript (client-side form validation).
- **Back-End**: PHP (8.x+ / 7.x compatible).
- **Database**: MySQL / MariaDB via phpMyAdmin.
- **Server Environment**: XAMPP Apache Server.

## 6. Features
- **Security-First Architecture**: Prepared Statements protect against SQL injection vulnerabilities.
- **Dual Validation**: Immediate JavaScript format checks on the client + strict PHP validation on the server.
- **Duplicate Prevention**: Rejects duplicate employee IDs or emails with informative user alerts.
- **Clean Responsive UI**: Designed with modern CSS Grid and Flexbox for academic lab evaluation.
- **Complete SQL Script**: `database.sql` bundled for one-click phpMyAdmin import with seed demo records.

## 7. Folder and File Description
```
Exercise-05-Student-Form-Database/
├── index.php                   # Employee registration form and PHP insert processor
├── db.php                      # Database connection script with graceful error reporting
├── view_employees.php          # Table view listing all stored employee records
├── style.css                   # Custom responsive corporate styles
├── script.js                   # Client-side validation script
├── database.sql                # SQL database creation and seed schema
├── .env.example                # Example database environment configuration
├── README.md                   # Complete exercise documentation
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- **XAMPP**: Apache & MySQL services.
- **PHP**: Version 7.4 or 8.x.
- **Web Browser**: Any modern browser (Google Chrome, Firefox, Edge).

## 9. Installation and Setup (XAMPP & phpMyAdmin)

### Step 1: Install and Start XAMPP
1. Download and install XAMPP from [apachefriends.org](https://www.apachefriends.org).
2. Launch the **XAMPP Control Panel**.
3. Click **Start** for **Apache**.
4. Click **Start** for **MySQL**.

### Step 2: Import Database in phpMyAdmin
1. Open your web browser and navigate to:
   ```
   http://localhost/phpmyadmin/
   ```
2. Click on the **Import** tab at the top.
3. Click **Choose File** and select `database.sql` from this folder.
4. Click **Import** (or **Go**) at the bottom.
5. The database `iwt_exercise5` and table `employees` will be created with sample records.

### Step 3: Deploy Project to XAMPP htdocs
Copy this project folder into your XAMPP web root directory:
```
C:\xampp\htdocs\Exercise-05-Student-Form-Database\
```

## 10. How to Run
Open your browser and navigate to the localhost URL:
```
http://localhost/Exercise-05-Student-Form-Database/
```
Or to view employee records directly:
```
http://localhost/Exercise-05-Student-Form-Database/view_employees.php
```

## 11. How to Test
1. **Initial View Test**:
   - Open `http://localhost/Exercise-05-Student-Form-Database/view_employees.php`.
   - Verify that 3 seed records (Arun Kumar, Priya Sundaram, Rohan Verma) display in the table.
2. **Form Entry Test**:
   - Open `http://localhost/Exercise-05-Student-Form-Database/index.php`.
   - Enter new details:
     * Employee ID: `EMP104`
     * Name: `Ananya Rao`
     * Email: `ananya.rao@techcorp.com`
     * Phone: `9123456780`
     * Gender: `Female`
     * Date of Birth: `1997-04-12`
     * Department: `Research & Development`
     * Designation: `AI Research Associate`
     * Salary: `82000.00`
     * Address: `12 MG Road, Bengaluru`
   - Click **Submit & Save Employee**.
3. **Verification of Success**:
   - Verify that a green banner appears: `✓ Employee record for 'Ananya Rao' (ID: EMP104) has been successfully saved to the database!`
   - Click **View All Employees** and verify the newly added employee is listed.
4. **Validation Tests**:
   - Try entering an invalid phone (e.g. `12345`). Confirm error message.
   - Try submitting the same Employee ID `EMP104` again. Confirm error message: `An employee with this Employee ID or Email address is already registered.`
5. **phpMyAdmin Verification**:
   - Open phpMyAdmin, select `iwt_exercise5` -> `employees` table.
   - Confirm the new row is stored permanently in MySQL.

## 12. Expected Output
A fully operational PHP/MySQL web application with an employee registration form, interactive feedback, database persistence, and a formatted data table view.

## 13. Important Notes
- MySQL connection credentials in `db.php` default to `localhost`, user `root`, empty password (standard for local XAMPP).
- No hardcoded passwords or sensitive tokens are stored in the codebase.
