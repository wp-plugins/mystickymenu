var mysticky_navbar = document.querySelector(mysticky_name.mysticky_string);
var origOffsetY = mysticky_navbar.offsetTop;
var hasScrollY = 'scrollY' in window;

function onScroll(e) {	
  var y = hasScrollY ? window.scrollY : document.documentElement.scrollTop;
  y >= origOffsetY ? mysticky_navbar.classList.add('myfixed') : mysticky_navbar.classList.remove('myfixed');
}
document.addEventListener('scroll', onScroll);