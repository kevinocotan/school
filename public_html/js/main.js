/*=============== SHOW SIDEBAR ===============*/
const showSidebar = (toggleId, sidebarId, headerId, mainId) =>{
   const toggle = document.getElementById(toggleId),
         sidebar = document.getElementById(sidebarId),
         header = document.getElementById(headerId),
         main = document.getElementById(mainId)

   if(toggle && sidebar && header && main){
       toggle.addEventListener('click', ()=>{
           /* Show sidebar */
           sidebar.classList.toggle('show-sidebar')
           /* Add padding header */
           header.classList.toggle('left-pd')
           /* Add padding main */
           main.classList.toggle('left-pd')
       })
   }
}
showSidebar('header-toggle','sidebar', 'header', 'main')

/*=============== LINK ACTIVE ===============*/
const sidebarLink = document.querySelectorAll('.sidebar__list a')

function linkColor(){
    sidebarLink.forEach(l => l.classList.remove('active-link'))
    this.classList.add('active-link')
}

sidebarLink.forEach(l => l.addEventListener('click', linkColor))

/*=============== DARK LIGHT THEME ===============*/ 
const themeButton = document.getElementById('theme-button')
const darkTheme = 'dark-theme'
const iconTheme = 'ri-sun-fill'

// Previously selected topic (if user selected)
const selectedTheme = localStorage.getItem('selected-theme')
const selectedIcon = localStorage.getItem('selected-icon')

// We obtain the current theme that the interface has by validating the dark-theme class
const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'ri-moon-clear-fill' : 'ri-sun-fill'

// We validate if the user previously chose a topic
if (selectedTheme) {
  // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
  document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
  themeButton.classList[selectedIcon === 'ri-moon-clear-fill' ? 'add' : 'remove'](iconTheme)
}

// Activate / deactivate the theme manually with the button
themeButton.addEventListener('click', () => {
    // Add or remove the dark / icon theme
    document.body.classList.toggle(darkTheme)
    themeButton.classList.toggle(iconTheme)
    // We save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme', getCurrentTheme())
    localStorage.setItem('selected-icon', getCurrentIcon())
})

// Selecciona el enlace de Escuelas y el submenú
const escuelasLink = document.getElementById('escuelas-link');
const escuelasSubmenu = document.getElementById('escuelas-submenu');
const expandIcon = document.getElementById('expand-icon');

// Agrega un evento de clic para mostrar/ocultar el submenú
escuelasLink.addEventListener('click', (e) => {
    e.preventDefault();
    
    // Alterna la visibilidad del submenú y el icono de expansión
    if (escuelasSubmenu.style.display === 'none' || !escuelasSubmenu.style.display) {
        escuelasSubmenu.style.display = 'block';
        escuelasLink.classList.add('active');
    } else {
        escuelasSubmenu.style.display = 'none';
        escuelasLink.classList.remove('active');
    }
});

// Verifica la URL actual para mantener el submenú expandido en Grados o Secciones
window.addEventListener('DOMContentLoaded', () => {
    if (window.location.href.includes('grados') || window.location.href.includes('secciones')) {
        escuelasSubmenu.style.display = 'block';
        escuelasLink.classList.add('active');
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const escuelasLink = document.getElementById('escuelas-link');
    const toggleSubmenu = document.getElementById('toggle-submenu');
    const escuelasSubmenu = document.getElementById('escuelas-submenu');

    // Evitar que el submenú abra "Escuelas" cuando se hace clic en el icono
    toggleSubmenu.addEventListener('click', (event) => {
        event.preventDefault(); // Evita la navegación a la página de "Escuelas"
        escuelasSubmenu.classList.toggle('show-submenu');
    });

    // Permitir que el clic en el texto "Escuelas" navegue a la página
    escuelasLink.addEventListener('click', (event) => {
        if (event.target !== toggleSubmenu) {
            window.location.href = escuelasLink.href; // Navega a la página de "Escuelas"
        }
    });
});

