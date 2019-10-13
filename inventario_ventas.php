<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title></title>
    <style type="text/css">
	@import "css/miestilo.css";
	</style>
</head>

<body>

    <div id="wra">
        <div id="cabecera">
            <div id="logocaja">

            </div>
            <div id="headimg">&nbsp;</div>
        </div>
        <div id="topnavi">
            <div class="spacing1">
                <ul type="circle">
                    <li><a href="agencia_auto.php">Inicio</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                </ul>
            </div>


        </div>
        <div id="bodybox">
            <div id="subnavi">
                <!-- menu -->

            <?php
                include("menu.php"); 
                include("conexion.php");
            ?>

            </div>
            <div class="ic"></div>
            <div id="content">
                <center>
                    <h1>Consulta de inventario de las ventas de los autos</h1>
                    <h1></h1>

                    <?php

                     $sql = "SELECT * FROM  inventario_autos";
                     $consulta =  mysqli_query($conn, $sql);
                    
                            echo "<table border=1>";
                                echo "<tr>";
                                    echo "<td> Codigo </td>";
                                    echo "<td> Marca </td>";
                                    echo "<td> Modelo </td>";
                                    echo "<td> Precio de Costo </td>";
                                    echo "<td> Precio de Venta </td>";
                                echo "</tr>";

    
                                    $linea = mysqli_num_rows($consulta);

                                    if ($linea) {
                                       

                                        while ($registro = mysqli_fetch_assoc($consulta)) {
                                            echo"<tr>";
                                                $codigox = $registro["codigo"];
                                                echo"<td> <a href=javascript:ventana(\"verfoto.php?codigox=$codigox\")>";
                                                    echo $codigox;
                                                    echo"</a>";
                                                echo"</td>";

                                                echo"<td>";
                                                    echo $registro['marca'];
                                                echo"</td>";

                                                echo"<td>";
                                                    echo $registro['modelo'];
                                                echo"</td>";

                                                echo"<td>";
                                                    echo $registro['precioCosto'];
                                                echo"</td>";

                                                echo"<td>";
                                                    echo $registro['precioVenta'];
                                                echo"</td>";

                                            echo"</tr>";
                                        }
                                    }
                            echo "</table>";
                    ?>
                </center>
            </div>
        </div>
    <div id="footer">
		<p>Copyright 2019 All Rights Reserved. | Developer by <a href="https://github.com/Guille0197" target="_blank" style="color:Blue;">Guillermo Navarro</a> </p>
		
	</div>
    <script type=text/javascript>
        function ventana(url){
            
            abrir = window.open(url,'Hint','width=500, height=500, scrollbars=NO');
            if(abrir.opener ==null){
                abrir,opener=window;
            }
        }
    </script>
</body>

</html>