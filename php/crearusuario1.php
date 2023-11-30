<?php
include('conexionbase.php');

$nombreyapellido = $_POST["nombreyapellido"];
$email = $_POST["email"];
$celular = $_POST["celular"];
$contrasena = $_POST["contrasena"];
$rol = $_POST["rol"];

// Verificar si el correo electrónico ya está en uso
$verificar_sql = "SELECT * FROM personal WHERE email = '$email'";
$resultado_verificar = mysqli_query($conn, $verificar_sql);

if (mysqli_num_rows($resultado_verificar) > 0) {
    // El correo electrónico ya está en uso, mostrar una alerta en JavaScript
    echo "<script>alert('Este correo electrónico ya está en uso. Por favor, utilice otro.');</script>";
} else {
    // El correo electrónico no está en uso, proceder con la inserción
    $contra_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO registro (`nombreyapellido`, `celular`, `email`, `contrasena`, `rol`) VALUES ('$nombreyapellido', '$celular', '$email', '$contra_cifrada', '$rol')";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
        header("Location: index.php"); // Redirige al usuario a index.php
        exit; // Asegura que el script se detiene después de la redirección
    } else {
        echo "Error: " . $sql . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
