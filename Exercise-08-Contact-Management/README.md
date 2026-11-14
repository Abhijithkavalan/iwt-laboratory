# Exercise 08: Contact Management System (CRUD)

## 1. Exercise Number
**Exercise 08**

## 2. Exercise Title
**Contact Management Application with Add, View, Edit, Delete, and Search Functions Using PHP and MySQL**

## 3. Aim
To design, implement, and test a full CRUD (Create, Read, Update, Delete) Contact Management web application utilizing PHP, MySQL, and phpMyAdmin with parameterized prepared statements, search filtering, and client confirmation dialogs.

## 4. Problem Statement
Develop a Contact Management Application supporting:
- **Contact Attributes**:
  * Contact ID (`contact_id` e.g. `CNT-001`)
  * Full Name (`name`)
  * Phone Number (`phone`)
  * Email Address (`email`)
  * Residential/Office Address (`address`)
  * Category (`category`: Work, Family, Friends, Academic, Emergency)
- **Required Operations (CRUD)**:
  1. **Add Contact (`add_contact.php`)**: Form to validate and persist new contact entries.
  2. **View Contacts (`index.php`)**: Formatted data table rendering all contacts with category color tags.
  3. **Edit Contact (`edit_contact.php`)**: Pre-populated form to modify existing contact details.
  4. **Delete Contact (`delete_contact.php`)**: Deletion with mandatory JavaScript `confirm()` dialog before executing.
  5. **Search & Filter (`index.php`)**: Multi-field query search (by name, phone, or email) combined with category filtering.
- **Security**: Parameterized `mysqli` prepared statements preventing SQL injection attacks.

## 5. Technologies Used
- **Front-End**: HTML5, CSS3, JavaScript (modal deletion confirmation & input validation).
- **Back-End**: PHP (CRUD operations & prepared statements).
- **Database**: MySQL / MariaDB via phpMyAdmin (`iwt_exercise8`).
- **Server**: Apache via XAMPP.

## 6. Features
- **Complete CRUD Lifecycle**: Add, view, update, delete, and search operations verified and working.
- **Interactive Deletion Safeguard**: Browser confirmation prompt asks for user verification before deleting records.
- **Smart Category Tags**: Color-coded badges for Work (Blue), Family (Green), Friends (Amber), Academic (Purple), and Emergency (Red).
- **Live Search & Category Filtering**: Instantly filters contact records across names, phone numbers, and categories.
- **Auto-Generated Contact IDs**: Suggests sequential identifiers (`CNT-005` etc.) on the new contact form.

## 7. Folder and File Description
```
Exercise-08-Contact-Management/
├── index.php                   # Contact directory, search filter, and read table
├── add_contact.php             # New contact creation form (Create)
├── edit_contact.php            # Contact editing form (Update)
├── delete_contact.php          # Contact deletion action handler (Delete)
├── db.php                      # Database connection wrapper
├── style.css                   # Custom responsive CRUD interface styles
├── script.js                   # Client-side validation and deletion confirmation
├── database.sql                # MySQL schema and initial sample contacts
├── .env.example                # Sample database environment file
├── README.md                   # Complete exercise documentation
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- **XAMPP**: Apache & MySQL services.
- **PHP**: 7.4 or 8.x.
- **Modern Web Browser**: Chrome, Firefox, Edge, Safari.

## 9. Installation and Setup (XAMPP & phpMyAdmin)

### Step 1: Start XAMPP Services
1. Open **XAMPP Control Panel**.
2. Click **Start** for **Apache**.
3. Click **Start** for **MySQL**.

### Step 2: Import Database in phpMyAdmin
1. Navigate to `http://localhost/phpmyadmin/`
2. Click on the **Import** tab.
3. Choose `database.sql` from this directory.
4. Click **Import**.
5. The database `iwt_exercise8` and table `contacts` will be created with 4 demonstration records.

### Step 3: Deploy to XAMPP htdocs
Copy this directory to:
```
C:\xampp\htdocs\Exercise-08-Contact-Management\
```

## 10. How to Run
Open your web browser and navigate to:
```
http://localhost/Exercise-08-Contact-Management/
```

## 11. How to Test (Step-by-Step CRUD Verification)

### 1. View Contacts (Read)
- Navigate to `http://localhost/Exercise-08-Contact-Management/`.
- Verify the 4 seed contacts appear in the table with categories (Academic, Work, Family, Friends).

### 2. Search & Filter
- Type `Arvind` in the search box and click **Search**. Verify only Prof. Arvind Swaminathan is displayed.
- Select category `Family` and click **Search**. Verify Ramesh Sharma is displayed.
- Click **Reset** to restore full table view.

### 3. Add New Contact (Create)
- Click **+ Add New Contact** (or go to `add_contact.php`).
- Enter:
  * Full Name: `Siddharth Rao`
  * Phone: `9123456789`
  * Email: `siddharth.rao@techcorp.com`
  * Category: `Work`
  * Address: `55 Brigade Road, Bengaluru`
- Click **Save Contact Entry**.
- **Result**: You are redirected to `index.php` with a green alert: `✓ Contact created and saved successfully!` and Siddharth Rao appears in the table.

### 4. Edit Contact (Update)
- On Siddharth Rao's row, click **✏️ Edit**.
- Change phone number to `9988776655` and category to `Friends`.
- Click **Update Contact**.
- **Result**: You are redirected to `index.php` with a green alert: `✓ Contact details updated successfully!` and the changes reflect in the table.

### 5. Delete Contact (Delete)
- On Siddharth Rao's row, click **🗑️ Delete**.
- A browser confirmation popup appears: `"Are you sure you want to permanently delete the contact for 'Siddharth Rao'?"`
- Click **Cancel** -> The contact remains untouched.
- Click **🗑️ Delete** again -> Click **OK** -> The contact is deleted and a green banner appears: `✓ Contact entry deleted successfully!`.

## 12. Expected Output
A responsive Contact Management System supporting complete, error-free database CRUD operations, real-time search, category filtering, and safe confirmation dialogs.

## 13. Important Notes
- Built using native PHP and MySQL prepared statements for clean lab exam defense.
