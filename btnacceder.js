
console.log('JQuery is working')

function replaceLoginLink() {
    if (window.innerWidth <= 414) {
        var loginBtn = document.querySelector('.login-btn');
        loginBtn.innerHTML = "<img class='user-img' src='images/user.png' alt=''>";
    } else {
        console.log("NO SE PUDO")
    }
}

// Ejecuta la función al cargar la página y cuando se cambia el tamaño de la pantalla
replaceLoginLink()
window.onresize = replaceLoginLink;
