if ((document.location["href"].slice(-13)) != "name_list.php" || (document.location["href"].slice(-51)) != "name_list.php?chat=&error=user%20does%20not%20exist") {
    console.log((document.location["href"].slice(-51)) == "name_list.php?chat=&error=user%20does%20not%20exist");
    window.onload = function() {
        const element = document.getElementById('sceen-resize')
        element.scrollTop = element.scrollHeight;
    }
}

window.addEventListener('resize', function() {
    resize();
});
window.addEventListener("load", function() {
    resize();
})

function resize() {

    let screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    let heading = document.getElementById('small-size-remove');
    let heading1 = document.getElementById('small-size-apear');
    let heading2 = document.getElementById('sceen-resize');
    document.cookie = "screenWidth=" + screenWidth;

    if (screenWidth <= 600) {
        if ((document.location["href"].slice(-13)) != "name_list.php" || (document.location["href"].slice(-51)) != "name_list.php?chat=&error=user%20does%20not%20exist") {
            heading.style.display = 'none';
            heading1.style.display = 'block';
            heading2.style.width = "100%"
        }
    } else {
        if ((document.location["href"].slice(-13)) == "name_list.php" || (document.location["href"].slice(-51)) != "name_list.php?chat=&error=user%20does%20not%20exist") {
            location.href = 'index.php';
        } else if ((document.location["href"].slice(-13)) != "name_list.php" || (document.location["href"].slice(-51)) != "name_list.php?chat=&error=user%20does%20not%20exist") {
            heading.style.display = 'block';
            heading1.style.display = 'none';
            heading2.style.width = "80%";
        }

    }
}