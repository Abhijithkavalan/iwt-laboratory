# Exercise 03: Interactive Web Technologies Quiz

## 1. Exercise Number
**Exercise 03**

## 2. Exercise Title
**Interactive 20-Question Quiz Application with Automated Score Assessment Using JavaScript**

## 3. Aim
To develop a responsive, client-side online quiz application consisting of exactly 20 multiple-choice questions (4 options each) covering HTML, CSS, JavaScript, and web fundamentals, with automated score calculation, percentage display, answer verification, and restart functionality.

## 4. Problem Statement
Develop a quiz application adhering to the following criteria:
- Exactly 20 multiple choice questions.
- Every question must provide 4 distinct options (A, B, C, D).
- Questions must cover HTML, CSS, JavaScript, DOM, and HTTP basics.
- Answer selections must be captured and managed dynamically via JavaScript.
- A live progress indicator must show how many questions have been answered.
- A "Submit Quiz" button must validate submission and prevent unintended premature submissions.
- At the end of the quiz, display:
  * Total questions (20)
  * Number of correct answers
  * Number of wrong answers
  * Number of unattempted questions
  * Total score obtained
  * Percentage achieved (%)
  * Performance badge (Outstanding, Good, Average, Needs Improvement)
  * Detailed answer breakdown showing user answer, correct answer, and explanation for all 20 questions
- Provide a "Restart Quiz" button to reset the quiz state without reloading the browser.
- No database or backend required.

## 5. Technologies Used
- **HTML5**: Document structure, headings, form labels, radio inputs.
- **CSS3**: Card layouts, custom radio button wrappers, progress pill, color-coded badges, and review styles.
- **JavaScript (ES6)**: State management, event handling, DOM manipulation, score computation, and answer breakdown rendering.

## 6. Features
- **Strict 20-Question Bank**: Curated questions on core web development topics.
- **Real-Time Progress Tracking**: Dynamic counter indicates answered questions in real-time.
- **Safe Score Calculation**: Accurate tracking of correct, incorrect, and unattempted questions.
- **Educational Review**: Explains the rationale behind each correct answer upon quiz completion.
- **Instant Reset**: Clear all inputs and retake the test seamlessly.

## 7. Folder and File Description
```
Exercise-03-Quiz/
├── index.html                  # Main quiz structure and results template
├── style.css                   # Custom styles, responsive grid, and score badges
├── script.js                   # 20 questions data array, scoring logic, and DOM events
├── README.md                   # Comprehensive exercise documentation
└── .gitignore                  # Git ignore rules
```

## 8. Requirements
- Any modern web browser (Google Chrome, Microsoft Edge, Mozilla Firefox, Safari).
- Completely client-side; no server or database needed.

## 9. Installation and Setup
1. Clone or download the repository to your local system.
2. Ensure `index.html`, `style.css`, and `script.js` reside in the same folder.

## 10. How to Run
- Double-click `index.html` to launch in your default web browser.
- Or open your browser and drag-and-drop `index.html` into a new tab.

## 11. How to Test
1. **Initial State Verification**:
   - Verify that 20 questions are displayed, each having 4 options labeled A, B, C, D.
   - Check the top progress badge: "0 of 20 Answered".
2. **Interactive Selection**:
   - Click options across several questions. Confirm the selected option highlights and the progress counter increments.
3. **Submission Guard**:
   - Click "Submit Quiz" before answering all 20 questions. Confirm a confirmation dialog informs you of unanswered questions.
4. **Score Evaluation**:
   - Answer all 20 questions and click "Submit Quiz".
   - Verify the score summary shows:
     * Total Questions: 20
     * Correct Answers + Wrong Answers + Unattempted = 20
     * Final Score matches correct answers
     * Percentage calculation is accurate: `(Score / 20) * 100`
5. **Answer Key Review**:
   - Scroll down to review the color-coded feedback cards (Green for correct, Red for wrong, Yellow for unattempted) along with explanation text.
6. **Restart Quiz**:
   - Click "Restart Quiz". Confirm the quiz resets to Question 1, unselects all radios, and sets progress back to "0 of 20 Answered".

## 12. Expected Output
A clean, interactive quiz layout that dynamically computes your grade upon submission, displays full diagnostic metrics (correct, incorrect, unattempted, percentage), and presents an answer key with explanations.

## 13. Important Notes
- All 20 questions are stored in a JavaScript array of objects for clean maintenance and fast offline execution.
- Suitable for lab exams, viva voce tests, and classroom demonstration.
