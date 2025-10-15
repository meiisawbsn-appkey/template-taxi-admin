const fs = require('fs');
const path = require('path');

// Ensure directories exist
const cssDir = path.join(__dirname, 'public/css');
const jsDir = path.join(__dirname, 'public/js');

if (!fs.existsSync(cssDir)) {
    fs.mkdirSync(cssDir, { recursive: true });
}

if (!fs.existsSync(jsDir)) {
    fs.mkdirSync(jsDir, { recursive: true });
}

// Copy CSS files
fs.copyFileSync(
    path.join(__dirname, 'resources/css/app.css'),
    path.join(__dirname, 'public/css/app.css')
);

// Copy JS files
fs.copyFileSync(
    path.join(__dirname, 'resources/js/app.js'),
    path.join(__dirname, 'public/js/app.js')
);

fs.copyFileSync(
    path.join(__dirname, 'resources/js/dashboard.js'),
    path.join(__dirname, 'public/js/dashboard.js')
);

fs.copyFileSync(
    path.join(__dirname, 'resources/js/dashboard-charts.js'),
    path.join(__dirname, 'public/js/dashboard-charts.js')
);

console.log('Assets built successfully!');
