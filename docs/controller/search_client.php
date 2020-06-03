<?php
    include '../../config/conexionBD.php';

    $cedula = $_POST['i_filter'];
        
    $sql = "SELECT * FROM clientes WHERE cli_cedula LIKE '$cedula';";

    $table_head = " <tr>
                        <th>Cedula</th>
                        <th>Nombres Completos</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                    </tr> ";

    $resultUs = $conn->query($sql);

    echo $table_head;

    if ($resultUs) {

        if ($resultUs->num_rows > 0) {

            while ($rowUs = $resultUs->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $rowUs['cli_cedula'] ."</td>";
                echo "<td>". $rowUs['cli_nombre'] ."</td>";
                echo "<td>". $rowUs['cli_direccion'] ."</td>";
                echo "<td>". $rowUs['cli_telefono'] ."</td>";
                echo " </tr>"; 
            }
        
        } else {
            echo "<tr>";
            echo "<td colspan='4'> No existen usuarios registrados con los criterios de busqueda.</td>";
        }

    } else {
        echo " <tr><td colspan='4'>Error: " . mysqli_error($conn) . "</td></tr>";
        echo "</tr>";
    }
    
    $conn->close();
?>