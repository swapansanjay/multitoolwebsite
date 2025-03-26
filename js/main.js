// Main JavaScript File

// Language Translation Object
const translations = {
    en: {
        search: 'Search Tools',
        categories: {
            unitConverters: 'Unit Converters',
            fluidConverters: 'Fluid Converters',
            engineering: 'Engineering',
            electricity: 'Electricity',
            imageConverters: 'Image Converters',
            technology: 'Technology',
            mathematics: 'Mathematics',
            statistics: 'Statistics',
            geometry: 'Geometry',
            healthFitness: 'Health & Fitness',
            seo: 'SEO Tools',
            socialMedia: 'Social Media',
            textTools: 'Text Tools',
            otherTools: 'Other Tools',
            security: 'Security',
            developer: 'Developer Tools'
        }
    },
    // Add other languages here
};

// Tool Data
const tools = [
    // Unit Converters
    { id: 'meters-to-yards', name: 'Meters to Yards', category: 'unitConverters', path: '/tools/unit-converters/meters-to-yards.html' },
    { id: 'inches-to-cm', name: 'Inches to Centimeters', category: 'unitConverters', path: '/tools/unit-converters/inches-to-cm.html' },
    { id: 'kg-to-lbs', name: 'Kilograms to Pounds', category: 'unitConverters', path: '/tools/unit-converters/kg-to-lbs.html' },
    // Add more tools here...
];

// DOM Elements
const languageSelect = document.getElementById('languageSelect');
const searchInput = document.querySelector('.search-input');
const searchResults = document.getElementById('searchResults');
const backToTopBtn = document.getElementById('backToTop');

// Language Change Handler
if (languageSelect) {
    languageSelect.addEventListener('change', (e) => {
        const selectedLang = e.target.value;
        updateLanguage(selectedLang);
    });
}

// Search Functionality
if (searchInput) {
    searchInput.addEventListener('input', debounce(handleSearch, 300));
}

// Back to Top Button
if (backToTopBtn) {
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.remove('d-none');
        } else {
            backToTopBtn.classList.add('d-none');
        }
    });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function updateLanguage(lang) {
    // Update all translatable elements
    document.querySelectorAll('[data-translate]').forEach(element => {
        const key = element.getAttribute('data-translate');
        if (translations[lang] && translations[lang][key]) {
            element.textContent = translations[lang][key];
        }
    });
}

function handleSearch(e) {
    const searchTerm = e.target.value.toLowerCase();
    const results = tools.filter(tool => 
        tool.name.toLowerCase().includes(searchTerm) ||
        tool.category.toLowerCase().includes(searchTerm)
    );

    displaySearchResults(results);
}

function displaySearchResults(results) {
    if (!searchResults) return;

    if (results.length === 0) {
        searchResults.innerHTML = '<p class="text-center">No tools found</p>';
        return;
    }

    const html = results.map(tool => `
        <div class="search-result-item p-2">
            <a href="${tool.path}" class="text-decoration-none">
                <h6 class="mb-0">${tool.name}</h6>
                <small class="text-muted">${translations[languageSelect.value].categories[tool.category]}</small>
            </a>
        </div>
    `).join('');

    searchResults.innerHTML = html;
}

// Tool-specific Functions
function initializeTool(toolId) {
    // Add tool-specific initialization code here
    console.log(`Initializing tool: ${toolId}`);
}

// Ad Loading Function
function loadAds() {
    // Add ad loading code here
    console.log('Loading ads...');
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize common functionality
    loadAds();
    
    // Initialize tool if on a tool page
    const toolId = document.body.getAttribute('data-tool-id');
    if (toolId) {
        initializeTool(toolId);
    }
});

// Common JavaScript functionality for all pages

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize Bootstrap popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});

// Common form validation
function validateInput(input, min = null, max = null) {
    const value = parseFloat(input.value);
    
    if (isNaN(value)) {
        return false;
    }
    
    if (min !== null && value < min) {
        return false;
    }
    
    if (max !== null && value > max) {
        return false;
    }
    
    return true;
}

// Format number with specified decimal places
function formatNumber(number, decimals = 2) {
    return Number(number).toFixed(decimals);
}

// Copy text to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        showToast('Copied to clipboard!');
    }).catch(function(err) {
        console.error('Failed to copy text: ', err);
        showToast('Failed to copy text', 'error');
    });
}

// Show toast notification
function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    toast.addEventListener('hidden.bs.toast', function() {
        toast.remove();
    });
}

// Create toast container if it doesn't exist
function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    document.body.appendChild(container);
    return container;
}

// Handle form submission
function handleFormSubmit(form, callback) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        callback();
    });
}

// Reset form
function resetForm(form) {
    form.reset();
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.classList.remove('is-invalid');
        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.remove();
        }
    });
}

// Show loading state
function showLoading(element) {
    element.disabled = true;
    const originalText = element.innerHTML;
    element.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
    element.dataset.originalText = originalText;
}

// Hide loading state
function hideLoading(element) {
    element.disabled = false;
    element.innerHTML = element.dataset.originalText;
}

// Handle API errors
function handleApiError(error) {
    console.error('API Error:', error);
    showToast(error.message || 'An error occurred', 'danger');
}

// Format large numbers with K, M, B suffixes
function formatLargeNumber(num) {
    if (num >= 1e9) return (num / 1e9).toFixed(2) + 'B';
    if (num >= 1e6) return (num / 1e6).toFixed(2) + 'M';
    if (num >= 1e3) return (num / 1e3).toFixed(2) + 'K';
    return num.toString();
}

// Export common functions
window.UnitConverters = {
    validateInput,
    formatNumber,
    copyToClipboard,
    showToast,
    handleFormSubmit,
    resetForm,
    showLoading,
    hideLoading,
    handleApiError,
    debounce,
    formatLargeNumber
}; 