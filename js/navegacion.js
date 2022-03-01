const navToggle = document.querySelector('#btn-nav-menu');
const navMenu = document.querySelectorAll('.ocultar');


const mostrarMenu = () => {
    document.getElementById('navMenu').classList.add('mostrar');
}


navToggle.addEventListener("click", () => {
    const desMenu = document.querySelector('.mostrar');
    if(desMenu) {
        for(let i=0; i<navMenu.length; i++){
            navMenu[i].classList.remove('mostrar');
       
        }
    } else{
        for(let i=0; i<navMenu.length; i++){
            if(window.innerWidth < 768){
                navMenu[i].classList.add('mostrar');
            }
        }
    }
});