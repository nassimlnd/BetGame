// Slider

const imgBx = document.querySelector(".imgBx");
const contentSlides = document.querySelector(".contentBx");
const slides = imgBx.getElementsByTagName("img");
const textdiv = contentSlides.getElementsByTagName("div");
var i = 0;

function nextSlide(){
    slides[i].classList.remove('active');
    textdiv[i].classList.remove('active');
    i = (i + 1) % slides.length;
    slides[i].classList.add('active');
    textdiv[i].classList.add('active');
}

function previousSlide() {
    slides[i].classList.remove('active');
    textdiv[i].classList.remove('active');
    i = (i - 1 + slides.length) % slides.length;
    slides[i].classList.add('active'); 
    textdiv[i].classList.add('active');
}