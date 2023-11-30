<link rel="stylesheet" href="stylephp1.css">
<?php
include("conexionbase.php");

//Obtener datos del usuario

$usuario = $_POST['usuario'];
$nombreyapellido = $_POST['nombreyapellido'];

//Verificacion del usuario

$sql = "SELECT * FROM registro WHERE (usuario = ?) AND nombreyapellido = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $usuario, $nombreyapellido);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $newPassword = random_int(10000000, 99999999);
    $contra_cifrada = password_hash($newPassword, PASSWORD_DEFAULT);

    //Contraseña actualizada en la BD

    $sql = "UPDATE registro SET contrasena = ? WHERE (usuario = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $contra_cifrada, $usuario);
    $stmt->execute();
    
    echo "<div class='newpassword-container'>";
        echo "<br>";
        echo "<h1 class='main-text'>¡Contraseña actualizada correctamente!</h1>";
        echo "<h3 class='newpassword'><p class='pretext'>Nueva contraseña:</p> <p class='randomnumber'>$newPassword</p></h3>";
        echo "<br>";
        echo "<a class='login-btn' href='login.php'>Iniciar Sesion</a>";
    echo "</div>";
}
?>