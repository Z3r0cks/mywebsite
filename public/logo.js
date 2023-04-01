window.addEventListener('load', () => {
   const hexValues = ["a", "b", "c", "d", "e", "f", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
   const logoBgScaleBtns = [
      [document.querySelector('.header__bcScale--9'), 1],
      [document.querySelector('.header__bcScale--81'), 2],
      [document.querySelector('.header__bcScale--729'), 3],
      [document.querySelector('.header__bcScale--6561'), 4],
      [document.querySelector('.header__bcScale--59049'), 5]]

   logoBgScaleBtns.forEach(el => {
      el[0].addEventListener('click', () => {
         const allElements = document.querySelectorAll('.header__bgc');
         allElements.forEach(el => {
            el.remove();
         });
         scaleLogoBackground(el[1], document.querySelector('.header__logoWrapper'));
         changeLogoColor();
      });
   });

   scaleLogoBackground = (scale, wrapper) => {
      const new3x3pattern = create3x3Background(wrapper);
      if (scale > 1 && scale <= logoBgScaleBtns.length) {
         for (let el of new3x3pattern.children) {
            if (el.classList.contains('header__bgc'))
               scaleLogoBackground(scale - 1, el);
         };
      }
   }
   create3x3Background = wrapper => {
      let l = t = 0;
      for (let i = 0; i < 9; i++) {
         const newColor = document.createElement('div');
         newColor.classList.add('header__bgc');
         setColorSize(newColor, (l * 33.3333), t * 33.3333)
         l > 1 ? (l = 0, t++) : l++;
         wrapper.appendChild(newColor);
      }
      return wrapper;
   }

   setColorSize = (el, left, top) => {
      el.style.width = 100 / 3 + '%';
      el.style.height = 100 / 3 + '%';
      el.style.left = left + '%';
      el.style.top = top + '%';
   }

   function changeLogoColor() {
      document.querySelectorAll('.header__bgc').forEach(el => {
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
});
