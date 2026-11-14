# Exercise 10: Fetch and Display Books Using jQuery AJAX

## 1. Exercise Number
**Exercise 10**

## 2. Exercise Title
**Asynchronous Books Catalog Data Retrieval and Dynamic Display Using jQuery $.ajax()**

## 3. Aim
To design and implement an asynchronous web interface utilizing jQuery's `$.ajax()` method to execute HTTP GET requests against a hypothetical Books API, parse the resulting JSON data, and dynamically render formatted book cards with full error, loading, and filtering states.

## 4. Problem Statement
Develop a Books API client using jQuery conforming to the following criteria:
- **Interface**:
  * Page title and academic branding
  * "Load Books" trigger button
  * Animated loading indicator / spinner
  * Book cards display container
- **Required jQuery Implementation**:
  * Execute an asynchronous HTTP GET request using `$.ajax()`.
  * Define explicit callback handlers: `beforeSend`, `success`, `error`, and `complete`.
  * Retrieve and parse JSON telemetry.
  * Dynamically generate and append HTML DOM nodes using jQuery methods (`$()`, `.empty()`, `.append()`, `.fadeIn()`).
- **Book Attributes Displayed**:
  * Book Title
  * Author(s)
  * ISBN Number
  * Publication Year
  * Detailed Description
  * Subject Category / Genre tag
  * Star Rating & Page Count
- **State Handling**:
  * **Loading State**: Displays animated spinner and disables button during network transit.
  * **Success State**: Injects all retrieved books into a responsive grid.
  * **Empty State**: Informs user when zero records match query.
  * **Error State**: Displays detailed HTTP status code and diagnostic errors if endpoint is unreachable.
- **Hypothetical API Independence**:
  * Provide a local `books.json` dataset for 100% dependable offline laboratory execution.
  * Document how to seamlessly substitute a live external API (such as Google Books API or Open Library).

## 5. Technologies Used
- **HTML5**: Responsive semantics and structured controls toolbar.
- **CSS3**: CSS Grid, book cards with hover elevation, category pills, and CSS keyframe loading spinner.
- **jQuery (v3.7.1)**: Bundled locally for offline capability (`jquery.min.js`), utilizing `$.ajax()`, DOM event listeners, and iterative element appending (`$.each`).
- **JSON**: Structured hypothetical API dataset (`books.json`).

## 6. Features
- **Strict jQuery $.ajax() Implementation**: Uses native jQuery AJAX pipelines rather than raw fetch to satisfy curriculum requirements.
- **Local jQuery Bundle**: Works offline without requiring internet access during practical examinations.
- **Comprehensive Lifecycle Callbacks**: Demonstrates `beforeSend` (loader), `success` (DOM rendering), `error` (network failure interceptor), and `complete`.
- **Live Search & Category Filter**: Interactively filter loaded books by title, author, or category in real-time.
- **Modal Book Inspection**: Quick inspect button for each individual book card.

## 7. Folder and File Description
```
Exercise-10-jQuery-Books/
├── index.html                  # Main UI structure, toolbar, and books display grid
├── style.css                   # Custom responsive library-themed styling
├── script.js                   # jQuery $.ajax() logic, event listeners, and renderers
├── books.json                  # Hypothetical books JSON database (8 classic texts)
├── jquery.min.js               # Bundled official jQuery v3.7.1 for offline lab testing
├── README.md                   # Full exercise documentation
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- Any modern web browser (Google Chrome, Microsoft Edge, Mozilla Firefox, Safari).
- To adhere to browser CORS policies when making AJAX requests to local JSON files, run via XAMPP Apache (`http://localhost/...`) or a local development server.

## 9. Installation and Setup

### Method 1: Using XAMPP (Recommended for Lab)
1. Ensure Apache is running in **XAMPP Control Panel**.
2. Copy this folder into your `htdocs` directory:
   ```
   C:\xampp\htdocs\Exercise-10-jQuery-Books\
   ```
3. Open your browser and navigate to:
   ```
   http://localhost/Exercise-10-jQuery-Books/
   ```

### Method 2: Using Python Quick Server
From inside the `Exercise-10-jQuery-Books` directory:
```powershell
python -m http.server 8000
```
Open `http://localhost:8000/`.

## 10. How to Connect a Real Live Books API (e.g. Google Books API)
To replace the hypothetical mock endpoint with Google Books API:
1. Open `script.js`.
2. Locate the `API_CONFIG` object:
   ```javascript
   const API_CONFIG = {
       mode: 'live', // Change from 'mock' to 'live'
       mockUrl: 'books.json',
       liveGoogleBooksUrl: 'https://www.googleapis.com/books/v1/volumes?q=computer+science'
   };
   ```
3. The script automatically handles the Google Books API data schema transformation.

## 11. How to Test
1. **Initial Load / Auto-Fetch**:
   - Open the application. Notice that `$.ajax()` executes automatically, displaying the spinner briefly before loading 8 computer science classics.
2. **"Load Books ($.ajax)" Button Test**:
   - Click **Clear Display** to clear the current list.
   - Click **Load Books ($.ajax)**.
   - Verify that:
     * The button becomes disabled and shows `⏳ Fetching Books via $.ajax()...`.
     * The animated spinner displays.
     * The green alert appears: `✓ Successfully loaded 8 books via jQuery $.ajax() GET request (HTTP Status: 200 OK)`.
     * All 8 book cards render with Titles, Authors, ISBNs, Publication Years, Categories, Ratings, and Descriptions.
3. **Search & Filter Test**:
   - In the search box, type `Martin`. Confirm only "Clean Code" (Uncle Bob) and "Designing Data-Intensive Applications" (Martin Kleppmann) remain visible.
   - Select category `Networking`. Confirm only Tanenbaum's "Computer Networks" is displayed.
4. **Inspect Button**:
   - Click **Inspect** on any book card to trigger an alert displaying title, author, and ISBN details.
5. **Error Simulation**:
   - In `script.js`, temporarily change `mockUrl: 'invalid-file.json'`.
   - Click **Load Books**. Verify the red error banner appears: `API Request Failed! Status: 404 (error)`.

## 12. Expected Output
A responsive, modern digital library portal that executes jQuery `$.ajax()` GET queries, displays loading spinners, handles response statuses, and presents detailed book information cards with interactive filters.

## 13. Important Notes
- Satisfies all criteria for jQuery AJAX GET data fetching, JSON parsing, error states, and DOM generation.
