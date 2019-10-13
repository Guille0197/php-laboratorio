<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver foto del auto vendido</title>
</head>
<body>
    <?php
    include("conexion.php");

    @$codigox = $_GET["codigox"];
    $sql = "SELECT modelo, ruta FROM inventario_autos WHERE codigo = '".@$codigox."'";
    $consulta = mysqli_query($conn, $sql);

    $fila = mysqli_num_rows($consulta);
    if ($fila){
	    while ($registro = mysqli_fetch_assoc($consulta)) {
            $model=$registro["modelo"];
            $foto=$registro["ruta"];
        }
}

    echo "<table>";
        echo "<tr bgcolor=#ffffcc>";
            echo "<td align=center> ";
                echo "El modelo es: ",$model;
            echo "</td>";

            echo "<tr>";
                echo "<td>";
                    echo"<img src=foto/".$foto.">";
                echo "</td>";
        echo "</tr>";
    echo "</table>";

    ?>
</body>
</html>