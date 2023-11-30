<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Inicio de sesión</title>
        <link rel="stylesheet" type="text/css" href="../css/stylelogin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
    </head>
    <body>
        <a href="../index.php"><img class="back-img" src="../images/flecha-izquierda.png" alt=""></a>
        <div id="login-container">
            <h2>Iniciar sesión</h2>
            <form id="login-form" method="post" action="login1.php">
                <input name="usuario" type="text" placeholder="USUARIO">
                <input name="contrasena" type="password" placeholder="CONTRASEÑA">
                <input type="submit" value="Iniciar sesión">
                <table>
                    <td id="izquierda"><a href="recuperacion.php">¿Olvido su contraseña?</a></td>
                    <td id="derecha"><a href="crearusuario.php">Crear usuario</a></td>
                </table>
            </form>
        </div>
    </body>
    
</html>