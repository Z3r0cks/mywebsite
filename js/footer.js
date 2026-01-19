const textarea = document.getElementById('footer-contact-message');
const charCount = document.getElementById('char-count');

charCount.textContent = `0/${textarea.maxLength}`;

textarea.addEventListener('input', () => {
    const maxLength = textarea.maxLength;
    const currentLength = textarea.value.length;
    charCount.textContent = `${currentLength}/${maxLength}`;
});
