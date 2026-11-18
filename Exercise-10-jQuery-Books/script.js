/**
 * IWT Exercise 10: jQuery Books AJAX Engine
 * Technologies: HTML5, CSS3, jQuery (v3.7.1), AJAX
 * Demonstrates jQuery $.ajax() GET request, response parsing, and dynamic DOM rendering.
 */

$(document).ready(function () {
    // API Configuration
    const API_CONFIG = {
        mode: 'mock', // 'mock' for dependable offline lab demo; 'live' for real external API
        mockUrl: 'books.json',
        
        // Example Live API endpoints (Google Books or OpenLibrary)
        liveGoogleBooksUrl: 'https://www.googleapis.com/books/v1/volumes?q=computer+science',
        liveOpenLibraryUrl: 'https://openlibrary.org/search.json?q=computer+science'
    };

    // Cache DOM Elements via jQuery selectors
    const $loadBtn       = $('#btn-load-books');
    const $clearBtn      = $('#btn-clear-books');
    const $loader        = $('#loading-indicator');
    const $booksContainer= $('#books-grid');
    const $statusAlert   = $('#status-message');
    const $categorySelect= $('#category-filter');
    const $searchInput   = $('#search-filter');
    const $counterBadge  = $('#books-counter');

    // In-memory collection of loaded books for client-side filtering
    let cachedBooks = [];

    // Embedded fallback dataset ensuring 100% offline functionality even under file:/// protocol where browser CORS blocks AJAX
    const FALLBACK_BOOKS = [
        { id: 1, title: "Clean Code: A Handbook of Agile Software Craftsmanship", author: "Robert C. Martin (Uncle Bob)", isbn: "978-0132350884", publication_year: 2008, category: "Software Engineering", rating: 4.8, pages: 464, description: "A legendary handbook on writing maintainable, readable, and elegant code, focusing on principles, patterns, and refactoring techniques." },
        { id: 2, title: "Introduction to Algorithms (4th Edition)", author: "Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein", isbn: "978-0262046305", publication_year: 2022, category: "Computer Science", rating: 4.9, pages: 1312, description: "The quintessential comprehensive algorithm textbook covering divide-and-conquer, dynamic programming, greedy algorithms, and graph topologies." },
        { id: 3, title: "Design Patterns: Elements of Reusable Object-Oriented Software", author: "Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides (Gang of Four)", isbn: "978-0201633610", publication_year: 1994, category: "Architecture & Patterns", rating: 4.7, pages: 416, description: "Foundational classic cataloging 23 classic design patterns spanning creational, structural, and behavioral software architectures." },
        { id: 4, title: "JavaScript: The Definitive Guide (Master the World's Most-Used Language)", author: "David Flanagan", isbn: "978-1491952023", publication_year: 2020, category: "Web Technologies", rating: 4.6, pages: 704, description: "Comprehensive guide for modern JavaScript (ES2020) including classes, modules, iterators, generators, Promises, async/await, and Web APIs." },
        { id: 5, title: "The Pragmatic Programmer: Your Journey to Mastery", author: "David Thomas, Andrew Hunt", isbn: "978-0135957059", publication_year: 2019, category: "Software Engineering", rating: 4.9, pages: 352, description: "Timeless practical insights into software craftsmanship, career philosophy, automated testing, decoupling, and code orthogonality." },
        { id: 6, title: "Database System Concepts (7th Edition)", author: "Abraham Silberschatz, Henry F. Korth, S. Sudarshan", isbn: "978-0078022159", publication_year: 2019, category: "Database Systems", rating: 4.7, pages: 1376, description: "Fundamental text presenting relational data models, SQL queries, indexing, B-Trees, transaction concurrency, recovery, and distributed databases." },
        { id: 7, title: "Computer Networks (6th Edition)", author: "Andrew S. Tanenbaum, David J. Wetherall, Nick Feamster", isbn: "978-0136958505", publication_year: 2021, category: "Networking", rating: 4.8, pages: 960, description: "Authoritative guide to network protocols, TCP/IP stack layers, routing algorithms, socket programming, and modern 5G/Wi-Fi wireless systems." },
        { id: 8, title: "Designing Data-Intensive Applications", author: "Martin Kleppmann", isbn: "978-1449373320", publication_year: 2017, category: "Distributed Systems", rating: 4.9, pages: 616, description: "The definitive resource exploring the architecture of distributed systems, replication, partitioning, stream processing, and consensus algorithms." }
    ];

    /**
     * Primary AJAX execution handler using jQuery $.ajax()
     */
    function loadBooksData() {
        // Clear previous notifications and books
        $statusAlert.hide().empty();
        $booksContainer.empty();

        // Direct offline fallback for file:/// protocol
        if (window.location.protocol === 'file:' && API_CONFIG.mode === 'mock') {
            $loader.show();
            $loadBtn.prop('disabled', true).html('<span>⏳</span> Loading Offline Dataset...');
            setTimeout(function () {
                $loader.hide();
                $loadBtn.prop('disabled', false).html('<span>📚</span> Reload Books (Offline Mode)');
                $clearBtn.show();
                cachedBooks = FALLBACK_BOOKS;
                populateCategoryDropdown(FALLBACK_BOOKS);
                renderBooks(FALLBACK_BOOKS);
                showStatus(`Successfully loaded ${FALLBACK_BOOKS.length} books via Offline Dataset (file:/// mode; run via HTTP server for native $.ajax).`, 'success');
            }, 350);
            return;
        }

        const endpoint = (API_CONFIG.mode === 'mock') 
            ? API_CONFIG.mockUrl 
            : API_CONFIG.liveGoogleBooksUrl;

        // Execute jQuery $.ajax() call
        $.ajax({
            url: endpoint,
            type: 'GET',
            dataType: 'json',
            timeout: 8000, // 8 second timeout

            // 1. Loading State: Triggers immediately before sending the request
            beforeSend: function (xhr) {
                $loader.show();
                $loadBtn.prop('disabled', true).html('<span>⏳</span> Fetching Books via $.ajax()...');
            },

            // 2. Success Handler: Triggers when the HTTP request succeeds
            success: function (response, status, xhr) {
                // Artificial 350ms delay to clearly demonstrate loading state in lab exams
                setTimeout(function () {
                    $loader.hide();
                    $loadBtn.prop('disabled', false).html('<span>📚</span> Reload Books ($.ajax)');
                    $clearBtn.show();

                    let bookList = [];
                    if (API_CONFIG.mode === 'mock') {
                        bookList = response.books || [];
                    } else {
                        // Transform Google Books response structure if in live mode
                        bookList = (response.items || []).map(item => ({
                            id: item.id,
                            title: item.volumeInfo.title || 'Untitled',
                            author: (item.volumeInfo.authors || []).join(', ') || 'Unknown Author',
                            isbn: (item.volumeInfo.industryIdentifiers || [{}])[0].identifier || 'N/A',
                            publication_year: (item.volumeInfo.publishedDate || '').substring(0, 4) || 'N/A',
                            category: (item.volumeInfo.categories || ['General'])[0],
                            rating: item.volumeInfo.averageRating || 'N/A',
                            pages: item.volumeInfo.pageCount || 'N/A',
                            description: item.volumeInfo.description || 'No description available.'
                        }));
                    }

                    cachedBooks = bookList;

                    // 3. Handle Empty Response
                    if (bookList.length === 0) {
                        showStatus('No book records were returned by the API.', 'warning');
                        $counterBadge.text('0 Books');
                        return;
                    }

                    // Render books
                    populateCategoryDropdown(bookList);
                    renderBooks(bookList);
                    showStatus(`Successfully loaded ${bookList.length} books via jQuery $.ajax() GET request (HTTP Status: ${xhr.status} OK).`, 'success');
                }, 350);
            },

            // 4. Error Handler: Triggers on HTTP errors (404, 500, timeouts, CORS)
            error: function (xhr, status, errorThrown) {
                $loader.hide();
                $loadBtn.prop('disabled', false).html('<span>📚</span> Load Books ($.ajax)');
                
                // If local CORS blocked the request, automatically fall back so demonstration never breaks
                if (API_CONFIG.mode === 'mock' && (xhr.status === 0 || !xhr.status)) {
                    $clearBtn.show();
                    cachedBooks = FALLBACK_BOOKS;
                    populateCategoryDropdown(FALLBACK_BOOKS);
                    renderBooks(FALLBACK_BOOKS);
                    showStatus(`Local CORS restricted raw $.ajax() on file://; loaded ${FALLBACK_BOOKS.length} books via Safe Fallback.<br>Tip: Run on <code>http://localhost</code> for native $.ajax() HTTP requests.`, 'warning');
                    return;
                }

                let errorDetails = `API Request Failed!<br><strong>Status:</strong> ${xhr.status} (${status})<br><strong>Error:</strong> ${errorThrown || 'Network connection unavailable'}`;
                showStatus(errorDetails, 'danger');
            },

            // Complete Handler: Triggers after success or error
            complete: function (xhr, status) {
                // Reset loading state if needed
            }
        });
    }

    /**
     * Dynamically renders book cards into the DOM
     */
    function renderBooks(books) {
        $booksContainer.empty();
        $counterBadge.text(`${books.length} Books`);

        if (books.length === 0) {
            $booksContainer.html(`
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748b;">
                    <p style="font-size: 16px;">No books match your current search/filter criteria.</p>
                </div>
            `);
            return;
        }

        $.each(books, function (index, book) {
            const cardHtml = `
                <article class="book-card" data-category="${escapeHtml(book.category)}">
                    <div class="book-card-header">
                        <span class="category-tag">${escapeHtml(book.category)}</span>
                        <span class="rating-badge">&#9733; ${escapeHtml(String(book.rating))}</span>
                    </div>

                    <h3 class="book-title">${escapeHtml(book.title)}</h3>
                    <div class="book-author">✍️ ${escapeHtml(book.author)}</div>

                    <div class="book-meta">
                        <span><strong>Year:</strong> ${escapeHtml(String(book.publication_year))}</span>
                        <span><strong>ISBN:</strong> ${escapeHtml(book.isbn)}</span>
                        <span><strong>Pages:</strong> ${escapeHtml(String(book.pages))}</span>
                    </div>

                    <p class="book-desc">${escapeHtml(book.description)}</p>

                    <div class="book-card-footer">
                        <span class="api-tag">Retrieved via $.ajax()</span>
                        <button type="button" class="btn-inspect" onclick="alert('Book Details:\\n\\nTitle: ${escapeJsString(book.title)}\\nAuthor: ${escapeJsString(book.author)}\\nISBN: ${escapeJsString(book.isbn)}\\nYear: ${book.publication_year}')">Inspect</button>
                    </div>
                </article>
            `;
            $booksContainer.append(cardHtml);
        });

        // Smooth fade-in
        $booksContainer.hide().fadeIn(300);
    }

    /**
     * Populates distinct categories into the dropdown filter
     */
    function populateCategoryDropdown(books) {
        const categories = new Set();
        $.each(books, function (_, b) {
            if (b.category) categories.add(b.category);
        });

        $categorySelect.empty().append('<option value="">All Categories</option>');
        categories.forEach(cat => {
            $categorySelect.append(`<option value="${escapeHtml(cat)}">${escapeHtml(cat)}</option>`);
        });
    }

    /**
     * Filters cached books by search term and selected category
     */
    function filterBooks() {
        const selectedCat = $categorySelect.val();
        const searchWord  = $searchInput.val().toLowerCase().trim();

        const filtered = cachedBooks.filter(book => {
            const matchCat = !selectedCat || book.category === selectedCat;
            const matchSearch = !searchWord || 
                book.title.toLowerCase().includes(searchWord) || 
                book.author.toLowerCase().includes(searchWord) ||
                book.isbn.toLowerCase().includes(searchWord);
            return matchCat && matchSearch;
        });

        renderBooks(filtered);
    }

    /**
     * Displays status alert banner
     */
    function showStatus(message, type) {
        $statusAlert
            .removeClass('alert-success alert-warning alert-danger')
            .addClass(`alert-${type}`)
            .html(message)
            .fadeIn(200);
    }

    // Helper sanitizers to prevent XSS
    function escapeHtml(text) {
        if (!text) return '';
        return $('<div>').text(text).html();
    }

    function escapeJsString(str) {
        if (!str) return '';
        return String(str).replace(/'/g, "\\'").replace(/"/g, '&quot;');
    }

    // Event Bindings
    $loadBtn.on('click', loadBooksData);

    $clearBtn.on('click', function () {
        $booksContainer.empty();
        $statusAlert.hide();
        $counterBadge.text('0 Books');
        $clearBtn.hide();
        cachedBooks = [];
    });

    $categorySelect.on('change', filterBooks);
    $searchInput.on('input', filterBooks);

    // Initial Trigger for immediate verification upon page load
    loadBooksData();
});
