<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/main_format.css" rel="stylesheet">
        <link href="../css/form_layout.css" rel="stylesheet"/>
        <link href="../css/2_col_layout.css" rel="stylesheet"/>
        <link href="../css/table_layout.css" rel="stylesheet"/>
        <script src="../js/administration.js"></script>
        <title>Buscar Ticket</title>
    </head>

    <body>
        <header id="main_header">
            
            <div id="logo_container">
                <form id="f_search" action="search_ticket.php" method="POST">  
                    <input type="search" id="index_search" name="index_search" placeholder="Buscar por cédula o placa"/>
                </form>
            </div>

            <nav id="header_nav">
                <a class="nav_a" href="index.html">Inicio</a>
                <a class="nav_a" href="register_ticket.html">Registrar Ticket</a>
                <a class="nav_a" href="search_client.html">Buscar Cliente</a>
                <a class="nav_a" href="search_ticket.php">Buscar Ticket</a>
            </nav>
        </header>

        <?php
            # Seccion PHP que se encarga de iniciar los datos.
            include 'config/conexionBD.php';
            $stringBusqueda = isset($_POST["index_search"]) ? trim($_POST["index_search"]) : null;
            
            $sqlUsuarios_cedula = "SELECT * FROM clientes WHERE usu_cedula LIKE '$stringBusqueda'";
            $resultado_cedula = $conn->query($sqlUsuarios_cedula);

            $sqlVehiculo_placa = "SELECT * FROM vehiculos WHERE veh_placa LIKE '$stringBusqueda'";
            $resultado_placa = $conn->query($sqlVehiculo_placa);
        ?>
        
        <main id="main_search" class="main_container" >
            <section class="col col-40 form_section">
                <div class="table_container">
                    <table id="user_table" class="col-80 table_content">
                        <tr>
                            <th></th>
                            <th colspan="2">Descripción</th>
                        </tr>

                        <?php 
                            # Seccion de PHP donde se inserta los datos del usuario.
                            if ( $resultado_cedula->num_rows > 0) {
                                $resultado = $resultado_cedula;

                                while ($row = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    $codigoUsuario = $row["cli_codigo"]; 

                                    echo "<th class='th_v'>Cédula:</th>";
                                    echo " <td >" . $row["cli_cedula"] . "</td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<th class='th_v'>Nombres:</th>";
                                    echo " <td >" . $row['cli_nombre'] ."</td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<th class='th_v'>Telefono:</th>";
                                    echo " <td >" . $row['cli_telefono'] . "</td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<th class='th_v'>Dirección:</th>";
                                    echo " <td >" . $row['usu_direccion'] . "</td>";
                                    echo "</tr>";
                                }
                        ?>
                    </table>
                </div>
            </section>
            <div class="table_container col col-60">            
                <table id="phones_table" class="col-80 table_content">
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                    </tr>
                    <?php 
                        
                            # Seccion de PHP donde se inserta los telefonos del usuario.
                            $sqlVehiculos = "SELECT * FROM vehiculos WHERE cli_codigo LIKE '$codigoUsuario'";
                            $vehiculos = $conn->query($sqlVehiculos);

                            if ($vehiculos->num_rows > 0) {
                                while ($row = $vehiculos->fetch_assoc()) {
                                    echo "<tr>";
                                    echo " <td>" . $row["veh_placa"] ."</td>";
                                    echo " <td>" . $row["veh_marca"] ."</td>";
                                    echo " <td>" . $row["veh_modelo"] ."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo " <td colspan='3'> No existen vehiculos registrados para el cliente. </td>";
                                echo "</tr>";
                            }
                        
                        } else {
                            echo "<tr>";
                            echo " <td colspan='7'> No existen clientes registrados en el sistema con los parámetros establecidos </td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            <div>
            
        </main>

        <?php
            # Cerrar la conexión a la base de Datos
            $conn->close();
        ?>


    </body>
</html>