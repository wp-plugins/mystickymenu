// select mysticky class
var mysticky_navbar = document.querySelector(mysticky_name.mysticky_string);

// add mysticky_wrap div around selected mysticky class
var myparent = mysticky_navbar.parentNode;
var mywrapper = document.createElement('div');
var position = 0;
for(var i = 0; i < myparent.childNodes.length; i++) {
  if(myparent.childNodes[i] == mysticky_navbar) {
    position = i;
    break;
  };
};
mywrapper.id = 'mysticky_wrap';
mywrapper.appendChild(mysticky_navbar);
myparent.insertBefore(mywrapper, myparent.childNodes[position]);
var mydivHeight = ((mysticky_navbar.offsetHeight) + 'px');
mywrapper.style.height = mydivHeight;

// add myfixed class to selected mysticky class
var origOffsetY = mysticky_navbar.offsetTop + 100;
var hasScrollY = 'scrollY' in window;
function onScroll(e) {
  var y = hasScrollY ? window.scrollY : document.documentElement.scrollTop;
  y >= origOffsetY  ? mysticky_navbar.classList.add('myfixed') : mysticky_navbar.classList.remove('myfixed');
}
document.addEventListener('scroll', onScroll);