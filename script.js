const intro=document.querySelector(".intro");
const logo_container=document.querySelector(".container");
const msg=document.querySelector(".msg");
const transition=document.querySelector(".transition");
const circle=document.querySelector(".circle");
const circle_one=document.querySelector("#one");
const circle_two=document.querySelector("#two");
const nav_container=document.querySelector(".nav-container");
const indexpage=document.querySelector(".index-page");
const footer_container=document.querySelector(".footer-container");
const form = document.querySelector('.form');
const body = document.querySelector('body')

setTimeout(()=>{
    logo_container.style.width="30vw"
    logo_container.style.height="50vh"
    logo_container.style.opacity="1"
},1000);
setTimeout(()=>{
    logo_container.style.left="-20vw"
    msg.style.display="block"
    msg.style.left="45vw"
},3000);
setTimeout(() => {
    transition.style.display="block"
}, 4990);
setTimeout(()=>{
    circle_one.style.top="-15vh"
    circle_two.style.top="-15vh"
    circle_one.style.left="35vw"
    circle_two.style.right="35vw"
},5000);
setTimeout(()=>{
    intro.style.display="none"
    msg.style.display="block"
    msg.style.left="45vw"
    nav_container.style.display="block"
    indexpage.style.display="block"
    footer_container.style.display="block"
    circle_one.style.top="150vh"
    circle_two.style.top="150vh"
    circle_one.style.left="-50vw"
    circle_two.style.right="-50vw"
},6000);
setTimeout(()=>{
    transition.style.display="none"
    body.style.overflowY="scroll"
},6890);

// let currentIndex = 0;

// function showSlide(index) {
// const slideWidth = slides[0].offsetWidth + (2 * (window.innerWidth * 0.01)); // margin via vw
// // slider.style.transform = translateX(-${index*slideWidth}px);
// }

// prevBtn.addEventListener('click', () => {
// currentIndex = (currentIndex - 1 + slides.length) % slides.length;
// showSlide(currentIndex);
// });

// nextBtn.addEventListener('click', () => {
// currentIndex = (currentIndex + 1) % slides.length;
// showSlide(currentIndex);
// });

// window.addEventListener('resize', () => showSlide(currentIndex)); // re-calculate on resize
