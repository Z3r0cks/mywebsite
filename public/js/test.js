let bg_count = 5;

for (let i = 1; i <= bg_count; i++) {  // Start bei 1, nicht 0
   let el = document.createElement("div");
   el.classList = `main_img-b${i}`;
   document.querySelector(".main_img-container").append(el);
}