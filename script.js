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
        heading2.style = ' width: 100%; position: absolute; top: 68px; right: 0; bottom: 0; overflow-y: auto; height: calc(100vh - 68px);';
    } else {
        heading.style.display = 'block';
        heading1.style.display = 'none';
        heading2.style = 'width: 80%; position: absolute; top: 68px; right: 0; bottom: 0; overflow-y: auto; height: calc(100vh - 68px);';
    }

}