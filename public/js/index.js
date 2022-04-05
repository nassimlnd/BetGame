// Carousel
var slides = document.querySelectorAll('.slide');
var contents = document.querySelectorAll('.content')
var btns = document.querySelectorAll('.btn');
let currentSlide = 1;

var manualNav = function(manual){
    slides.forEach((slide) => {
        slide.classList.remove('active');
        contents.forEach((content) => {
            content.classList.remove('active');
            btns.forEach((btn) => {
                btn.classList.remove('active');
            });
        })
    });

    slides[manual].classList.add('active');
    btns[manual].classList.add('active');
    contents[manual].classList.add('active');
}

btns.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
        currentContent = i;
    });
});

var repeat = function(activeClass){
    let active = document.getElementsByClassName('active');
    let i = 1;

    var repeater = () => {
        setTimeout(function(){
            [...active].forEach((activeSlide) => {
            activeSlide.classList.remove('active');
            });

            slides[i].classList.add('active');
            btns[i].classList.add('active');
            contents[i].classList.add('active');
            i++;

            if(slides.length == i){
                i = 0;
            }
            if(i >= slides.length){
                return;
            }
            repeater();
        }, 10000);
    }
    repeater();
}
repeat();

// Header

function showMenu() {
    const dropdownMenu = document.querySelector('.dropdown-menu');
    if (dropdownMenu.classList.contains('active')) {
        dropdownMenu.classList.remove('active');
    } else {
        dropdownMenu.classList.add('active');
    }
}

function showMenuMobile() {
    const dropdownMenuMobile = document.querySelector('.mobile-menu-dropdown');

    if (dropdownMenuMobile.classList.contains('active')) {
        dropdownMenuMobile.classList.remove('active');
    } else {
        dropdownMenuMobile.classList.add('active');
    }
}

function closeMenuMobile() {
    const dropdownMenuMobile = document.querySelector('.mobile-menu-dropdown');

    dropdownMenuMobile.classList.remove('active');
}