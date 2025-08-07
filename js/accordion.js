/**
 * Enhanced Accordion functionality with smooth animations
 * Handles multiple accordions with improved UX
 */
document.addEventListener('DOMContentLoaded', function() {
    const accordions = document.getElementsByClassName("accordion");
    
    // Initialize all accordions
    for (let i = 0; i < accordions.length; i++) {
        accordions[i].addEventListener("click", function() {
            // Toggle active state
            this.classList.toggle("active");
            
            // Get the panel
            const panel = this.nextElementSibling;
            
            if (panel.style.display === "block") {
                // Close panel with animation
                panel.classList.remove("show");
                setTimeout(() => {
                    panel.style.display = "none";
                }, 300);
            } else {
                // Open panel with animation
                panel.style.display = "block";
                setTimeout(() => {
                    panel.classList.add("show");
                }, 10);
            }
        });
    }
    
    // Optional: Close other accordions when one is opened (uncomment if desired)
    /*
    for (let i = 0; i < accordions.length; i++) {
        accordions[i].addEventListener("click", function() {
            // Close all other accordions
            for (let j = 0; j < accordions.length; j++) {
                if (j !== i && accordions[j].classList.contains("active")) {
                    accordions[j].classList.remove("active");
                    const otherPanel = accordions[j].nextElementSibling;
                    otherPanel.classList.remove("show");
                    setTimeout(() => {
                        otherPanel.style.display = "none";
                    }, 300);
                }
            }
        });
    }
    */
});