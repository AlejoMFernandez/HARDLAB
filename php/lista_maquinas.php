
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.semanticui.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">	

<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>


<style>
* :not(i){
    font-family: 'Montserrat', sans-serif !important;
}

.dataTables_length{
    padding: 20px;
}

#example_paginate {
    display: none;
}

.stripe > tbody > tr.odd > *, table.dataTable.display > tbody > tr.odd > * {
  box-shadow: inset 0 0 0 9999px rgba(26, 26, 26, 22) !important;
}

body{
    background-color: #202020;
    color: #fff;
} 

td {
    font-size: 15px !important;
    padding: 15px !important;
}

th {
    text-transform:uppercase;
}

.text, .item, .menu {
    font-weight: bold;

}

.trash-icon{
    width:20px;
    height:20px;
}

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

<script>

$(document).ready(function () {
    $('#example').DataTable({
        dom: 'Blftrip',
        lengthMenu: [10,25,50,100],
        pageLength: 25,
        select: true,
        columnDefs: [
            { width: "1%", target: [10] },    
        ],

    });
});

function mostrarConfirmacion(maca,labo) {
    laboratorio="eliminadas";
    if (labo==laboratorio){
        var confirmacion = confirm('¿Esta maquina ya fue eliminada. Quiere eliminarla definitivamente ?');
        if (confirmacion) {
        // Llamar a la función de eliminación pasando el ID del registro
        fetch('eliminar.php?del=S&mac=' + maca);
        location.reload(true);
        } 
    }
    else
    {
        var confirmacion = confirm('¿Estás seguro de eliminar la maquina ' + maca + '?');
        if (confirmacion) {
        // Llamar a la función de eliminación pasando el ID del registro
        fetch('eliminar.php?del=N&mac=' + maca);
        location.reload(true);
        } 
    };

};

</script>

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

$stmt = $conn->prepare("SELECT estado_id,date,user,mac,machine_name,ip,memory,processor,disk,gpu,laboratorio FROM $tabla_destino WHERE laboratorio='{$labo}' ORDER BY user ASC");
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo "<div style='padding: 20px;'>";
    //Mostrando datos en una tabla HTML
    echo "<h2>COMPUTADORAS REGISTRADAS</h2>"; 
    echo "<table id='example' class='hover compact stripe row-border' style='width:100%'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th ></th>";
                    echo "<th >Fecha</th>";
                    echo "<th >Usuario</th>";
                    echo "<th >Mac</th>";
                    echo "<th >Maquina</th>";
                    echo "<th >IP</th>";
                    echo "<th >Memoria</th>";
                    echo "<th >Procesador</th>";
                    echo "<th >Disco</th>";
                    echo "<th >Video</th>";
                    echo "<th >Laboratorio</th>";
                    echo "<th ><img class='trash-icon' src='images/trash-can.png'></th>";
                echo "</tr>";
            echo "</thead>";

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
                    echo "<td>" . $fila["date"] . "</td>";
                    echo "<td>" . $fila["machine_name"] . "</td>";
                    echo "<td>" . $fila["mac"] . "</td>";
                    echo "<td>" . $fila["user"] . "</td>";
                    echo "<td>" . $fila["ip"] . "</td>";
                    echo "<td>" . $fila["memory"] . "</td>";
                    echo "<td>" . $fila["processor"] . "</td>";
                    echo "<td>" . $fila["disk"] . "</td>";
                    echo "<td>". '-'. "</td>";
                    echo "<td>" . $fila["laboratorio"] . "</td>";
                    echo "<td><input type='checkbox' class='computer-checkbox' data-mac='" . $fila["mac"] . "'></td>";
                echo "</tr>";
            }    

        echo "</tr>";
    echo "</table>";
echo "</div>";


//Cierre de la conexión a la base de datos
$conn = null;
?>

