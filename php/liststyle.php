

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>a</title>
<link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.semanticui.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">	


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>

<style>

#status1{
    width:10px;
    height:10px;
    border-radius:100%;
    background-color:green;
}

#status2{
    width:10px;
    height:10px;
    border-radius:100%;
    background-color:red;
}

</style>

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

//--- Recibo el nombre de la tabla desde la pagina
if (isset($_GET['laboratorio'])) {
    $labo = $_GET['laboratorio'];
    $tabla_destino = $_GET['tabla'];
    }

$stmt = $conn->prepare("SELECT estado_id,date,user,mac,machine_name,ip,memory,processor,disk,gpu,laboratorio FROM $tabla_destino WHERE laboratorio='{$labo}' ORDER BY machine_name ASC");
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<body class='m-0 bg-primary'>";
    echo "<div class='m-4'>";
        echo "<div class='row'>";
            echo"<div class='col-lg-12'>";
                echo"<table id='example' class='table table-bordered table-sm table-hover'>";
                    echo"<thead>";
                        echo"<tr class='table-dark'>";
                            echo"<td>STATUS</td>";
                            echo"<td>DATE</td>";
                            echo"<td>MACHINE NAME</td>";
                            echo"<td>MAC</td>";
                            echo"<td>USER NAME</td>";
                            echo"<td>IP</td>";
                            echo"<td>RAM</td>";
                            echo"<td>CPU</td>";
                            echo"<td>DISK</td>";
                            echo"<td>GPU</td>";
                            echo"<td>OS</td>";
                            echo"<td><img src='' alt=''></td>";
                        echo"</tr>";
                    echo"</thead>";
                    echo"<tbody class='table table-dark table-active'>";
            foreach ($resultado as $fila) {
                echo "<tr>";
                    foreach ($fila as $valor) {
                        $maca=$fila["mac"];
                        echo "<td>" . $valor . "</td>";
                    }
                    echo "<td>
                            <input type='checkbox' class='computer-checkbox' data-mac='$maca'>
                        </td>";
                echo "</tr>";
            }    
                    echo"</tbody>";
                echo"</table>";
            echo"</div>";
        echo"</div>";
    echo"</div>";
echo"</body>";


//Cierre de la conexión a la base de datos
$conn = null;

?>