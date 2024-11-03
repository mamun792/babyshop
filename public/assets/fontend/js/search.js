


let searchTimeout = null;
const searchInput = document.getElementById('search-input');
const suggestionsContainer = document.getElementById('search-suggestions');
const maxRecentSearches = 5;

// Load recent searches from localStorage
function getRecentSearches() {
    return JSON.parse(localStorage.getItem('recentSearches') || '[]');
}

// Save a search term to localStorage
function saveSearchTerm(term) {
    let recentSearches = getRecentSearches();

    // Avoid duplicates and limit to maxRecentSearches
    if (!recentSearches.includes(term)) {
        recentSearches.unshift(term);
        if (recentSearches.length > maxRecentSearches) {
            recentSearches.pop();
        }
        localStorage.setItem('recentSearches', JSON.stringify(recentSearches));
    }
}

// Clear all recent searches
function clearRecentSearches() {
    localStorage.removeItem('recentSearches');
    displayRecentSearches();
}

// Display recent searches
function displayRecentSearches() {
    const recentSearches = getRecentSearches();
    suggestionsContainer.innerHTML = `
        <div class="recent-header">
            <span>Recent Searches</span>
            <button onclick="clearRecentSearches()" class="clear-button">Clear All</button>
        </div>
    `;

    recentSearches.forEach(term => {
        const item = document.createElement('div');
        item.classList.add('recent-search-item');
        item.textContent = term;
        item.addEventListener('click', () => {
            searchInput.value = term;
            fetchSearchSuggestions(term);
        });
        suggestionsContainer.appendChild(item);
    });
    suggestionsContainer.style.display = recentSearches.length > 0 ? 'block' : 'none';
}

// Handle search input event
searchInput.addEventListener('input', function() {
    const query = this.value.trim();

    if (query.length > 1) {
        clearTimeout(searchTimeout);

        // Show a loading indicator
        suggestionsContainer.innerHTML = '<p class="loading">Loading...</p>';
        suggestionsContainer.style.display = 'block';

        // Debounce the API call
        searchTimeout = setTimeout(() => {
            fetchSearchSuggestions(query);
        }, 300);
    } else if (query === '') {
        displayRecentSearches();
    } else {
        suggestionsContainer.style.display = 'none';
    }
});

// Fetch search suggestions from server
function fetchSearchSuggestions(query) {
    axios.get(`/search-product-suggestions?q=${encodeURIComponent(query)}`)
        .then(response => {
            displaySearchSuggestions(response.data, query);
            saveSearchTerm(query); // Save search term
        })
        .catch(error => {
            console.error('Search error:', error);
            suggestionsContainer.innerHTML = '<p class="error">An error occurred. Please try again.</p>';
        });
}

// Display search suggestions
function displaySearchSuggestions(results, query) {
    suggestionsContainer.innerHTML = '';

    if (results.length > 0) {
        results.forEach(item => {
            const suggestionItem = document.createElement('div');
            suggestionItem.classList.add('list-group-item', 'd-flex', 'align-items-center');
            suggestionItem.innerHTML = `
                <a href="${allProductsUrl}?product-name=${item.name}" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <img src="${item.featured_image}" alt="${item.name}" class="suggestion-image" style="width: 40px; height: 40px; object-fit: cover; margin-right: 3px;">
                    <div>
                        <span class="product-name">${item.name.replace(new RegExp(query, 'gi'), match => `<strong>${match}</strong>`)}</span>
                        <span class="product-price">£${parseFloat(item.price).toFixed(2)}</span>
                    </div>
                </a>
            `;
            suggestionsContainer.appendChild(suggestionItem);
        });
    } else {
        suggestionsContainer.innerHTML = '<p class="no-results">No products found</p>';
    }
    suggestionsContainer.style.display = 'block';
}

// Display recent searches on focus
searchInput.addEventListener('focus', () => {
    if (searchInput.value.trim() === '') {
        displayRecentSearches();
    }
});
