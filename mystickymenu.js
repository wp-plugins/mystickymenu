// select mysticky class
var mysticky_navbar = document.querySelector(mysticky_name.mysticky_string);

// add mysticky_wrap div around selected mysticky class
var parentmysticky = mysticky_navbar.parentNode;
var wrappermysticky = document.createElement('div');
var position = 0;
for(var i = 0; i < parentmysticky.childNodes.length; i++) {
  if(parentmysticky.childNodes[i] == mysticky_navbar) {
    position = i;
    break;
  };
};
wrappermysticky.id = 'mysticky-wrap';
wrappermysticky.appendChild(mysticky_navbar);
parentmysticky.insertBefore(wrappermysticky, parentmysticky.childNodes[position]);

// add mysticky_nav div inside selected mysticky class
var parentnav = mysticky_navbar.parentNode;
var wrappernav = document.createElement('div');
wrappernav.id = 'mysticky-nav';
parentnav.replaceChild(wrappernav, mysticky_navbar);
wrappernav.appendChild(mysticky_navbar);

// add myfixed and wrapfixed class to divs while scroll
var origOffsetY = mysticky_navbar.offsetTop + 100 ;
var hasScrollY = 'scrollY' in window;
function onScroll(e) {
var mydivWidth = ((mysticky_navbar.offsetWidth) + 'px');
var mydivHeight = ((mysticky_navbar.offsetHeight) + 'px');
var mydivReset = '';
    // mysticky_navbar.style.width = mydivWidth;
var y = hasScrollY ? window.scrollY : document.documentElement.scrollTop;
	y >= origOffsetY  ? mysticky_navbar.classList.add('myfixed') : mysticky_navbar.classList.remove('myfixed');
	y >= origOffsetY  ? wrappernav.classList.add('wrapfixed') : wrappernav.classList.remove('wrapfixed');
	y >= origOffsetY  ? mysticky_navbar.style.width = mydivWidth : mysticky_navbar.style.width = mydivReset;
	y >= origOffsetY  ? wrappermysticky.style.height = mydivHeight : wrappermysticky.style.height = mydivReset;
}

document.addEventListener('scroll', onScroll);