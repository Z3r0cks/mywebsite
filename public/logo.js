window.addEventListener('load', () => {
   const allLogoBackgrounds = document.querySelectorAll('.header__bgc');
   const hexValues = ["a", "b", "c", "d", "e", "f", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

   document.querySelector('.header__logo').addEventListener('click', () => {
      changeLogoColor();
   });


   function changeLogoColor() {
      allLogoBackgrounds.forEach(el => {
         el.style.backgroundColor = getRandomColor();
      });
   };

   function getRandomColor() {
      const newColor = [];
      for (let i = 0; i < 6; i++) {
         newColor.push(hexValues[Math.floor(Math.random() * hexValues.length)]);
      }
      return '#' + newColor.join('');
   }
   
   changeLogoColor();
});