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
    let heading = document.getElementById('small-size-remove');
    let screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (screenWidth <= 600) {
        heading.style.display = 'none';
    } else {
        heading.style.display = 'block';
    }
    heading = document.getElementById('small-size-apear');
    screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if (screenWidth <= 600) {
        heading.style.display = 'block';
    } else {
        heading.style.display = 'none';
    }
}