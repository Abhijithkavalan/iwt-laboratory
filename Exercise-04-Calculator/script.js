/**
 * IWT Exercise 04: Scientific Calculator Engine
 * Technologies: HTML5, CSS3, JavaScript (ES6)
 * Supports basic arithmetic, advanced scientific operations, DEG/RAD modes, and robust error handling.
 */

class ScientificCalculator {
    constructor() {
        this.expression = '';
        this.result = '0';
        this.isDegreeMode = true; // Default to DEG (Degrees) for MCA lab expectation
        this.history = [];

        // DOM elements
        this.exprDisplay = document.getElementById('expression-display');
        this.resultDisplay = document.getElementById('result-display');
        this.degRadIndicator = document.getElementById('angle-mode');
        this.historyList = document.getElementById('history-list');

        this.updateDisplay();
    }

    /**
     * Appends a character or function token to the expression
     */
    append(token) {
        // Prevent multiple consecutive operators
        const operators = ['+', '-', '×', '÷', '%', '^'];
        const lastChar = this.expression.slice(-1);

        if (operators.includes(token) && operators.includes(lastChar)) {
            // Replace the last operator instead of appending another
            this.expression = this.expression.slice(0, -1) + token;
            this.updateDisplay();
            return;
        }

        // Auto-close previous result if starting new number
        if (this.result !== '0' && this.expression === '' && !operators.includes(token)) {
            this.result = '0';
        }

        this.expression += token;
        this.updateDisplay();
    }

    /**
     * Appends scientific functions with opening parenthesis
     */
    appendFunction(func) {
        this.expression += `${func}(`;
        this.updateDisplay();
    }

    /**
     * Clears all expressions and resets calculator state
     */
    clearAll() {
        this.expression = '';
        this.result = '0';
        this.updateDisplay();
    }

    /**
     * Deletes the last character from the current expression
     */
    deleteLast() {
        if (this.expression.length > 0) {
            // Check if deleting a multi-character function name like 'sin(', 'cos(', 'sqrt('
            const funcs = ['sin(', 'cos(', 'tan(', 'log(', 'ln(', 'sqrt('];
            let matchedFunc = false;
            for (const f of funcs) {
                if (this.expression.endsWith(f)) {
                    this.expression = this.expression.slice(0, -f.length);
                    matchedFunc = true;
                    break;
                }
            }
            if (!matchedFunc) {
                this.expression = this.expression.slice(0, -1);
            }
        }
        this.updateDisplay();
    }

    /**
     * Toggles positive/negative sign of current expression or number
     */
    toggleSign() {
        if (!this.expression) {
            if (this.result !== '0') {
                this.expression = `(-${this.result})`;
            } else {
                this.expression = '(-';
            }
        } else {
            this.expression = `(-(${this.expression}))`;
        }
        this.updateDisplay();
    }

    /**
     * Toggles between Degrees (DEG) and Radians (RAD)
     */
    toggleAngleMode() {
        this.isDegreeMode = !this.isDegreeMode;
        if (this.degRadIndicator) {
            this.degRadIndicator.textContent = this.isDegreeMode ? 'DEG' : 'RAD';
        }
    }

    /**
     * Prepares and safely parses mathematical expression
     */
    calculate() {
        if (!this.expression.trim()) {
            return;
        }

        try {
            let sanitized = this.expression;

            // Replace visual symbols with valid JS math tokens
            sanitized = sanitized.replace(/×/g, '*');
            sanitized = sanitized.replace(/÷/g, '/');
            sanitized = sanitized.replace(/−/g, '-');
            sanitized = sanitized.replace(/\^/g, '**');
            sanitized = sanitized.replace(/π/g, `(${Math.PI})`);
            sanitized = sanitized.replace(/e/g, `(${Math.E})`);

            // Automatically close unclosed parentheses
            const openParens = (sanitized.match(/\(/g) || []).length;
            const closeParens = (sanitized.match(/\)/g) || []).length;
            if (openParens > closeParens) {
                sanitized += ')'.repeat(openParens - closeParens);
            }

            // Replace scientific function wrappers
            // Helper conversion for trigonometry based on DEG vs RAD mode
            const toRad = this.isDegreeMode ? `* Math.PI / 180` : '';

            // Handle trigonometric functions
            sanitized = sanitized.replace(/sin\(([^()]+)\)/g, (match, val) => `Math.sin((${val}) ${toRad})`);
            sanitized = sanitized.replace(/cos\(([^()]+)\)/g, (match, val) => `Math.cos((${val}) ${toRad})`);
            sanitized = sanitized.replace(/tan\(([^()]+)\)/g, (match, val) => `Math.tan((${val}) ${toRad})`);

            // Handle logarithmic and root functions
            sanitized = sanitized.replace(/sqrt\(/g, 'Math.sqrt(');
            sanitized = sanitized.replace(/log\(/g, 'Math.log10(');
            sanitized = sanitized.replace(/ln\(/g, 'Math.log(');

            // Handle percentage (e.g., 50% => 50/100)
            sanitized = sanitized.replace(/(\d+(\.\d+)?)%/g, '($1/100)');

            // Validate expression against malicious tokens before evaluation
            if (/[^0-9+\-*/().,%*\sMathPIE]/.test(sanitized)) {
                throw new Error("Invalid Characters");
            }

            // Evaluate expression
            const evaluated = Function(`"use strict"; return (${sanitized});`)();

            // Handle division by zero & infinity
            if (evaluated === Infinity || evaluated === -Infinity) {
                this.result = 'Error: Division by zero';
                this.updateDisplay();
                return;
            }

            if (isNaN(evaluated)) {
                this.result = 'Error: Invalid Expression';
                this.updateDisplay();
                return;
            }

            // Round float inaccuracies (e.g. 0.1 + 0.2, sin(30))
            const formatted = Math.abs(evaluated) < 1e-12 ? 0 : Number(evaluated.toFixed(10)).toString();

            // Save to calculation history
            this.addToHistory(this.expression, formatted);

            this.result = formatted;
            this.expression = formatted; // Allow chaining next operation
            this.updateDisplay();

        } catch (err) {
            this.result = 'Error: Invalid Expression';
            this.updateDisplay();
        }
    }

    /**
     * Adds an entry to calculation history list
     */
    addToHistory(expr, res) {
        this.history.unshift({ expr, res });
        if (this.history.length > 8) {
            this.history.pop();
        }

        if (this.historyList) {
            this.historyList.innerHTML = this.history
                .map(item => `<li><span class="hist-expr">${item.expr}</span> = <span class="hist-res">${item.res}</span></li>`)
                .join('');
        }
    }

    /**
     * Updates display UI
     */
    updateDisplay() {
        this.exprDisplay.textContent = this.expression || '0';
        this.resultDisplay.textContent = this.result;
    }
}

// Instantiate calculator on DOM load
let calc;
document.addEventListener('DOMContentLoaded', () => {
    calc = new ScientificCalculator();

    // Keyboard support for accessibility
    document.addEventListener('keydown', (e) => {
        if ((e.key >= '0' && e.key <= '9') || ['+', '-', '*', '/', '(', ')', '.', '%', '^'].includes(e.key)) {
            e.preventDefault();
            let key = e.key;
            if (key === '*') key = '×';
            if (key === '/') key = '÷';
            calc.append(key);
        } else if (e.key === 'Enter' || e.key === '=') {
            e.preventDefault();
            calc.calculate();
        } else if (e.key === 'Backspace') {
            e.preventDefault();
            calc.deleteLast();
        } else if (e.key === 'Escape') {
            e.preventDefault();
            calc.clearAll();
        }
    });
});
