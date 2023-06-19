window.onload = function() {
    window.scrollTo(0, document.body.scrollHeight);
}

window.addEventListener('resize', function() {
    resize()
});
window.addEventListener("load", function() {
    resize()
})

function resize() {
    let screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    let heading = document.getElementById('small-size-remove');
    let heading1 = document.getElementById('small-size-apear');
    let heading2 = document.getElementById('sceen-resize');

    if (screenWidth <= 600) {
        heading.style.display = 'none';
        heading1.style.display = 'block';
        heading2.style.width = "100%"
    } else {
        heading.style.display = 'block';
        heading1.style.display = 'none';
        heading2.style.width = "80%";
    }

}
