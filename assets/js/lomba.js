document.addEventListener('DOMContentLoaded', function() {
    // Handle image loading errors
    const cardImages = document.querySelectorAll('.card-image img');
    
    cardImages.forEach(img => {
        img.addEventListener('error', function() {
            // Hide the broken image
            this.style.display = 'none';
            
            // Add no-image class to parent
            const cardImage = this.closest('.card-image');
            if (cardImage) {
                cardImage.classList.add('no-image');
            }
        });
        
        // Check if image src is empty or invalid
        if (!img.src || img.src === '' || img.src.includes('placeholder')) {
            img.style.display = 'none';
            const cardImage = img.closest('.card-image');
            if (cardImage) {
                cardImage.classList.add('no-image');
            }
        }
    });
    
    // Handle images that might already be loaded but broken
    cardImages.forEach(img => {
        if (img.complete && img.naturalHeight === 0) {
            img.style.display = 'none';
            const cardImage = img.closest('.card-image');
            if (cardImage) {
                cardImage.classList.add('no-image');
            }
        }
    });
});