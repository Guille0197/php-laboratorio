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
                    <li><a href="#">Contacto</a></li>

                </ul>
            </div>

        </div>

        <!-- menu -->
        <div id="bodybox">
            <div id="subnavi">
                <?php include("menu.php"); ?>
            </div>

            <div class="ic"></div>
            <div id="content" style="background-color: #dde3e6;">
                <center>
                    <h1 style="color: #ac1e0f;">Agencia de Auto Ricardo Pérez S.A</h1>
                    <h2 style="color: #ac1e0f;">Compras de Auto</h2>
                    <!-- solucion de problema -->

            <?php 
                include("conexion.php");

            @$buscar = $_POST["buscar_x"];
            @$guardar = $_POST["guardar_x"];
            @$actualizar = $_POST["actualizar_x"];
            @$eliminar = $_POST["eliminar_x"];
            @$limpiar = $_POST["limpiar_x"];

            @$code = $_POST["code"];
            @$codigox = $_POST["codigox"];

            @$brand = $_POST["brand"];
            @$model = $_POST["model"];
            @$price_cost = $_POST["price_cost"];
            @$price_sale = $_POST["price_sale"];
            @$fotoe = $_FILES["foto"]["name"];


            if(@$guardar){

                 if (($fotoe!="")&& ($_FILES["foto"]["size"]!=0)) {
                     if (($_FILES["foto"]["type"] == "image/gif") ||
                     ($_FILES["foto"]["type"] == "image/jpeg") ||
                     ($_FILES["foto"]["type"] == "image/png")) {
                        copy($_FILES["foto"]["tmp_name"], "foto/$code$fotoe");
                        $foto = $codigox.$fotoe;
                     }
                 }
                
                if($code == null or $brand == null or $model == null or $price_cost == null or $price_sale== null ){
                    echo"<h1> Porfavor introduzca los datos</h1>";
                }
                else{
                    $sql = "INSERT INTO inventario_autos (codigo, marca, modelo, precioCosto, precioVenta,ruta)
                        values('$code','$brand','$model','$price_cost','$price_sale','$foto')";
                    $consulta =  mysqli_query($conn, $sql);
                    $sw=1;
                }
                //  if ($conn->query($sql) === TRUE) {
                //      echo "New record created successfully";
                //  } else {
                //      echo "Error: " . $sql . "<br>" . $conn->error;
                //  }
            }

            if(@$actualizar){
                $sql = "UPDATE inventario_autos set codigo = '$codigox',  marca = '$brand', modelo = '$model', precioCosto = '$price_cost', precioVenta = '$price_sale', ruta = '$fotoe' where codigo = '$codigox' ";
                $sw=2;
                $consulta =  mysqli_query($conn, $sql);
            }

            if (@$eliminar) {
                $sql = "DELETE FROM inventario_autos where codigo='$codigox'";
                mysqli_query($conn, $sql);
                $sw =3;
                $brand = "";
                $model="";
                $price_cost ="";
                $price_sale ="";
                $precio_7_porciento=0.0;
                $code = "";
                $foto ="";
                
            }

            if (@$limpiar) {
                $sw =4;
                $brand = "";
                $model="";
                $price_cost ="";
                $price_sale ="";
                $code = "";
                $precio_7_porciento="";
                $foto ="";
                
            }

            if (@$buscar) {
                $code = $_POST["code"];
                $sql = "SELECT * FROM inventario_autos where codigo='$code'";

                $consulta =  mysqli_query($conn, $sql);
                $fila = mysqli_num_rows($consulta);

                if ($fila) {
                    while ($registro = mysqli_fetch_assoc($consulta)) {
                       $brand=$registro["marca"];
                       $model=$registro["modelo"];
                       $price_cost=$registro["precioCosto"];
                       $price_sale=$registro["precioVenta"];
                       #$precio_7_porciento=$registro["precioVenta"];
                       $foto=$registro["ruta"];
                    }
                }
                else{
                    $sw = 0;
                    $brand = "";
                    $model = "";
                    $price_sale = "";
                    $price_cost = "";
                }
            }
                echo "<table>";
                    echo "<tr style=background-color:#86f09d;>";
                        echo "<form name=miform action=agencia_auto.php method=post ENCTYPE=multipart/form-data>";
                            //Codigo
                            echo"<td style=background-color:#86f09d;color:Blue; align=center>Código:</td> ";
                            echo"<td> <input type=text name=code size=20 value=".@$code."> </td>";
                            //Buscador
                            echo"<td style=background-color:#dde3e6;>";
                                echo "<input type=Image src=button/buscar.png name=buscar value=Filas width=30px height=30px> Buscar";
                            echo"</td>";                           
                        echo"</tr>";

                        //Marca del auto
                        echo"<tr>";
                            echo "<td style=background-color:#86f09d;color:Blue; align=center>";
                                echo "Marca:";
                            echo "</td>";
                            echo "<td style=background-color:#86f09d;color:Blue;>";
                                echo "<input type=text name=brand  value=\"".@$brand."\">";
                                //Seleciona Imagen
                                echo"<td style=background-color:#dde3e6;>";
                                    echo"<input type=file name=foto>";
                                echo"</td>";
                            echo "</td>";
                        echo"</tr>";

                        //Modelo del auto
                        echo"<tr style=background-color:#86f09d;>";
                            echo "<td style=color:Blue; align=center>";
                                echo "Modelo:";
                            echo "</td>";
                            echo "<td>";
                                echo "<input type=text name=model value=".@$model.">";

                                //Muestra la ruta de la imagen seleccionada
                                echo"<td style=background-color:#dde3e6;>";
                                    echo "Ruta: ";
                                    echo "<input type=text name=ruta size=35 value=labo3/foto/".@$foto.">";
                                echo"</td>";
                            echo "</td>";              
                        echo"</tr>";

                        //Precio costo del auto
                        echo"<tr style=background-color:#86f09d; align=center>";
                            echo "<td style=color:Blue;>";
                                echo "Precio de Costo:";
                            echo "</td>";

                            echo "<td>";
                                echo "<input type=number step=0.001 name=price_cost size=20 value=".@$price_cost.">";
                            echo "</td>";   
                            
                                //Se muestra la imagen selecionada del auto
                                echo"<td style=background-color:#dde3e6;>";
                                    if (@$foto) {
                                        echo "<img src=foto/".@$foto." width=50% height=35%>";
                                    }
                                    else{
                                        echo "<img src=foto/cars.png width=50% height=35%>";
                                    }
                                echo"</td>";
                        echo"</tr>";

                            //Precio venta del auto
                        echo"<tr style=background-color:#86f09d; align=center>";
                            echo "<td style=color:Blue;>";
                                echo "Precio de venta:";
                            echo "</td>";

                            echo "<td>";
                                echo "<input type=number step=0.001 name=price_sale size=20 value=".@$price_sale.">";
                                
                                @$precio7 = @$price_sale * 0.07;
                                @$precio_7_porciento = @$precio7 + @$price_sale;

                                echo "El precio con el 7%: ",$precio_7_porciento;
                            echo "</td>";               
                        echo"</tr>";

                        // boton oculto
                        echo"<input type=hidden name=codigox value=".@$code.">";
                            //Table Botones
                            echo"<table>";
                                echo"<tr>";
                                    echo "<td>";
                                        echo "<input type=Image src=button/add.png name=guardar value=Guardar width=30px height=30px> Registar";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<input type=Image src=button/update.png name=actualizar value=actualizar width=30px height=30px>Actualizar";
                                    echo "</td>";    
                                    echo "<td>";
                                        echo "<input type=Image  src=button/delete.png name=eliminar value=eliminar width=30px height=30px>Borrar";
                                    echo "</td>";  
                                    echo "<td>";
                                        echo "<input type=Image src=button/clean.png name=limpiar value=limpiar width=30px height=30px>Limpiar";
                                    echo "</td>";
                                echo"</tr>";
                            echo"</table>";
                    echo "</form>";
                    echo "</table>";

                    switch (@$sw) {
                        case '0':
                            echo"<h2 style=color:gray;>¡No se encuentra ese codigo de auto!</h2>";
                            break;
                        case '1':
                            echo"<h2 style=color:green;>Datos Insertados ✔</h2>";
                            break;
                        case '2':
                            echo"<h2 style=color:blue;>Datos actualizados! 😎♻</h2>";
                            break;
                        case '3':
                            echo"<h2 style=color:red;>Datos eliminados ❌</h2>";
                            break;
                        case '4':
                            echo"<h2 style=color:orange;>Datos limpiados 🧹</h2>";
                            break;
                    }
                ?>

                </center>
            </div>
        </div>
        <div id="footer">
            <p>Copyright 2019 All Rights Reserved. | Developer by <a href="https://github.com/Guille0197" target="_blank" style="color:Blue;">Guillermo Navarro</a> </p>

        </div>
    </div>
</body>

</html>