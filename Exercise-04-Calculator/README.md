# Exercise 04: Scientific & Basic Calculator

## 1. Exercise Number
**Exercise 04**

## 2. Exercise Title
**Responsive Scientific & Basic Calculator Using HTML, CSS, and JavaScript**

## 3. Aim
To design and implement a responsive, visually appealing, and feature-rich online scientific calculator capable of executing standard arithmetic, trigonometric, logarithmic, exponential, root, constant, and percentage operations with input validation and zero-division error handling.

## 4. Problem Statement
Develop a scientific calculator supporting:
- **Basic Arithmetic**:
  * Addition (`+`)
  * Subtraction (`-`)
  * Multiplication (`×`)
  * Division (`÷`)
  * Percentage (`%`)
  * Decimal point (`.`)
  * Grouping Parentheses (`(` and `)`)
- **Scientific Operations**:
  * Trigonometric functions: `sin`, `cos`, `tan`
  * Square root: `sqrt` (`√`)
  * Exponential / Power: `power` (`xʸ` / `^`)
  * Common Logarithm: `log` (base-10)
  * Natural Logarithm: `ln` (base-e)
  * Constants: Pi (`π` ≈ 3.14159) and Euler's constant (`e` ≈ 2.71828)
- **Control & Utility Functions**:
  * All Clear (`AC`)
  * Delete/Backspace (`DEL`)
  * Evaluate/Equals (`=`)
  * Sign inversion (`±`)
  * DEG/RAD angle mode toggle
  * Calculation history tape
- **Robust Error Handling**:
  * Gracefully intercept and display "Error: Division by zero"
  * Prevent syntax crashes by displaying "Error: Invalid Expression"
- No backend required; runs completely in the browser.

## 5. Technologies Used
- **HTML5**: Calculator chassis, dual-line display, semantic grid buttons.
- **CSS3**: Dark console aesthetic, CSS Grid (5 columns), glassmorphism borders, active touch states, and responsive media queries.
- **JavaScript (ES6)**: Object-oriented calculator engine, lexical replacement of math tokens, precision rounding, keyboard event listeners, and calculation history.

## 6. Features
- **Dual-Line Display**: Shows the active math formula on the top line and computed result on the primary line.
- **DEG/RAD Angle Switch**: Toggle between Degrees (standard in student coursework) and Radians for trigonometry.
- **Precision Floating Point Fixes**: Automatically rounds binary floating-point artifacts (e.g. `0.1 + 0.2 = 0.3`, `sin(30) = 0.5`).
- **Full Keyboard Accessibility**: Type numbers and operators directly using your computer keyboard (`Enter` for equals, `Esc` for clear, `Backspace` for delete).
- **Calculation History**: Maintains a log of recent operations.

## 7. Folder and File Description
```
Exercise-04-Calculator/
├── index.html                  # Calculator structure, display screen, and button layout
├── style.css                   # Dark console UI styling and CSS Grid
├── script.js                   # Mathematical engine, parsing rules, and event handlers
├── README.md                   # Complete exercise documentation
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- Any modern web browser (Google Chrome, Microsoft Edge, Mozilla Firefox, Safari).
- No external libraries, plugins, or web server needed.

## 9. Installation and Setup
1. Clone or download the repository to your local system.
2. Ensure `index.html`, `style.css`, and `script.js` are stored in the same folder.

## 10. How to Run
- Double-click `index.html` to open in your default browser.
- Or right-click `index.html` -> **Open With** -> Select **Google Chrome**.

## 11. How to Test
1. **Basic Arithmetic**:
   - Calculate `25 + 75` -> Press `=` -> Result: `100`
   - Calculate `100 - 45.5` -> Press `=` -> Result: `54.5`
   - Calculate `12 × 12` -> Press `=` -> Result: `144`
   - Calculate `200 ÷ 8` -> Press `=` -> Result: `25`
2. **Division by Zero Protection**:
   - Type `50 ÷ 0` -> Press `=` -> Verify message: `Error: Division by zero`.
3. **Trigonometric Functions**:
   - Ensure mode is `DEG`.
   - Click `sin`, enter `30`, close `)` -> Press `=` -> Result: `0.5`
   - Click `cos`, enter `60`, close `)` -> Press `=` -> Result: `0.5`
   - Click `tan`, enter `45`, close `)` -> Press `=` -> Result: `1`
4. **Roots, Powers & Constants**:
   - Click `√`, enter `144`, close `)` -> Press `=` -> Result: `12`
   - Type `2`, click `xʸ`, enter `8` -> Press `=` -> Result: `256`
   - Type `π` -> Press `=` -> Result: `3.1415926536`
   - Click `ln`, type `e`, close `)` -> Press `=` -> Result: `1`
5. **Editing Controls**:
   - Type `12345` -> Click `DEL` -> Displays `1234`.
   - Click `AC` -> Displays `0`.
   - Type `50` -> Click `±` -> Displays `(-50)`.
6. **Keyboard Input**:
   - Press numbers `1` to `9`, `+`, `-`, `*`, `/`, `Enter` directly on physical keyboard.

## 12. Expected Output
A responsive dark-themed scientific calculator that renders an interactive LCD-style display, supports 25+ mathematical operations, maintains a calculation history, and provides clear error messages for invalid operations.

## 13. Important Notes
- Code is written cleanly using ES6 Class architecture for easy explanation during laboratory viva examinations.
