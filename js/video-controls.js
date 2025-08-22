/**
 * Custom video controls for experience page
 * Handles volume control customization
 */
document.addEventListener('DOMContentLoaded', function() {
    // Find videos by their source files
    const videos = document.querySelectorAll('video');
    
    videos.forEach(video => {
        const source = video.querySelector('source');
        if (!source) return;
        
        const videoSrc = source.getAttribute('src');
        
        if (videoSrc.includes('teaching.mp4')) {
            hideVolumeControl(video);
        } else if (videoSrc.includes('TAR.mp4')) {
            video.volume = 0.2;
        } else if (videoSrc.includes('exp1.mp4')) {
            hideVolumeControl(video);
        } else if (videoSrc.includes('ImageVideo_Final.mp4')) {
            video.volume = 0.2;
        }
    });
});

/**
 * Hides the volume control for a specific video element
 * @param {HTMLVideoElement} video - The video element to modify
 */
function hideVolumeControl(video) {
    // Add custom CSS class for styling
    video.classList.add('no-volume-control');
    
    // Create style element if it doesn't exist
    if (!document.querySelector('#video-control-styles')) {
        const style = document.createElement('style');
        style.id = 'video-control-styles';
        style.textContent = `
            /* Hide volume control while keeping other controls */
            .no-volume-control::-webkit-media-controls-volume-slider-container,
            .no-volume-control::-webkit-media-controls-volume-slider,
            .no-volume-control::-webkit-media-controls-mute-button {
                display: none !important;
            }
            
            /* Firefox */
            .no-volume-control::-moz-media-controls-volume-slider,
            .no-volume-control::-moz-media-controls-mute-button {
                display: none !important;
            }
        `;
        document.head.appendChild(style);
    }
}
