<?php

// Valor de z dado
$z = 0.9800;

// Calcular el valor de la tabla de distribución normal estándar para z
$valor_tabla = stats_cdf_normal($z, 0, 1);

// Para obtener los valores que deseas, necesitas calcular el área bajo la curva de la distribución normal hasta el valor de z dado.
// Para esto, puedes usar la función de distribución acumulativa `stats_cdf_normal()`.
// Vamos a calcular el valor acumulado desde menos infinito hasta $z para obtener el primer valor deseado.
$valor_1 = stats_cdf_normal(0, 0, 1) - $valor_tabla;

// Y para el segundo valor, calculamos el valor acumulado desde menos infinito hasta 2 (que es el punto que nos interesa).
$valor_2 = stats_cdf_normal(2, 0, 1);

echo "El primer valor deseado es: " . $valor_1 . "<br>";
echo "El segundo valor deseado es: " . $valor_2 . "<br>";

?>



