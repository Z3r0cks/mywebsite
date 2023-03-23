// starting after html is loaded
window.addEventListener('load', function () {
   const sliderBtnLeft = document.querySelector('#sliderBtnLeft');
   const sliderBtnRight = document.querySelector('#sliderBtnRight');
   const sliderImage = document.querySelector('.slider__img');

   sliderBtnLeft.addEventListener('click', function () {
      console.log('left');
   });
   sliderBtnRight.addEventListener('click', function () {
      console.log('right');
   });

});
