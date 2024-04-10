<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta del Formulario</title>
</head>
<body>
    <h2>Datos del formulario:</h2>
    <?php
    $totalDemanda=0;
    $totalNetos=0;
    $sucursales = isset($_GET['sucursales']) ? $_GET['sucursales'] : 0;
    $totalUnidades = isset($_GET['totalUnidades']) ? $_GET['totalUnidades'] : 0;
    echo "<p>Total de unidades: $totalUnidades</p>";
// Función calcular requerimientos totales
function requerimientos($demanda, $desviacion, $tabla) {
    $requerimiento = round(($demanda + ($desviacion * $tabla)),0);
    return $requerimiento;
}

// Función calcular requerimientos totales
function prorroteo($demanda, $totalUnidades, $totalNetos, $totalDemanda) {
$prorroteo = round((($demanda * ($totalUnidades - $totalNetos))/$totalDemanda),0);
return $prorroteo;
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'nombre_') !== false) {
                $sucursal = substr($key, strpos($key, '_') + 1);
                $nombre = $_POST["nombre_$sucursal"];
                $existencias = $_POST["existencias_$sucursal"];
                $demanda = $_POST["demanda_$sucursal"];
                $desviacion = $_POST["desviacion_$sucursal"];
                $factor = $_POST["factor_$sucursal"];
                $valor = $_POST["valor_$sucursal"];

                $totalDemanda= $totalDemanda + $demanda;
                
                $resultadoRequerimientos = requerimientos($demanda, $desviacion, $valor);
                $resultadoNetos = $resultadoRequerimientos - $existencias;
                $totalNetos= $totalNetos + $resultadoNetos;   
            }
        }
    } else {
        echo "<p>No se han recibido datos del formulario.</p>";
    }


    


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mostrar los datos de todas las sucursales
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'nombre_') !== false) {
                


                $sucursal = substr($key, strpos($key, '_') + 1);
                $nombre = $_POST["nombre_$sucursal"];
                $existencias = $_POST["existencias_$sucursal"];
                $demanda = $_POST["demanda_$sucursal"];
                $desviacion = $_POST["desviacion_$sucursal"];
                $factor = $_POST["factor_$sucursal"];
                $valor = $_POST["valor_$sucursal"];

                $resultadoRequerimientos = requerimientos($demanda, $desviacion, $valor);
                $resultadoNetos = $resultadoRequerimientos - $existencias;
                $resultadoProrroteos = prorroteo($demanda, $totalUnidades, $totalNetos, $totalDemanda);
                $resultadoAsignacion=$resultadoNetos+$resultadoProrroteos;

                echo "<h2>Sucursal $nombre</h2>";

                echo "<table border='1'>";
                echo "<tr>
                <td><strong>Existencias:</strong></td>
                <td><strong>Demanda:</strong></td>
                <td><strong>Desviación Estándar:</strong></td>
                <td><strong>Factor Z:</strong></td>
                <td><strong>Tabla Dis Normal:</strong></td>
                </tr>";
                echo "<tr>
                        <td>$existencias</td>
                        <td>$demanda</strong></td>
                        <td>$desviacion</strong></td>
                        <td>$factor</td>
                        <td>$valor</td>
                    </tr><br>";  
                    echo "</table>";
    

                echo "<table border='1'>";
                echo "<tr>
                        <td><strong>Requerimientos totales:</strong></td>
                        <td><strong>Nivel Actual de Existencias:</strong></td>
                        <td><strong>Requerimientos netos:</strong></td>
                        <td><strong>Excesos Prorroteados:</strong></td>
                        <td><strong>Asignación despacho:</strong></td>
                    </tr>";
                echo "<tr>
                        <td>$resultadoRequerimientos</td>
                        <td>$existencias</strong></td>
                        <td>$resultadoNetos</strong></td>
                        <td>$resultadoProrroteos</td>
                        <td>$resultadoAsignacion</td>
                        </tr><br>";  
                        echo "</table>";   

            echo "<h3>La asignación de la sucursal $nombre es de $resultadoAsignacion unidades</h3>";
            }
        }
    } else {
        echo "<p>No se han recibido datos del formulario.</p>";
    }   
    ?>
</body>
</html>






