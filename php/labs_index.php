


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-labs.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Pixelify+Sans&family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../script.js"></script>
</head>
<body>
 
<?php

//Lectura de JSON con los datos
$jsonData = file_get_contents('daemon_machine_network.json');
$data = json_decode($jsonData, true);

$host = $data['PARAMETROS']['host'];
$port = $data['PARAMETROS']['port'];
$user = $data['PARAMETROS']['user'];
$password = $data['PARAMETROS']['password'];
$dbname = $data['PARAMETROS']['dbname'];
//----------------------------------------------------------

// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

if (isset($_GET['laboratorio'])) {
    $labo = $_GET['laboratorio'];
    $tabla_destino = $_GET['tabla'];

    // Validar y limpiar los datos de entrada (puedes utilizar funciones de filtrado adecuadas)
    $labo = filter_var($labo, FILTER_SANITIZE_STRING);
    $tabla_destino = filter_var($tabla_destino, FILTER_SANITIZE_STRING);

    // Preparar la consulta SQL con una declaración preparada para evitar SQL Injection
    $stmt = $conn->prepare("SELECT estado_id, date, user, mac, machine_name, ip, memory, processor, disk, gpu, os,laboratorio, software, notsoft FROM $tabla_destino WHERE laboratorio = :labo ORDER BY user ASC");
    $stmt->bindParam(':labo', $labo, PDO::PARAM_STR);
    $stmt->execute();
    
    // Obtener el resultado de la consulta en un array asociativo
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cantidad_filas = count($resultado);

    // Ahora puedes usar $resultado para acceder a los datos de la base de datos
    foreach ($resultado as $row) {
        $estado_id = $row['estado_id'];
        $date = $row['date'];
        $user = $row['user'];
        $mac = $row['mac'];
        $machine_name = $row['machine_name'];
        $ip = $row['ip'];
        $memory = $row['memory'];
        $processor = $row['processor'];
        $disk = $row['disk'];
        $gpu = $row['gpu'];
        $os = $row['os'];
        $laboratorio = $row['laboratorio'];
        $programas = $row['software'];
        $not_programas = $row['notsoft'];
        // Ahora puedes hacer lo que necesites con estas variables
        // ...
    }
}

$secuencia_os = "10";
$secuencia_cpu = "with";

// Buscar la posición de la secuencia
$posicion = strpos($os, $secuencia_os);

if ($posicion !== false) {
    // Usar substr para obtener la parte de la cadena después de la posición encontrada
    $resultado_os = substr($os, 0, $posicion + strlen($secuencia_os));
} else { 
    $resultado_os = $os;
}

// Buscar la posición de la secuencia
$posicion = strpos($processor, $secuencia_cpu);

if ($posicion !== false) {
    // Usar substr para obtener la parte de la cadena después de la posición encontrada
    $resultado_cpu = substr($processor, 0, $posicion);
} else { 
    $resultado_cpu = $processor;
}

$programas_compus = $conn->prepare("SELECT programs FROM software");
$programas_compus->execute();
$allprograms_compus = $programas_compus->fetchAll(PDO::FETCH_COLUMN);

$programas = str_replace(['[', ']', ' '], '', $programas);  // Elimina los corchetes y espacios
$programas_array = explode(',', $programas);  // Divide la cadena en un arreglo usando la coma como separador
$programas_array = array_map('trim', $programas_array); // Eliminar espacios en blanco al principio y al final

$programas_array = array_map(function($item) {
    return trim($item, "\"'"); // Eliminar comillas simples o dobles alrededor de los elementos
}, $programas_array);


$not_programas = str_replace(['[', ']', ' '], '', $not_programas);  // Elimina los corchetes y espacios
$not_programas_array = explode(',', $not_programas);  // Divide la cadena en un arreglo usando la coma como separador
$not_programas_array = array_map('trim', $not_programas_array); // Eliminar espacios en blanco al principio y al final

$not_programas_array = array_map(function($item) {
    return trim($item, "\"'"); // Eliminar comillas simples o dobles alrededor de los elementos
}, $not_programas_array);


$labo = strtoupper($labo);

echo "<head>";
    echo "<title style=''>$labo</title>";
echo "</head>";
echo "<body>";
    echo "<header>";
        echo "<div class='part1'>";
            echo "<a class='logo-text2' href='#'>$labo</a>";
        echo "</div>";
        echo "<div class='part2'>";
            echo "<nav class='headeroptions'>";
                echo "<ul>";
                    echo "<li><a href='../index.php'><img src='../images/homefull.png' alt=''></a></li>";
                echo "</ul>";
            echo "</nav>";
        echo "</div>";
        echo "<div class='part3'>";
            echo "<a class='login-btn' href='../php/login.php'>Acceder <img class='user-img' src='../images/user.png' alt=''></a>";
        echo "</div>";
    echo "</header>";
    echo "<main>";
        echo "<div class='container'>";
            echo "<div class='left'>";
                    echo "<div class='cmd-container'>";
                        echo "<div class='cmd'>";
							echo "<div class='cmdtitle'><img class='cmdicon' src='../images/cmdicon2.png' alt=''>APLICACIONES</div>";
                            echo "<input class='searcher' id='search' type='search' name='buscador' placeholder='Buscar APP'>";                         
                            echo "<div class='apps-grilla'>";
                                echo "<div class='apps-match'>";
                                    foreach ($programas_array as $program) {
                                        $programas_path = "../images/apps/" . $program . ".png";
                                        echo "<img src='$programas_path' title='$program'>";
                                    }
                                echo "</div>";
                                echo "<div class='apps-not'>";
                                    foreach ($not_programas_array as $program) {
                                        $not_programas_path = "../images/apps/" . $program . ".png";
                                        echo "<img src='$not_programas_path' title='$program'>";
                                    }
                                echo "</div>";
                            echo "</div>";   
                        echo "</div>";
                    echo "</div>";
            echo "</div>";
            echo "<div class='right'>";
                echo "<div class='plane-description'>";
                    echo "<div class='plane'>";
                        echo "<img class='planeimg' src='../images/planes/$labo.png' alt=''>";
                    echo "</div>";
                    echo "<div class='description'>";
                        echo "<div class='items'>";
                            echo "<div class='plane-info'>";
                                echo "<div class='item'>";
                                    echo "<img class='pcs' src='../images/pcs.png' alt=''><div style='padding-right:10px;' class='info-letters'>$cantidad_filas</div>";
                                echo "</div>";
                                echo "<div class='item'>";
                                    echo "<img class='disk' src='../images/disky.png' alt=''><div class='info-letters'>$disk</div>";
                                echo "</div>";
                                echo "<div class='item'>";
                                    echo "<img class='cpu' src='../images/cpu.png' alt=''><div class='info-letters'>$resultado_cpu</div>";
                                echo "</div> ";
                                echo "<div class='item'>";
                                    echo "<img class='ram' src='../images/ram.png' alt=''><div class='info-letters'>$memory</div>";
                                echo "</div>";
                                echo "<div class='item'>";
                                    echo "<img class='os' src='../images/os.png' alt=''><div class='info-letters'>$resultado_os</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>    ";
            echo "</div>";
        echo "</div>";
            echo"<div class='cmd-list'>";
                echo"<div class='cmdcontainer-list'>";
                    echo"<div class='cmdtop-list'>";
                        echo"<div class='cmdoption-list'>";
                            echo"<div class='cmdtitle-list'><img class='cmdicon-list' src='../images/cmdicon2.png' alt=''>COMPUTADORAS</div>";
                        echo"</div>";
                    echo"</div>";
                    echo"<div class='cmdmain-list' style='height:' . ($cantidad_filas * 20) . 'px;'>";
                        echo "<div class='tabla'>";
                            echo "<table>";
                                echo "<thead class='table-top'>";
                                    echo "<tr>";
                                        echo "<th></th>";
                                        echo "<th>Usuario</th>";
                                        echo "<th>Procesador</th>";
                                        echo "<th>RAM</th>";
                                        echo "<th>Disco</th>";
                                        echo "<th>Video</th>";
                                        echo "<th>Actualización</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody class='table-info'>";
                                    foreach ($resultado as $fila) {
                                        echo "<tr>";
                                            // STATUS
                                            echo "<td>";
                                            if ($fila["estado_id"] == 1) {
                                                echo "<div id='status1'></div>"; // Div para estado 1
                                            } else {
                                                echo "<div id='status2'></div>"; // Div para estado 2
                                            }
                                            echo "</td>";
                                            
                                            // Otros datos
                                            echo "<td>" . $fila["user"] . "</td>";
                                            echo "<td>" . $fila["processor"] . "</td>";
                                            echo "<td>" . $fila["memory"] . "</td>";
                                            echo "<td>" . $fila["disk"] . "</td>";
                                            echo "<td>". '-'. "</td>";
                                            echo "<td>" . $fila["date"] . "</td>";
                                        echo "</tr>";
                                    }    
                                echo "</tbody>";
                            echo "</table>";
                        echo "</div>";
                    echo"</div>";
                echo"</div>";
            echo"</div>";
    echo "</main>";
    echo "<footer>";
        echo "<div class='footer-container'>";
            echo "<div class='footer-content'>";
                echo "<div class='footer-title'>";
                    echo "Proyecto<div class='footer-hardlab'>HARDLAB</div>";
                echo "</div>";
                echo "<div class='footer-info'>";
                    echo "Fernandez Alejo - Di Nicola Briana - Montarzino Giulianna - Paone Nicolas - Pittis Valentino";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</footer>";
echo "</body>";


//Cierre de la conexión a la base de datos
$conn = null;
?>

