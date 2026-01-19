/**
 * Enhanced Accordion functionality with smooth animations
 * Handles multiple accordions with improved UX
 */
document.addEventListener('DOMContentLoaded', function() {
    const accordions = document.getElementsByClassName("accordion");
    
    for (let i = 0; i < accordions.length; i++) {
        const panel = accordions[i].nextElementSibling;
        
        panel.style.display = "block";
        panel.style.height = "auto";
        panel.style.overflow = "visible";
        panel.style.visibility = "hidden"; 

        panel.offsetHeight;
        const naturalHeight = panel.offsetHeight;
        panel.dataset.originalHeight = naturalHeight + "px";

        panel.style.visibility = "visible";
        panel.style.overflow = "hidden";
        panel.style.height = "0px";
        panel.style.transition = "height 0.3s ease-in-out";
    }

    for (let i = 0; i < accordions.length; i++) {
        accordions[i].addEventListener("click", function() {
            
            const panel = this.nextElementSibling;
            const isCurrentlyOpen = this.classList.contains("active");
            
            if (isCurrentlyOpen) {

                this.classList.remove("active");
                const currentHeight = panel.offsetHeight;
                panel.style.height = currentHeight + "px";
                
                panel.offsetHeight;
                panel.style.height = "0px";
            } else {
                this.classList.add("active");
                const fullHeight = panel.dataset.originalHeight;
                panel.style.height = fullHeight;

                setTimeout(() => {
                    if (this.classList.contains("active")) {
                        panel.style.height = "auto";
                    }
                }, 310);
            }
        });
    }
});