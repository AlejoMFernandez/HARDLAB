<?php
        include('conexionbase.php');

        if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) 
        {
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];
            
            // Consulta de usuario
            $consulta = "SELECT * FROM registro WHERE usuario = '$usuario'";
            $resultado = $conn->query($consulta);
            
            if ($resultado->num_rows == 1) {
                $row = $resultado->fetch_assoc();
                $hashcontrasena = $row['contrasena'];
                // Verificar si la contraseña coincide utilizando password_verify()
                if (password_verify($contrasena, $hashcontrasena)) {
                    header("Location:main.html");
                } else {
                    echo "Contraseña incorrecta. Por favor, intenta de nuevo.";
                }
            } else {
                echo "Nombre de usuario no encontrado. Por favor, registra una cuenta.";
            }
        }
        mysqli_close($conn);
    ?>