if ((document.location["href"].slice(-13)) != "name_list.php") {
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
    // const navBar = document.getElementById('nav-bar');
    // const navWidth = navBar.offsetHeight;
    let screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    let heading = document.getElementById('small-size-remove');
    let heading1 = document.getElementById('small-size-apear');
    let heading2 = document.getElementById('sceen-resize');
    
    if (screenWidth <= 600) {
        if ((document.location["href"].slice(-13)) != "name_list.php") {
            heading.style.display = 'none';
            heading1.style.display = 'block';
            heading2.style.width = "100%"
        }
    } else {
        if  ((document.location["href"].slice(-13)) == "name_list.php"){
            location.href = 'index.php';
        } else if ((document.location["href"].slice(-13)) != "name_list.php") {
            heading.style.display = 'block';
            heading1.style.display = 'none';
            heading2.style.width = "80%";
        }

    }
}






  