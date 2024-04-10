<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <h2>Datos de Sucursales</h2>

    <?php
    
    // Obtener la cantidad de sucursales desde la URL
    $cantidad_sucursales = isset($_GET['sucursales']) ? intval($_GET['sucursales']) : 1;
    $totalUnidades = isset($_GET['totalUnidades']) ? intval($_GET['totalUnidades']) : 1;
    
    // Crear un formulario para cada sucursal
    echo "<p>Total de unidades: $totalUnidades</p>";
    
    echo "<form action='procesar.php?sucursales=$cantidad_sucursales&totalUnidades=$totalUnidades' method='post'>";
    for ($i = 1; $i <= $cantidad_sucursales; $i++) {
        echo "<h3>Sucursal $i</h3>";
        echo "<label for='nombre_$i'>Nombre:</label><br>";
        echo "<input type='text' id='nombre_$i' name='nombre_$i' required><br>";
        
        echo "<label for='existencias_$i'>Nivel actual de existencias (unidades):</label><br>";
        echo "<input type='number' id='existencias_$i' name='existencias_$i' required><br>";
        
        echo "<label for='demanda_$i'>Demanda pronóstica mensual:</label><br>";
        echo "<input type='number' id='demanda_$i' name='demanda_$i' rows='4' required><br>";

        echo "<label for='desviacion_$i'>Error de pronóstico (desviación estándar mensual):</label><br>";
        echo "<input type='text' id='desviacion_$i' name='desviacion_$i' step='any' required><br>";

        echo "<label for='factor_$i'>Nivel de disponibilidad de existencias (Factor Z)</label><br>";
        echo "<input type='text' id='factor_$i' name='factor_$i' rows='4' required step='any'><br>";

        echo "<label for='valor_$i'>Tabla de distribución normal:</label><br>";
        echo "<input type='text' id='valor_$i' name='valor_$i' rows='4' required step='any'><br>";
        
        echo "<input type='hidden' name='sucursal_$i' value='$i'>";
        
        echo "<br>";
    }
    echo "<input type='submit' value='Enviar'>";
    echo "</form>";
    ?>
</body>
</html>








