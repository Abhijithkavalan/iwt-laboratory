# Exercise 06: Dynamic Department Website with Authentication

## 1. Exercise Number
**Exercise 06**

## 2. Exercise Title
**Dynamic Department Webpage with Home, About Us, Registration, Login, and Session-Protected Dashboard Using PHP & MySQL**

## 3. Aim
To develop a multi-page dynamic department web portal featuring user registration, database persistence with bcrypt password hashing, session-based authentication, and a restricted user dashboard using PHP and MySQL in phpMyAdmin.

## 4. Problem Statement
Design a department website containing:
- **Pages**:
  1. **Home (`index.php`)**: Department overview, academic highlights, notice board, and dynamic login/dashboard links.
  2. **About Us (`about.php`)**: Vision, mission, values, and faculty roster.
  3. **Registration (`register.php`)**: New student sign-up form capturing Full Name, Email, Phone, Username, and Password.
  4. **Login (`login.php`)**: Secure authentication form with demonstration credentials.
  5. **Dashboard (`dashboard.php`)**: User portal accessible *only* to authenticated sessions displaying user profile and registered lab courses.
  6. **Logout (`logout.php`)**: Session destruction handler redirecting to login with confirmation.
- **Security & Database Requirements**:
  * Store credentials in MySQL table `iwt_exercise6.users`.
  * Passwords must be hashed using `password_hash($password, PASSWORD_DEFAULT)`.
  * Passwords must be verified via `password_verify()`.
  * Prepared statements must be used for both insert and query execution to prevent SQL injection.
  * Prevent duplicate registrations for existing usernames or emails.
  * Direct URL access to `dashboard.php` without an active session must immediately redirect to `login.php`.

## 5. Technologies Used
- **Front-End**: HTML5, CSS3, JavaScript (DOM validation).
- **Back-End**: PHP (Sessions, Hashing API, Prepared Statements).
- **Database**: MySQL / MariaDB via phpMyAdmin.
- **Web Server**: Apache via XAMPP.

## 6. Features
- **Secure Password Hashing**: Uses modern bcrypt algorithm instead of plain-text or MD5.
- **PHP Session Management**: Maintains state across multiple pages with automatic session invalidation on logout.
- **Access Control & Route Protection**: Dashboard is strictly protected; unauthenticated visitors are prevented from viewing student data.
- **Dynamic Navbar**: Automatically toggles between "Login / Register" and "Dashboard / Logout" based on active session state.
- **Pre-Configured Demo Account**: Includes seed test account for instant viva evaluation.

## 7. Folder and File Description
```
Exercise-06-Dynamic-Website/
├── index.php                   # Department portal landing page
├── about.php                   # About us, mission, and faculty details
├── register.php                # Student account creation page
├── login.php                   # Authentication login page
├── dashboard.php               # Protected student dashboard
├── logout.php                  # Session destruction script
├── db.php                      # MySQL database connection wrapper
├── style.css                   # Custom responsive academic theme
├── script.js                   # Client-side form validation
├── database.sql                # MySQL schema and initial demo accounts
├── .env.example                # Sample database credentials configuration
├── README.md                   # Full exercise documentation
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- **XAMPP**: Apache & MySQL services.
- **PHP**: 7.4 or 8.x.
- **Modern Web Browser**: Google Chrome, Edge, Firefox.

## 9. Installation and Setup (XAMPP & phpMyAdmin)

### Step 1: Start XAMPP Services
1. Open **XAMPP Control Panel**.
2. Click **Start** for **Apache**.
3. Click **Start** for **MySQL**.

### Step 2: Import Database in phpMyAdmin
1. Navigate to: `http://localhost/phpmyadmin/`
2. Click on the **Import** tab at the top.
3. Select `database.sql` from this directory.
4. Click **Import**.
5. The database `iwt_exercise6` and `users` table will be created.

### Step 3: Deploy Project to XAMPP htdocs
Copy this directory to:
```
C:\xampp\htdocs\Exercise-06-Dynamic-Website\
```

## 10. How to Run
Navigate to:
```
http://localhost/Exercise-06-Dynamic-Website/
```

## 11. Sample Login Credentials
The seed database provides pre-configured credentials for quick testing:
- **Username:** `student1`
- **Password:** `password123`

## 12. How to Test
1. **Direct Access Protection Test**:
   - In a private/incognito window, open `http://localhost/Exercise-06-Dynamic-Website/dashboard.php`.
   - Confirm you are immediately redirected to `login.php`.
2. **Pre-Configured Demo Login Test**:
   - On `login.php`, enter Username: `student1` and Password: `password123`.
   - Click **Sign In**.
   - Verify you are redirected to `dashboard.php` showing Vikas Sharma's profile and registered lab courses.
3. **Logout Test**:
   - Click **Logout**.
   - Verify you are redirected back to `login.php` with a green banner: `✓ You have been successfully logged out of the department portal.`
4. **New User Registration Test**:
   - Click **Register**.
   - Enter:
     * Full Name: `Deepak Roy`
     * Email: `deepak.roy@dept.edu`
     * Phone: `9876543299`
     * Username: `deepak_r`
     * Password: `secretpass`
   - Click **Register Account**.
   - Confirm success message: `✓ Account created successfully for 'deepak_r'! You can now proceed to login.`
5. **New User Login Test**:
   - Go to `login.php`, enter `deepak_r` and `secretpass`.
   - Confirm successful access to the dashboard displaying Deepak Roy's information.
6. **Duplicate Prevention Test**:
   - Attempt to register again with username `deepak_r`.
   - Confirm error: `An account with this Username or Email address already exists.`

## 13. Expected Output
A secure department portal allowing visitors to browse home and about pages, register accounts with password encryption, log in with session persistence, view protected student dashboards, and cleanly log out.

## 14. Important Notes
- Complies with secure programming standards: prepared statements, bcrypt hashing, and complete session cleanup.
