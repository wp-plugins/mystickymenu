// select mysticky class
var mysticky_navbar = document.querySelector(mysticky_name.mysticky_string);

// add mysticky_wrap div around selected mysticky class
var parent = mysticky_navbar.parentNode;
var wrapper = document.createElement('div');
var position = 0;
for(var i = 0; i < parent.childNodes.length; i++) {
  if(parent.childNodes[i] == mysticky_navbar) {
    position = i;
    break;
  };
};
wrapper.id = 'mysticky_wrap';
wrapper.appendChild(mysticky_navbar);
parent.insertBefore(wrapper, parent.childNodes[position]);
var mydivHeight = ((mysticky_navbar.offsetHeight) + 'px');
wrapper.style.height = mydivHeight;

// add myfixed class to selected mysticky class
var origOffsetY = mysticky_navbar.offsetTop + 100;
var hasScrollY = 'scrollY' in window;
function onScroll(e) {
  var y = hasScrollY ? window.scrollY : document.documentElement.scrollTop;
  y >= origOffsetY  ? mysticky_navbar.classList.add('myfixed') : mysticky_navbar.classList.remove('myfixed');
}
document.addEventListener('scroll', onScroll);