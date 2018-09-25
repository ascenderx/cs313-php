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
const blk1 = divsBlock[0];
const btClickMe = gel('btClickMe');
const txtColor = gel('txtColor');
const btChangeColor = gel('btChangeColor');

let colorDefault;
let textDefault;

window.addEventListener('load', function() {
    colorDefault = blk1.style.backgroundColor;
    textDefault = blk1.innerText;
});

btClickMe.addEventListener('click', function() {
    alert('Clicked!');
});

btChangeColor.addEventListener('click', function() {
    let color = txtColor.value.trim();
    if (color.length == 0) {
        blk1.style.backgroundColor = colorDefault;
        blk1.innerText = textDefault;
    } else {
        blk1.style.backgroundColor = color;
        blk1.innerText = color;
    }
});

txtColor.addEventListener('change', function() {
    this.value = this.value.trim();
});
