window.addEventListener('load', () => {

   // Slider
   const sliderBtnLeft = document.querySelector('#sliderBtnLeft');
   const sliderBtnRight = document.querySelector('#sliderBtnRight');
   const allSliderImages = document.querySelectorAll('.slider__img');
   const sliderWrapper = document.querySelector('.slider__wrapper');
   const sliderPointWrapper = document.querySelector('.slider__pointWrapper');

   // slider points
   allSliderImages.forEach(el => {
      const newPoint = document.createElement('div');
      newPoint.classList.add('slider__point');
      newPoint.addEventListener('click', () => {
         showImage(el);
         setActivePoint(newPoint);
      });
      sliderPointWrapper.appendChild(newPoint)
   });
   document.querySelectorAll('.slider__point')[currentSliderIndex()].classList.add('slider__point--active');

   // slider buttons
   sliderWrapper.style.height = allSliderImages[currentSliderIndex()].clientHeight + 'px';
   sliderBtnLeft.addEventListener('click', () => {
      arrowListener('left');
   });
   sliderBtnRight.addEventListener('click', () => {
      arrowListener('right');
   });

   function arrowListener(direction) {
      const currentImgIndex = currentSliderIndex();
      const nextIndex = showAdjacentImage(currentImgIndex, direction);
      setActivePoint(document.querySelectorAll('.slider__point')[nextIndex]);
   };

   showAdjacentImage = (index, direction) => {
      allSliderImages[index].classList.add('opacity-0');
      if (direction === 'left')
         nextIndex = index === 0 ? allSliderImages.length - 1 : index - 1;
      else
         nextIndex = index === allSliderImages.length - 1 ? 0 : index + 1;
      allSliderImages[nextIndex].classList.remove('opacity-0');
      return nextIndex;
   };

   showImage = image => {
      allSliderImages.forEach(el => {
         el.classList.add('opacity-0');
      });
      image.classList.remove('opacity-0');
   };

   function currentSliderIndex() {
      for (let i = 0; i < allSliderImages.length; i++) {
         if (allSliderImages[i].classList.contains('opacity-0')) continue;
         return i
      }
   };

   function setActivePoint(newPoint) {
      document.querySelectorAll('.slider__point').forEach(el => {
         el.classList.remove('slider__point--active');
      });
      newPoint.classList.add('slider__point--active');
   };
});