# Exercise 02: Online Shopping Webpage

## 1. Exercise Number
**Exercise 02**

## 2. Exercise Title
**Online Shopping Webpage with Product Details Using HTML and CSS**

## 3. Aim
To design and develop a responsive and attractive static online shopping webpage named "ShopEase" containing a website logo, navigation bar, hero banner, category showcase, at least 6 detailed product cards, and a comprehensive footer using HTML5 and CSS3.

## 4. Problem Statement
Design an online shopping webpage featuring:
- Website header with brand logo ("ShopEase")
- Responsive navigation bar with links (Home, Categories, Products, Deals, Contact)
- Interactive cart badge with item counter
- Hero showcase banner with a Call-to-Action
- Categories grid
- Product section with at least 6 products displaying:
  * Local product images
  * Category badges / discount tags
  * Product names
  * Technical descriptions
  * Star ratings and review counts
  * Discounted prices and original crossed-out prices
  * "Add to Cart" action buttons
- Informative footer with multiple navigation columns and copyright notice
- Responsive layout across mobile, tablet, and desktop screens using CSS Grid and Flexbox
- No backend required (static laboratory demonstration)

## 5. Technologies Used
- **HTML5**: Semantic tags (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`).
- **CSS3**: CSS Grid, Flexbox, custom variables, smooth transitions, card shadow effects, responsive media queries.
- **JavaScript (Vanilla)**: Lightweight interactive feedback for cart counter increment and toast notification.

## 6. Features
- **6 Local Product Cards**: High-resolution local JPEG product images (`assets/images/`).
- **Responsive Grid**: Automatically adapts from 1 column on mobile to 3-4 columns on wide monitors.
- **Visual Feedback**: Hover animations on product cards, image zooms, and button click feedback.
- **Cart Badge Counter**: Dynamic counter on the header cart button updating on every "Add to Cart" click.
- **Toast Notifications**: Non-intrusive bottom notification alert displaying the added item name.

## 7. Folder and File Description
```
Exercise-02-Online-Shopping/
├── index.html                  # Main shopping webpage
├── style.css                   # Custom CSS3 styling and responsive layout
├── README.md                   # Full documentation
├── .gitignore                  # Git ignore configuration
└── assets/
    └── images/
        ├── backpack.jpg        # Product 6: Laptop Backpack
        ├── camera.jpg          # Product 4: Mirrorless Camera
        ├── headphones.jpg      # Product 2: ANC Headphones
        ├── keyboard.jpg        # Product 5: Mechanical Keyboard
        ├── laptop.jpg          # Product 1: Core i7 Laptop
        └── smartwatch.jpg      # Product 3: Health Smartwatch
```

## 8. Requirements
- Any modern web browser (Google Chrome, Microsoft Edge, Mozilla Firefox, Safari).
- No web server or database required.

## 9. Installation and Setup
1. Clone or download the repository to your computer.
2. Confirm that the `assets/images/` directory contains all 6 JPEG image files.

## 10. How to Run
- Double-click `index.html` to open directly in your web browser.
- Or right-click `index.html` -> **Open With** -> Select your browser.

## 11. How to Test
1. **Header & Navigation**:
   - Verify the brand name "ShopEase", logo badge, and navigation links.
   - Click the Cart button to see an alert showing the current cart item count.
2. **Category Cards**:
   - Hover over each category card; verify hover elevation.
3. **Product Cards (At least 6 items)**:
   - Check all 6 products: Laptop, Headphones, Smartwatch, Camera, Keyboard, Backpack.
   - Verify images, titles, descriptions, star ratings, and prices render properly.
4. **Add to Cart Interactivity**:
   - Click "Add to Cart" on any product.
   - Verify that the Cart counter in the top header increments (`1`, `2`, `3`...).
   - Verify that a toast notification popup appears at the bottom-right confirming the addition.
5. **Responsiveness**:
   - Resize your browser window or press `Ctrl + Shift + M` in Chrome DevTools to verify responsive layout on mobile, tablet, and desktop viewports.
6. **Console Check**:
   - Press `F12` to open Developer Tools and ensure there are no JavaScript or asset errors.

## 12. Expected Output
A vibrant, modern e-commerce storefront layout featuring an announcement bar, header with interactive cart, hero banner, category blocks, 6 product cards with prices, ratings, and functional cart buttons, and a complete multi-column footer.

## 13. Important Notes
- Designed for front-end demonstration in an MCA Internet & Web Technologies practical exam.
- Self-contained and completely independent of external dependencies.
