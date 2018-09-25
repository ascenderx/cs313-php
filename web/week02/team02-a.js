function gel(id) {
   return document.getElementById(id);
}

function gcls(className) {
   return document.getElementsByClassName(className);
}

function gtag(tagName) {
   return document.getElementsByTagName(tagName);
}

const divsBlock = gcls('block');
const btClickMe = gel('btClickMe');
const txtColor = gel('txtColor');
const btChangeColor = gel('btChangeColor');

btClickMe.addEventListener('click', function() {
   alert('Clicked!');
});

btChangeColor.addEventListener('click', function() {
   let color = txtColor.value;
   divsBlock[0].style.backgroundColor = color;
});
