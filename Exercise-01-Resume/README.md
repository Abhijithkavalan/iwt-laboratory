# Exercise 01: Resume Webpage

## 1. Exercise Number
**Exercise 01**

## 2. Exercise Title
**Static Student Resume Webpage Using HTML**

## 3. Aim
To design and develop a professional, clean, and semantic static student resume webpage including a local profile image, educational qualifications table, skills lists, project summaries, and a declaration block using pure HTML.

## 4. Problem Statement
Create a static HTML webpage presenting a comprehensive student resume. The webpage must include:
- Profile photo
- Full Name and Title
- Career Objective
- Contact Details
- Educational Qualifications (tabular representation)
- Technical Skills (categorized list)
- Academic Projects
- Certifications
- Hobbies and Extracurricular Interests
- Key Achievements
- Declaration Statement with date, place, and signature space

Semantic HTML elements (`<header>`, `<main>`, `<section>`, `<article>`, `<figure>`, `<table>`, `<ul>`, `<address>`, `<footer>`) must be utilized effectively without requiring a web server or backend.

## 5. Technologies Used
- **HTML5**: Semantic document structuring, tables, lists, and metadata.
- **CSS3 (Embedded)**: Clean typographic hierarchy, responsive layout, table borders, and styling suited for academic evaluation.

## 6. Features
- **Semantic HTML Structure**: Clear separation of document regions using standard HTML5 tags.
- **Embedded Local Image**: Profile photo integrated via relative path (`assets/images/profile.jpg`).
- **Formatted Qualifications Table**: Clean, bordered table with headers for degrees, institutions, boards, passing years, and scores.
- **Categorized Skills Grid**: Structured lists for Programming Languages, Web Technologies, and Tools.
- **Declaration Block**: Formal academic declaration with place, date, and applicant signature.
- **Zero Server Dependency**: Opens directly in any web browser without needing XAMPP or local server execution.

## 7. Folder and File Description
```
Exercise-01-Resume/
├── index.html                  # Main HTML resume webpage
├── README.md                   # Comprehensive exercise documentation
├── .gitignore                  # Git ignore configuration
└── assets/
    └── images/
        └── profile.jpg         # Local profile photograph
```

## 8. Requirements
- Any modern web browser (Google Chrome, Mozilla Firefox, Microsoft Edge, Safari, or Brave).
- No web server, database, or backend installation required.

## 9. Installation and Setup
1. Clone or download the repository to your local system.
2. Ensure the directory structure retains the `assets/images/profile.jpg` relative file path.

## 10. How to Run
- Double-click `index.html` to open it in your default web browser.
- Alternatively, right-click `index.html` -> **Open With** -> Select **Google Chrome** (or any browser).
- Or from the terminal/command prompt:
  ```powershell
  Start-Process "index.html"
  ```

## 11. How to Test
1. **Header & Profile Picture Verification**:
   - Verify that the profile picture loads correctly from `assets/images/profile.jpg`.
   - Verify that the student's name, subtitle, and contact details appear properly.
2. **Contact Links**:
   - Check the mailto link (`mailto:rahul.sharma@example.com`).
   - Check external profile links (LinkedIn and GitHub).
3. **Table Verification**:
   - Check the Educational Qualifications table. Ensure all 5 columns (Degree, Institution, Board/University, Year of Passing, Score) display properly with alternating row highlights.
4. **Skills & Projects**:
   - Confirm all technical skills categories and bullet points render cleanly.
   - Inspect project titles, tech tags, and descriptive points.
5. **Declaration & Signature**:
   - Verify the declaration text, place, date, and signature block display at the bottom.
6. **Browser Console**:
   - Press `F12` to open Developer Tools and confirm there are zero 404 errors or warnings.

## 12. Expected Output
A well-structured, visually appealing, single-page student resume featuring a circular profile image at the top right, contact details on the top left, neat section divider lines, a table for academic records, organized skill boxes, project descriptions, and a formal signed declaration.

## 13. Important Notes
- This is a static HTML laboratory exercise designed for practical demonstration.
- No external CDN or framework dependencies are used, ensuring 100% offline usability.
