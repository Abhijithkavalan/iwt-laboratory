# Exercise 09: Asynchronous Weather Application Using AJAX

## 1. Exercise Number
**Exercise 09**

## 2. Exercise Title
**Asynchronous Weather Application Using AJAX to Fetch and Display Meteorological Telemetry from a Hypothetical API**

## 3. Aim
To design, implement, and demonstrate an asynchronous weather application using AJAX (both modern Fetch API and traditional XMLHttpRequest) with JavaScript to query and render weather parameters dynamically from a hypothetical weather API without reloading the page.

## 4. Problem Statement
Develop an AJAX-driven weather client meeting the following specifications:
- **Interface**:
  * Application header and title
  * City search input field with trigger button
  * Quick-search city chips for fast demonstration
  * Dynamic loading status indicator (spinner)
  * Structured weather telemetry card
- **Meteorological Data Points Displayed**:
  * City and Country name
  * Temperature in Celsius (°C)
  * Atmospheric condition (e.g. Sunny, Pleasant, Rainy, Humid)
  * Weather description narrative
  * Humidity percentage (%)
  * Wind speed in km/h
  * Atmospheric pressure in hPa
  * Perceived temperature ("Feels like")
  * Visual weather icon / emoji representation
- **Technical & Security Requirements**:
  * Asynchronous HTTP data retrieval via AJAX without full page reloads.
  * Robust error handling for invalid cities, empty inputs, or network interruptions.
  * Separate API configuration block to support both local mock JSON and live API endpoints.
  * **Security**: Never commit private or paid API keys to GitHub.
  * Include a local `mock-weather.json` dataset covering multiple Indian and international cities for 100% dependable offline demonstration.

## 5. Technologies Used
- **HTML5**: Semantic document structuring, inputs, status badges.
- **CSS3**: Modern glassmorphic weather card, animated CSS loading spinner, flex chips, and responsive layout.
- **JavaScript (ES6)**: Asynchronous programming, DOM manipulation, JSON parsing, error boundaries.
- **AJAX**: Dual implementations demonstrating both `fetch()` API and `XMLHttpRequest` (XHR).

## 6. Features
- **Zero Full-Page Reloads**: All queries are executed in the background using asynchronous AJAX pipelines.
- **Dual AJAX Demonstration**: Supports switching between modern `Fetch API` and classic `XMLHttpRequest (XHR)` to illustrate both laboratory syllabus requirements.
- **Mock Dataset Included**: `mock-weather.json` features diverse cities (Bengaluru, Mumbai, New Delhi, Chennai, Kolkata, London, New York, Tokyo, Paris, Sydney).
- **Graceful Error States**: Clear warnings for non-existent cities and connection timeouts.
- **Live API Ready**: Pre-architected configuration object allowing easy swap to OpenWeatherMap.

## 7. Folder and File Description
```
Exercise-09-AJAX-Weather/
├── index.html                  # Main UI layout, search bar, and weather card
├── style.css                   # Custom responsive weather dashboard styles
├── script.js                   # AJAX Fetch & XHR engines, DOM mappers, and error handlers
├── mock-weather.json           # Hypothetical weather dataset for offline lab testing
├── README.md                   # Comprehensive exercise documentation
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- Any modern web browser (Google Chrome, Microsoft Edge, Firefox, Safari).
- Note: When opening files with AJAX `fetch()` or `XMLHttpRequest` reading local JSON, modern browser CORS policies require either running through a local web server (such as XAMPP `http://localhost/...`) or VS Code Live Server.

## 9. Installation and Setup

### Method 1: Using XAMPP (Recommended)
1. Ensure Apache is running in **XAMPP Control Panel**.
2. Copy this folder into your `htdocs` directory:
   ```
   C:\xampp\htdocs\Exercise-09-AJAX-Weather\
   ```
3. Open your browser and navigate to:
   ```
   http://localhost/Exercise-09-AJAX-Weather/
   ```

### Method 2: Using Python Quick Server
From inside the `Exercise-09-AJAX-Weather` directory:
```powershell
python -m http.server 8000
```
Open `http://localhost:8000/`.

## 10. How to Connect a Real Live Weather API (e.g. OpenWeatherMap)
To connect a real external API without exposing your personal API key on GitHub:
1. Register for a free API key at [OpenWeatherMap](https://openweathermap.org/api).
2. Open `script.js` and locate the `CONFIG` object at the top:
   ```javascript
   const CONFIG = {
       mode: 'live', // Change from 'mock' to 'live'
       liveApiEndpoint: 'https://api.openweathermap.org/data/2.5/weather',
       apiKey: 'YOUR_ACTUAL_API_KEY_HERE', // Insert your key locally
       units: 'metric'
   };
   ```
3. **IMPORTANT SECURITY NOTE**: Never commit `script.js` containing a real API key to GitHub. Keep `.gitignore` updated or create an external `config.local.js`.

## 11. How to Test
1. **Initial Load**:
   - On page launch, verify that "Bengaluru" is automatically retrieved and rendered via AJAX.
2. **City Search (Valid City)**:
   - Type `Mumbai` in the search box and press `Enter` or click **Search**.
   - Notice the loading spinner briefly appear.
   - Verify temperature (`31°C`), condition (`Humid`), humidity (`82%`), and wind speed (`18.5 km/h`) appear.
3. **Quick Select Chips**:
   - Click on the `London` chip. Confirm weather loads with temperature `14°C` and condition `Rainy`.
   - Click `Tokyo`. Confirm temperature `19.5°C` and condition `Clear`.
4. **Invalid City Test (Error Handling)**:
   - Type an invalid city name like `AtlantisCity` and click **Search**.
   - Verify that an informative red banner appears: `Notice: City "atlantiscity" not found in hypothetical weather registry.`
5. **Empty Input Guard**:
   - Clear the input box and click **Search**.
   - Verify alert: `Notice: Please enter a city name to search.`
6. **XHR vs Fetch Toggle**:
   - Click the **XMLHttpRequest (XHR)** button at the bottom and search for `Paris`.
   - Verify the top badge updates to `Protocol: AJAX via XMLHttpRequest (XHR)` and data loads accurately.

## 12. Expected Output
A responsive single-page weather application that asynchronously fetches JSON weather metrics, handles loading and error states cleanly, and displays comprehensive climate information without refreshing the page.

## 13. Important Notes
- Satisfies all IWT lab requirements for AJAX communication, DOM injection, and mock API independence.
