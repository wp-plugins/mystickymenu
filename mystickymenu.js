var navbar = document.querySelector('.navbar');
var origOffsetY = navbar.offsetTop;
function onScroll(e) {
  window.scrollY >= origOffsetY ? navbar.classList.add('myfixed') :
                                  navbar.classList.remove('myfixed');
}
document.addEventListener('scroll', onScroll);