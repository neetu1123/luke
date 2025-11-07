/**
 * Responsive Enhancement Script for Bentonville Lodging
 * This script handles responsive behaviors for small devices
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile navigation enhancements
    const handleWindowResize = () => {
        // Adjust height of reviews container on mobile
        const reviewsContainer = document.querySelector('.reviews-slider-container');
        if (reviewsContainer) {
            const activeSlide = document.querySelector('.reviews-slide.active');
            if (activeSlide) {
                if (window.innerWidth <= 768) {
                    // For mobile, set dynamic height based on content
                    const slideHeight = activeSlide.offsetHeight;
                    reviewsContainer.style.height = (slideHeight + 50) + 'px';
                } else {
                    // For desktop, use fixed height
                    reviewsContainer.style.height = '420px';
                }
            }
        }
        
        // Adjust search container positioning
        const searchContainer = document.querySelector('.search-container');
        if (searchContainer) {
            if (window.innerWidth <= 768) {
                // For mobile devices, set position to static
                searchContainer.style.position = 'static';
                searchContainer.style.bottom = 'auto';
                searchContainer.style.left = 'auto';
                searchContainer.style.transform = 'none';
                searchContainer.style.margin = '20px auto';
            } else {
                // For desktop, keep absolute positioning
                searchContainer.style.position = 'absolute';
                searchContainer.style.bottom = '-50px';
                searchContainer.style.left = '50%';
                searchContainer.style.transform = 'translateX(-50%)';
                searchContainer.style.margin = '';
            }
        }
    };

    // Better positioning of guest selector popup on mobile
    const guestSelector = document.getElementById('show-target-data');
    if (guestSelector) {
        guestSelector.addEventListener('click', function() {
            const popup = document.getElementById('guestsss');
            if (popup) {
                if (window.innerWidth <= 768) {
                    popup.style.width = '100%';
                    popup.style.left = '0';
                    popup.style.right = '0';
                    popup.style.maxWidth = 'none';
                }
            }
        });
    }

    // Touch events for attractions on mobile
    const attractionCards = document.querySelectorAll('.attraction-card');
    if ('ontouchstart' in window || navigator.msMaxTouchPoints) {
        attractionCards.forEach(card => {
            card.addEventListener('touchstart', function() {
                this.classList.add('touch-active');
                
                // Remove active class from other cards
                attractionCards.forEach(otherCard => {
                    if (otherCard !== card) {
                        otherCard.classList.remove('touch-active');
                    }
                });
            });
        });
    }
    
    // Review slider navigation for mobile touch
    const reviewNavButtons = document.querySelectorAll('.review-nav-btn, .review-dot');
    reviewNavButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Wait for slide transition then adjust height
            setTimeout(() => {
                handleWindowResize();
            }, 500);
        });
    });

    // Initial call and resize listener
    handleWindowResize();
    window.addEventListener('resize', handleWindowResize);
    
    // Reinitialize on orientation change for mobile devices
    window.addEventListener('orientationchange', function() {
        setTimeout(handleWindowResize, 300);
    });
});