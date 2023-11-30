<?php

//Lectura de JSON con los datos
$jsonData = file_get_contents('daemon_machine_network.json');
$data = json_decode($jsonData, true);

$host = $data['PARAMETROS']['host'];
$port = $data['PARAMETROS']['port'];
$user = $data['PARAMETROS']['user'];
$password = $data['PARAMETROS']['password'];
$dbname = $data['PARAMETROS']['dbname'];

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

$programaspcs_file = "testicons.py";
$programaspcs_script = "programas_instalados()";

$run = shell_exec("python $programaspcs_file 2>&1");
$result = json_decode($run, true);

if ($result !== null) {
    // Si la salida se pudo decodificar como JSON, es un objeto JSON válido
    echo "Resultado de Python: " . print_r($result, true);
} else {
    // Si no se pudo decodificar como JSON, simplemente muestra la salida como texto
    echo "Resultado de Python: <br>" . $run;
}



?>