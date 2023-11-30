<?php
//Lectura de JSON con los datos
$jsonData = file_get_contents('daemon_machine_network.json');
$data = json_decode($jsonData, true);

$host = $data['PARAMETROS']['host'];
$port = $data['PARAMETROS']['port'];
$user = $data['PARAMETROS']['user'];
$password = $data['PARAMETROS']['password'];
$dbname = $data['PARAMETROS']['dbname'];
$tabla_destino = $data['PARAMETROS']['tabla_destino'];
//----------------------------------------------------------

// Conexión a la base de datos
$dsn = $host . ":"  . $port;
$conn = new mysqli($dsn, $user, $password, $dbname);


// Verificación de la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
//----------------------------------------------------------

$sql = "SELECT DISTINCT laboratorio FROM {$tabla_destino}";
$result_labo = $conn->query($sql);


// Verificación del resultado
echo "<div id='laboratoriosprimaria'>";
if ($result_labo->num_rows > 0) {
  // recorre las tablas y arma la informacion--------------------------------------
  while($row = $result_labo->fetch_assoc()) {
    $labo=$row["laboratorio"];

    $sql2 = "SELECT * FROM {$tabla_destino} WHERE laboratorio= '$labo'";
    $result_filtro_labo = $conn->query($sql2);


    $sql3 = "SELECT MAX(date) AS ultima_actualizacion FROM {$tabla_destino} WHERE laboratorio= '$labo'";
    $result_fecha = $conn->query($sql3);
    $found = $result_fecha->fetch_assoc();
    $fecha = $found["ultima_actualizacion"];

    if ($result_filtro_labo->num_rows > 0) {
      $cant= $result_filtro_labo->num_rows;
      echo "<a class='computer' href='./php/labs_index.php?laboratorio=" . $labo . "&tabla=" .$tabla_destino ."'>";
        echo "<div class='screen'><div class='typelab'>". $labo ."</div><div class='power'></div></div>";
        echo "<div class='stick'></div>";
        echo "<div class='soport'></div>";
      echo "</a>";
    } 
    else {
      echo "No se encontró información";
    }  
  }

} else {
  echo "No se encontraron registros.";
}

//-----------------------------------------------------------
// Cierre de la conexión
$conn->close();

?>