document.addEventListener("DOMContentLoaded", function() {
    // obtenir les éléments du box media-element
    const mediaElements = document.querySelectorAll('.media-element');

    // event listeners pour chaque media.element
    mediaElements.forEach(element => {
        // event listener pour le hover 
        element.addEventListener('mouseenter', function() {
            // augmenter la taille du box
            this.style.transform = 'scale(1.05)';
        });

        // even listener pour mouseout
        element.addEventListener('mouseleave', function() {
            // taille ancien
            this.style.transform = 'scale(1)';
        });
    });
});
