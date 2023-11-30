$(document).ready(function() {

    console.log('JQuery is working')

    $('#search').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();

        // Restaurar estilos predeterminados en todas las imágenes
        $('.apps-grilla img, .apps-not img').removeClass('highlight');

        // Verificar si el campo de búsqueda está vacío
        if (searchTerm.trim() !== '') {
            // Recorrer las imágenes y aplicar estilos a las coincidencias
            $('.apps-grilla img, .apps-not img').each(function() {
                var appTitle = $(this).attr('title').toLowerCase();
                if (appTitle.includes(searchTerm)) {
                    $(this).addClass('highlight');
                    $(this).addClass('transform','scale(1.1)');
                }
            });
        } 
    });

    function replaceLoginLink() {
        if (window.innerWidth <= 414) {
            var loginBtn = document.querySelector('.login-btn');
            loginBtn.innerHTML = "<img src='../images/user.png' alt=''>";
        } else {
            console.log("NO SE PUDO")
        }
    }

    // Ejecuta la función al cargar la página y cuando se cambia el tamaño de la pantalla
    replaceLoginLink()
    window.onresize = replaceLoginLink;


});
