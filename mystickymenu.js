var mysticky_navbar = document.querySelector(mysticky_name.mysticky_string);
var origOffsetY = mysticky_navbar.offsetTop;
function onScroll(e) {
  window.scrollY >= origOffsetY ? mysticky_navbar.classList.add('myfixed') :
                                  mysticky_navbar.classList.remove('myfixed');
}
document.addEventListener('scroll', onScroll);