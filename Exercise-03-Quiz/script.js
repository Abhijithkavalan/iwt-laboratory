/**
 * IWT Exercise 03: Web Technologies Quiz Engine
 * Technologies: HTML5, CSS3, JavaScript (ES6)
 * Contains exactly 20 Multiple Choice Questions with 4 options each
 */

const quizData = [
    {
        id: 1,
        question: "What does HTML stand for?",
        options: [
            "Hyperlinks and Text Markup Language",
            "HyperText Markup Language",
            "Home Tool Markup Language",
            "Hyper Tooling Management Language"
        ],
        correct: 1,
        explanation: "HTML stands for HyperText Markup Language, the standard markup language for documents designed to be displayed in a web browser."
    },
    {
        id: 2,
        question: "Which HTML5 semantic tag is used to specify a footer for a document or section?",
        options: [
            "<bottom>",
            "<foot>",
            "<footer>",
            "<section-footer>"
        ],
        correct: 2,
        explanation: "The <footer> tag defines a footer for a document or section, typically containing author, copyright, or contact information."
    },
    {
        id: 3,
        question: "What is the correct HTML element for inserting a line break?",
        options: [
            "<lb>",
            "<break>",
            "<br>",
            "<newline>"
        ],
        correct: 2,
        explanation: "<br> produces a line break in text (carriage-return) without creating a new paragraph."
    },
    {
        id: 4,
        question: "Which HTML attribute is used to define inline CSS styles?",
        options: [
            "class",
            "styles",
            "font",
            "style"
        ],
        correct: 3,
        explanation: "The 'style' attribute is used to apply CSS rules directly inside an HTML element tag."
    },
    {
        id: 5,
        question: "What does CSS stand for?",
        options: [
            "Creative Style Sheets",
            "Cascading Style Sheets",
            "Computer Style Syntax",
            "Colorful Style Spread"
        ],
        correct: 1,
        explanation: "CSS stands for Cascading Style Sheets, used to style and layout web pages."
    },
    {
        id: 6,
        question: "Which CSS property is used to change the background color of an element?",
        options: [
            "color",
            "bgcolor",
            "background-color",
            "surface-color"
        ],
        correct: 2,
        explanation: "'background-color' sets the background color of an element, whereas 'color' sets the foreground text color."
    },
    {
        id: 7,
        question: "In CSS Flexbox, which property aligns flex items along the cross axis?",
        options: [
            "justify-content",
            "align-items",
            "flex-direction",
            "align-content"
        ],
        correct: 1,
        explanation: "'align-items' aligns flex items along the cross axis, while 'justify-content' aligns them along the main axis."
    },
    {
        id: 8,
        question: "Which CSS selector targets all elements with the class 'highlight'?",
        options: [
            "#highlight",
            "*highlight",
            ".highlight",
            ":highlight"
        ],
        correct: 2,
        explanation: "In CSS, a period (.) denotes a class selector, whereas a hash (#) denotes an ID selector."
    },
    {
        id: 9,
        question: "Which JavaScript keyword is used to declare a block-scoped variable that cannot be reassigned?",
        options: [
            "var",
            "let",
            "constant",
            "const"
        ],
        correct: 3,
        explanation: "'const' creates a block-scoped constant whose reference cannot be reassigned after initialization."
    },
    {
        id: 10,
        question: "What is the evaluated output of typeof null in JavaScript?",
        options: [
            "'null'",
            "'undefined'",
            "'object'",
            "'boolean'"
        ],
        correct: 2,
        explanation: "Due to a historical design quirk in JavaScript, typeof null evaluates to 'object'."
    },
    {
        id: 11,
        question: "Which built-in JavaScript method parses a JSON string into an object?",
        options: [
            "JSON.stringify()",
            "JSON.parse()",
            "JSON.toObject()",
            "JSON.decode()"
        ],
        correct: 1,
        explanation: "JSON.parse() parses a JSON-formatted string and constructs the corresponding JavaScript value or object."
    },
    {
        id: 12,
        question: "Which method is the recommended modern way to attach an event handler in JavaScript?",
        options: [
            "attachEvent()",
            "addEventListener()",
            "listen()",
            "registerEvent()"
        ],
        correct: 1,
        explanation: "'addEventListener()' is the standard DOM Level 2 method for registering event handlers on elements."
    },
    {
        id: 13,
        question: "What does DOM stand for in Web Development?",
        options: [
            "Document Object Model",
            "Digital Ordinance Mechanism",
            "Desktop Oriented Markup",
            "Data Operational Module"
        ],
        correct: 0,
        explanation: "DOM stands for Document Object Model, an application programming interface (API) for HTML and XML documents."
    },
    {
        id: 14,
        question: "Which HTTP status code indicates a successful request in the HTTP protocol?",
        options: [
            "404",
            "500",
            "301",
            "200"
        ],
        correct: 3,
        explanation: "HTTP 200 OK indicates that the request has succeeded."
    },
    {
        id: 15,
        question: "Which HTML tag is correctly used to link an external CSS stylesheet?",
        options: [
            "<style src='style.css'>",
            "<link rel='stylesheet' href='style.css'>",
            "<stylesheet>style.css</stylesheet>",
            "<script href='style.css'>"
        ],
        correct: 1,
        explanation: "The <link rel='stylesheet' href='style.css'> tag inside <head> links an external stylesheet."
    },
    {
        id: 16,
        question: "Which CSS property specifies the stack order of an element on the z-axis?",
        options: [
            "z-index",
            "stack-level",
            "elevation",
            "order"
        ],
        correct: 0,
        explanation: "'z-index' specifies the stack order of positioned elements; higher numbers appear in front of lower numbers."
    },
    {
        id: 17,
        question: "What is the strict equality comparison operator in JavaScript?",
        options: [
            "==",
            "===",
            "=",
            "!="
        ],
        correct: 1,
        explanation: "The '===' operator checks for equality without type coercion (compares both value and type)."
    },
    {
        id: 18,
        question: "Which JavaScript Array method returns a new array containing all elements that satisfy a condition?",
        options: [
            "map()",
            "forEach()",
            "find()",
            "filter()"
        ],
        correct: 3,
        explanation: "'filter()' creates a shallow copy of a portion of a given array filtered down to elements that pass the test implemented by the provided function."
    },
    {
        id: 19,
        question: "Which HTML element is used to embed or reference client-side JavaScript code?",
        options: [
            "<javascript>",
            "<script>",
            "<js>",
            "<code>"
        ],
        correct: 1,
        explanation: "The <script> tag is used to define a client-side script or link an external JavaScript file via its 'src' attribute."
    },
    {
        id: 20,
        question: "In the CSS Box Model, which layer is located immediately between padding and margin?",
        options: [
            "content",
            "outline",
            "border",
            "box-sizing"
        ],
        correct: 2,
        explanation: "From inside out, the CSS Box Model consists of: Content -> Padding -> Border -> Margin."
    }
];

// User selections dictionary: { questionIndex: selectedOptionIndex }
let userAnswers = {};

// DOM Elements
const quizContainer = document.getElementById('quiz-questions-container');
const submitBtn = document.getElementById('submit-quiz-btn');
const resetBtn = document.getElementById('restart-quiz-btn');
const resultSection = document.getElementById('result-section');
const quizSection = document.getElementById('quiz-section');
const progressTracker = document.getElementById('answered-counter');

/**
 * Initializes and renders all 20 questions into the DOM
 */
function renderQuiz() {
    quizContainer.innerHTML = '';
    userAnswers = {};
    updateProgress();

    quizData.forEach((q, index) => {
        const card = document.createElement('article');
        card.className = 'question-card';
        card.id = `q-card-${index}`;

        const questionTitle = document.createElement('h3');
        questionTitle.className = 'question-title';
        questionTitle.innerHTML = `<span class="q-number">Q${index + 1}.</span> ${q.question}`;
        card.appendChild(questionTitle);

        const optionsContainer = document.createElement('div');
        optionsContainer.className = 'options-list';

        q.options.forEach((opt, optIndex) => {
            const label = document.createElement('label');
            label.className = 'option-label';
            label.setAttribute('for', `q${index}_opt${optIndex}`);

            const radio = document.createElement('input');
            radio.type = 'radio';
            radio.name = `question_${index}`;
            radio.id = `q${index}_opt${optIndex}`;
            radio.value = optIndex;

            radio.addEventListener('change', () => {
                selectOption(index, optIndex);
            });

            const optionChar = String.fromCharCode(65 + optIndex); // A, B, C, D
            const textSpan = document.createElement('span');
            textSpan.className = 'option-text';
            textSpan.innerHTML = `<strong>${optionChar}.</strong> ${opt}`;

            label.appendChild(radio);
            label.appendChild(textSpan);
            optionsContainer.appendChild(label);
        });

        card.appendChild(optionsContainer);
        quizContainer.appendChild(card);
    });
}

/**
 * Handles option selection and updates UI styling and progress
 */
function selectOption(qIndex, optIndex) {
    userAnswers[qIndex] = optIndex;

    const card = document.getElementById(`q-card-${qIndex}`);
    card.classList.add('answered');

    // Highlight selected option within this question card
    const labels = card.querySelectorAll('.option-label');
    labels.forEach((lbl, idx) => {
        if (idx === optIndex) {
            lbl.classList.add('selected');
        } else {
            lbl.classList.remove('selected');
        }
    });

    updateProgress();
}

/**
 * Updates answered count tracker
 */
function updateProgress() {
    const answeredCount = Object.keys(userAnswers).length;
    progressTracker.textContent = `${answeredCount} of ${quizData.length} Answered`;
}

/**
 * Validates, calculates score and presents detailed results
 */
function submitQuiz() {
    const totalQuestions = quizData.length;
    const answeredCount = Object.keys(userAnswers).length;

    if (answeredCount < totalQuestions) {
        const unanswered = totalQuestions - answeredCount;
        const confirmSubmit = confirm(`You have ${unanswered} unanswered question(s). Are you sure you want to submit the quiz?`);
        if (!confirmSubmit) {
            return;
        }
    }

    let correctCount = 0;
    let wrongCount = 0;
    let unattemptedCount = 0;

    quizData.forEach((q, index) => {
        if (userAnswers[index] === undefined) {
            unattemptedCount++;
        } else if (userAnswers[index] === q.correct) {
            correctCount++;
        } else {
            wrongCount++;
        }
    });

    const score = correctCount;
    const percentage = ((score / totalQuestions) * 100).toFixed(1);

    // Populate score breakdown
    document.getElementById('stat-total').textContent = totalQuestions;
    document.getElementById('stat-correct').textContent = correctCount;
    document.getElementById('stat-wrong').textContent = wrongCount;
    document.getElementById('stat-unattempted').textContent = unattemptedCount;
    document.getElementById('stat-score').textContent = `${score} / ${totalQuestions}`;
    document.getElementById('stat-percentage').textContent = `${percentage}%`;

    // Grade and Badge Feedback
    const badge = document.getElementById('performance-badge');
    let badgeClass = 'badge-success';
    let feedbackText = '';

    if (percentage >= 85) {
        badgeClass = 'badge-excellent';
        feedbackText = 'Outstanding Performance! Excellent mastery of Web Technologies.';
    } else if (percentage >= 65) {
        badgeClass = 'badge-good';
        feedbackText = 'Good Job! You have a solid foundational understanding.';
    } else if (percentage >= 40) {
        badgeClass = 'badge-average';
        feedbackText = 'Fair Effort! Review the explanations below to improve your concepts.';
    } else {
        badgeClass = 'badge-needs-improvement';
        feedbackText = 'Needs Improvement. Please revise HTML, CSS, and JavaScript basics.';
    }

    badge.className = `badge ${badgeClass}`;
    badge.textContent = `${percentage}% - ${feedbackText}`;

    // Render Answer Key Review Section
    renderAnswerReview();

    // Toggle view
    quizSection.style.display = 'none';
    resultSection.style.display = 'block';

    // Scroll to results top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/**
 * Builds the comprehensive answer breakdown review
 */
function renderAnswerReview() {
    const reviewContainer = document.getElementById('review-list-container');
    reviewContainer.innerHTML = '';

    quizData.forEach((q, index) => {
        const selectedOpt = userAnswers[index];
        const isCorrect = selectedOpt === q.correct;
        const isUnattempted = selectedOpt === undefined;

        const item = document.createElement('div');
        item.className = `review-item ${isCorrect ? 'review-correct' : (isUnattempted ? 'review-unattempted' : 'review-wrong')}`;

        const questionHeading = document.createElement('h4');
        questionHeading.innerHTML = `Q${index + 1}: ${q.question}`;
        item.appendChild(questionHeading);

        const statusTag = document.createElement('div');
        statusTag.className = 'status-tag';
        if (isCorrect) {
            statusTag.innerHTML = `<span class="text-correct">&#10004; Correct</span>`;
        } else if (isUnattempted) {
            statusTag.innerHTML = `<span class="text-unattempted">&#9888; Not Attempted</span>`;
        } else {
            statusTag.innerHTML = `<span class="text-wrong">&#10008; Incorrect</span>`;
        }
        item.appendChild(statusTag);

        const details = document.createElement('div');
        details.className = 'review-details';

        const userText = isUnattempted ? 'None' : `${String.fromCharCode(65 + selectedOpt)}. ${q.options[selectedOpt]}`;
        const correctText = `${String.fromCharCode(65 + q.correct)}. ${q.options[q.correct]}`;

        details.innerHTML = `
            <p><strong>Your Answer:</strong> <span class="${isCorrect ? 'text-correct' : 'text-wrong'}">${userText}</span></p>
            <p><strong>Correct Answer:</strong> <span class="text-correct">${correctText}</span></p>
            <p class="explanation-box"><strong>Explanation:</strong> ${q.explanation}</p>
        `;

        item.appendChild(details);
        reviewContainer.appendChild(item);
    });
}

/**
 * Restarts the quiz back to the initial blank state
 */
function restartQuiz() {
    resultSection.style.display = 'none';
    quizSection.style.display = 'block';
    renderQuiz();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Event Listeners
submitBtn.addEventListener('click', submitQuiz);
resetBtn.addEventListener('click', restartQuiz);

// Initial Load
document.addEventListener('DOMContentLoaded', () => {
    renderQuiz();
});
