var se_menu_button = document.querySelector('#se-menu-button');
if(se_menu_button) {
  se_menu_button.addEventListener('click', function(event) {
    event.preventDefault();
    event.target.classList.toggle('fa-bars');
    event.target.classList.toggle('fa-times-square');
    var se_menu = document.querySelector('#se-menu');
    se_menu.classList.toggle('-translate-x-full');
    se_menu.classList.toggle('translate-x-0');
  });
}
  
var sv_menu_button = document.querySelector('#sv-menu-button');
if(sv_menu_button) {
  sv_menu_button.addEventListener('click', function(event) {
    event.preventDefault();
    event.target.classList.toggle('fa-bars');
    event.target.classList.toggle('fa-times-square');
    var sv_menu = document.querySelector('#sv-menu');
    sv_menu.classList.toggle('translate-x-full');
    sv_menu.classList.toggle('translate-x-0');
  });
}
