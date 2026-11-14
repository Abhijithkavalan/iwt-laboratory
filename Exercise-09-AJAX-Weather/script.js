/**
 * IWT Exercise 09: AJAX Weather Retrieval Engine
 * Technologies: HTML5, CSS3, JavaScript (AJAX / Fetch API / XMLHttpRequest)
 */

// ============================================================
// API Configuration
// ============================================================
const CONFIG = {
    // Mode: 'mock' uses local JSON for 100% offline lab reliability; 'live' uses external API
    mode: 'mock',
    mockDataUrl: 'mock-weather.json',

    // Example Live API configuration (e.g. OpenWeatherMap)
    // To enable live API: set mode to 'live' and provide your registered API key
    liveApiEndpoint: 'https://api.openweathermap.org/data/2.5/weather',
    apiKey: 'YOUR_API_KEY_HERE', // Never commit real API keys to version control!
    units: 'metric'
};

// DOM References
const searchBtn     = document.getElementById('search-btn');
const cityInput     = document.getElementById('city-input');
const loadingState  = document.getElementById('loading-state');
const errorState    = document.getElementById('error-state');
const weatherCard   = document.getElementById('weather-card');
const quickCityChips = document.querySelectorAll('.chip');

// Weather Display Fields
const elCityName    = document.getElementById('weather-city');
const elCountry     = document.getElementById('weather-country');
const elTemp        = document.getElementById('weather-temp');
const elFeels       = document.getElementById('weather-feels');
const elCondition   = document.getElementById('weather-condition');
const elDesc        = document.getElementById('weather-description');
const elHumidity    = document.getElementById('weather-humidity');
const elWind        = document.getElementById('weather-wind');
const elPressure    = document.getElementById('weather-pressure');
const elIcon        = document.getElementById('weather-icon');
const elReqType     = document.getElementById('ajax-request-type');

/**
 * Executes Asynchronous AJAX retrieval
 * Demonstrates native XMLHttpRequest / Fetch API based on user choice
 */
function fetchWeather(cityName, useXHR = false) {
    const query = cityName.trim().toLowerCase();

    if (!query) {
        showError("Please enter a city name to search.");
        return;
    }

    // Reset previous views & Show loading indicator
    hideAllStates();
    loadingState.style.display = 'block';

    if (CONFIG.mode === 'mock') {
        // Fetch from local hypothetical mock weather registry via AJAX
        if (useXHR) {
            fetchViaXMLHttpRequest(CONFIG.mockDataUrl, query);
        } else {
            fetchViaFetchAPI(CONFIG.mockDataUrl, query);
        }
    } else {
        // Live API execution placeholder
        fetchLiveWeather(query);
    }
}

/**
 * Approach 1: Modern AJAX using Fetch API (Promise-based)
 */
function fetchViaFetchAPI(url, cityQuery) {
    elReqType.textContent = "Protocol: AJAX via Fetch API";

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP Error: ${response.status} ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            handleMockResponse(data, cityQuery);
        })
        .catch(err => {
            showError(`AJAX Network Failure: ${err.message}. Ensure mock-weather.json is accessible.`);
        });
}

/**
 * Approach 2: Traditional AJAX using XMLHttpRequest (XHR)
 */
function fetchViaXMLHttpRequest(url, cityQuery) {
    elReqType.textContent = "Protocol: AJAX via XMLHttpRequest (XHR)";

    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            const data = xhr.response;
            handleMockResponse(data, cityQuery);
        } else {
            showError(`XHR Error: Server returned status ${xhr.status}`);
        }
    };

    xhr.onerror = function() {
        showError("XMLHttpRequest network request failed.");
    };

    xhr.send();
}

/**
 * Parses and maps mock weather data to DOM
 */
function handleMockResponse(data, query) {
    // Artificial small delay (300ms) to visibly show loading state during lab demonstration
    setTimeout(() => {
        const cityData = data[query];

        if (cityData) {
            displayWeatherData(cityData);
        } else {
            showError(`City "${query}" not found in hypothetical weather registry.<br>Try popular cities: <strong>Bengaluru, Mumbai, Delhi, Chennai, London, Tokyo, New York, Paris</strong>.`);
        }
    }, 300);
}

/**
 * Populates weather details onto the UI card
 */
function displayWeatherData(data) {
    hideAllStates();

    elCityName.textContent  = data.city;
    elCountry.textContent   = data.country;
    elTemp.textContent      = `${Math.round(data.temperature)}°C`;
    elFeels.textContent     = `Feels like ${data.feels_like}°C`;
    elCondition.textContent = data.condition;
    elDesc.textContent      = data.description;
    elHumidity.textContent  = `${data.humidity}%`;
    elWind.textContent      = `${data.wind_speed} km/h`;
    elPressure.textContent  = `${data.pressure} hPa`;
    elIcon.textContent      = data.icon || '🌤️';

    weatherCard.style.display = 'block';
}

/**
 * Displays error message banner
 */
function showError(message) {
    hideAllStates();
    errorState.innerHTML = `<strong>Notice:</strong> ${message}`;
    errorState.style.display = 'block';
}

/**
 * Hides all display cards
 */
function hideAllStates() {
    loadingState.style.display = 'none';
    errorState.style.display   = 'none';
    weatherCard.style.display  = 'none';
}

/**
 * Handles live weather API connection (e.g. OpenWeatherMap)
 */
function fetchLiveWeather(city) {
    const url = `${CONFIG.liveApiEndpoint}?q=${encodeURIComponent(city)}&appid=${CONFIG.apiKey}&units=${CONFIG.units}`;
    
    fetch(url)
        .then(res => {
            if (!res.ok) {
                if (res.status === 404) throw new Error("City not found on weather server.");
                if (res.status === 401) throw new Error("Invalid API Key provided.");
                throw new Error(`Weather service returned HTTP ${res.status}`);
            }
            return res.json();
        })
        .then(liveData => {
            const transformed = {
                city: liveData.name,
                country: liveData.sys.country,
                temperature: liveData.main.temp,
                feels_like: liveData.main.feels_like,
                condition: liveData.weather[0].main,
                description: liveData.weather[0].description,
                humidity: liveData.main.humidity,
                wind_speed: liveData.wind.speed,
                pressure: liveData.main.pressure,
                icon: '🌤️'
            };
            displayWeatherData(transformed);
        })
        .catch(err => showError(err.message));
}

// Event Listeners
searchBtn.addEventListener('click', () => {
    fetchWeather(cityInput.value);
});

cityInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        fetchWeather(cityInput.value);
    }
});

// Quick City Selection Chips
quickCityChips.forEach(chip => {
    chip.addEventListener('click', () => {
        const city = chip.getAttribute('data-city');
        cityInput.value = city;
        fetchWeather(city);
    });
});

// Initial demo load on startup
document.addEventListener('DOMContentLoaded', () => {
    fetchWeather('Bengaluru');
});
