// Show Scroll Up Btn
const scrollUpBtn = document.querySelector('i.up');
const header = document.querySelector('header');

scrollUpBtn.addEventListener('click',() => {
    window.scrollTo(0,0);
})


window.addEventListener('scroll',() => {
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
    if(window.scrollY > 500){
        scrollUpBtn.classList.add('show');
    } else {
        scrollUpBtn.classList.remove('show');
    }

})