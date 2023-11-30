<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleregister.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <a href="login.php"><img class="back-img" src="../images/flecha-izquierda.png" alt=""></a>
    <div id="register-container">
        <h2>Registrarse</h2>
        <div id="alert-container"></div>
        <form id="register-form">
            <input name="nombreyapellido" type="text" placeholder="NOMBRE Y APELLIDO">
            <input name="email" type="email" placeholder="CORREO">
            <input name="celular" type="text" placeholder="CELULAR">
            <input name="contrasena" type="password" placeholder="CONTRASEÑA">
            <select value="rol" name="" id="">
                <option value="">ELIGE TU ROL</option>
                <option value="">Profesor</option>
                <option value="">Mantenimiento</option>
            </select>
            <button type="button" class="register-button" id="register-button">Registrarse</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $("#register-button").click(function() {
                var nombreyapellido = $("input[name='nombreyapellido']").val();
                var email = $("input[name='email']").val();
                var celular = $("input[name='celular']").val();
                var contrasena = $("input[name='contrasena']").val();
                $.ajax({
                    type: "POST",
                    url: "crearusuario1.php",
                    data: {
                        nombreyapellido: nombreyapellido,
                        email: email,
                        celular: celular,
                        contrasena: contrasena
                    },
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        $("#alert-container").html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
