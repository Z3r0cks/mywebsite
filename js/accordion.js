/**
 * Enhanced Accordion functionality with smooth animations
 * Handles multiple accordions with improved UX
 */
document.addEventListener('DOMContentLoaded', function() {
    const accordions = document.getElementsByClassName("accordion");
    
    // Initialize all accordions
    for (let i = 0; i < accordions.length; i++) {
        const panel = accordions[i].nextElementSibling;
        
        // Temporarily make the panel fully visible to measure its natural size
        panel.style.display = "block";
        panel.style.height = "auto";
        panel.style.overflow = "visible";
        panel.style.visibility = "hidden"; // Hide visually but keep in layout
        
        // Force browser to calculate layout
        panel.offsetHeight;
        
        // Now measure the actual height
        const naturalHeight = panel.offsetHeight;
        
        // Store the measured height
        panel.dataset.originalHeight = naturalHeight + "px";
        
        // Now set the panel for animation
        panel.style.visibility = "visible";
        panel.style.overflow = "hidden";
        panel.style.height = "0px";
        panel.style.transition = "height 0.3s ease-in-out";
    }
    
    // Add click event listeners
    for (let i = 0; i < accordions.length; i++) {
        accordions[i].addEventListener("click", function() {
            
            const panel = this.nextElementSibling;
            const isCurrentlyOpen = this.classList.contains("active");
            
            if (isCurrentlyOpen) {
                // Close panel
                this.classList.remove("active");
                
                // First set current height in pixels (in case it's "auto")
                const currentHeight = panel.offsetHeight;
                panel.style.height = currentHeight + "px";
                
                // Force reflow
                panel.offsetHeight;
                
                // Now animate to 0
                panel.style.height = "0px";
            } else {
                // Open panel
                this.classList.add("active");
                // Use stored natural height
                const fullHeight = panel.dataset.originalHeight;
                panel.style.height = fullHeight;
                
                // Set to auto after animation
                setTimeout(() => {
                    if (this.classList.contains("active")) {
                        panel.style.height = "auto";
                    }
                }, 310);
            }
        });
    }
});