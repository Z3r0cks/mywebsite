window.addEventListener('load', () => {
   // const allLogoBackgrounds = document.querySelectorAll('.header__bgc');
   const hexValues = ["a", "b", "c", "d", "e", "f", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
   const logoBgScaleBtns = [
      [document.querySelector('.header__bcScale--9'), 1],
      [document.querySelector('.header__bcScale--81'), 2],
      [document.querySelector('.header__bcScale--729'), 3]]

   logoBgScaleBtns.forEach(el => {
      el[0].addEventListener('click', () => {
         const allElements = document.querySelectorAll('.header__bgcWrapper');
         allElements.forEach(el => {
            el.remove();
         });
         scaleLogoBackground(el[1], document.querySelectorAll('.header__logoWrapper'));
         changeLogoColor();
      });
   });

   scaleLogoBackground = (scale, wrapper) => {
      const new9x9pattern = create9x9Background(wrapper);
      // create9x9Background(new9x9pattern);
      scale -= 1;
      // console.log(scaleLogoBackground(scale, new9x9pattern[0]));
      new9x9pattern.forEach(el => {
         console.log(el);
      });
      // scaleLogoBackground(scale, new9x9pattern);
      // if (scale > 0) {
      //    scaleLogoBackground(scale, new9x9pattern);
      // }
   }
//TODO: Have to recognize, which element is in "new9x9pattern[0]" and containts "the clas header__bgc"
   create9x9Background = wrapper => {
      wrapper.forEach(el => {
         if (el.classList.contains('header__logo') && el.classList.contains('header__bcScaleWrapper')) return 0;
         for (let i = 0; i < 9; i++) {
            const newColor = document.createElement('div');
            newColor.classList.add('header__bgc');
            switch (i) {
               case 0:
                  setColorSize(newColor, 0, 0)
                  break;
               case 1:
                  setColorSize(newColor, 33.3333, 0)
                  break;
               case 2:
                  setColorSize(newColor, 66.6666, 0)
                  break;
               case 3:
                  setColorSize(newColor, 0, 33.3333)
                  break;
               case 4:
                  setColorSize(newColor, 33.3333, 33.3333)
                  break;
               case 5:
                  setColorSize(newColor, 66.6666, 33.3333)
                  break;
               case 6:
                  setColorSize(newColor, 0, 66.6666)
                  break;
               case 7:
                  setColorSize(newColor, 33.3333, 66.6666)
                  break;
               case 8:
                  setColorSize(newColor, 66.6666, 66.6666)
                  break;
            }
            el.appendChild(newColor);
         }
      });
      return wrapper;
      // for (let i = 0; i < 3; i++) {
      //    const newWrapper = document.createElement('div');
      //    // newWrapper.classList.add("header__bgcWrapper", "header__bgcWrapper__" + (i + 1).toString());
      //    newWrapper.classList.add("header__bgcWrapper");
      //    wrapper.appendChild(newWrapper);
      // }
   }

   setColorSize = (el, left, top) => {
      el.style.width = 100 / 3 + '%';
      el.style.height = 100 / 3 + '%';
      el.style.left = left + '%';
      el.style.top = top + '%';
   }

   // // console.log(logoBgScaleBtns[0][0]);
   // // logoBgScaleBtns[0][0].click();

   // document.querySelector('.header__logo').addEventListener('click', () => {
   //    changeLogoColor(3);
   // });

   function changeLogoColor() {
      // const allHeaderBgc = document.querySelectorAll('.header__bcScale');
      // allHeaderBgc.forEach(el => {
      //    getBackroundSizes(pixel, el);
      // });
      document.querySelectorAll('.header__bgc').forEach(el => {
         el.style.backgroundColor = getRandomColor();
      });
   };

   // getBackroundSizes = (pixel, el) => {
   //    el.style.height = 100 / 3 + '%';
   //    el.style.width = 100 / 3 + '%';
   //    switch (pixel) {
   //       case pixel <= 3:
   //          el.style.width = 100 / 3 + '%';
   //          break;
   //       case 81:
   //          el.style.width = 100 / 27 + '%';
   //          break;

   //       case 729:
   //          el.style.width = 100 / 243 + '%';
   //          break;
   //    }
   // };

   function getRandomColor() {
      const newColor = [];
      for (let i = 0; i < 6; i++) {
         newColor.push(hexValues[Math.floor(Math.random() * hexValues.length)]);
      }
      return '#' + newColor.join('');
   }

   // changeLogoColor();
});