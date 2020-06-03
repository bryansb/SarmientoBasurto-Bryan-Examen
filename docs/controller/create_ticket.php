<?php 
    include '../../config/conexionBD.php';

    $cedula = isset($_POST["i_dni"]) ? trim($_POST["i_dni"]): null;
    $placa = isset($_POST["i_plate"]) ? mb_strtoupper(trim($_POST["i_plate"]), 'UTF-8') : null;
    $marca = isset($_POST["i_brand"]) ? mb_strtoupper(trim($_POST["i_brand"]), 'UTF-8') : null;
    $modelo = isset($_POST["i_model"]) ? mb_strtoupper(trim($_POST["i_model"]), 'UTF-8') : null;
    $numero_ticket = isset($_POST["i_ticket_number"]) ? trim($_POST["i_ticket_number"]): null;
    $fecha_ingreso = isset($_POST["i_date_in"]) ? trim($_POST["i_date_in"]): null;
    $hora_ingreso = isset($_POST["i_time_in"]) ? trim($_POST["i_time_in"]): null;
    $fecha_salida = isset($_POST["i_date_out"]) ? trim($_POST["i_date_out"]): null;
    $hora_salida = isset($_POST["i_time_out"]) ? trim($_POST["i_time_out"]): null;

    $sqlCliente = "SELECT cli_codigo FROM clientes WHERE cli_cedula LIKE '$cedula';";

    $resultCl = $conn->query($sqlCliente);

    if ($resultCl) {
        
        if ($resultCl->num_rows > 0) {
            $rowCl = $resultCl->fetch_assoc();

            $sqlVeh = "INSERT INTO vehiculos (veh_codigo, veh_placa, veh_marca, veh_modelo, cli_codigo)
            VALUES
            (NULL, '$placa', '$marca', '$modelo', '". $rowCl['cli_codigo'] ."');";

            if ($conn->query($sqlVeh) === TRUE) {

                $sqlVehiculo = "SELECT veh_codigo FROM vehiculos WHERE veh_placa LIKE '$placa';";
                $resultVeh = $conn->query($sqlVehiculo);
                
                if ($resultVeh) {
                    
                    if ($resultVeh->num_rows > 0) {
                        $rowVeh = $resultVeh->fetch_assoc();

                        $sqlTic= "INSERT INTO tickets (tic_codigo, tic_numero, tic_fecha_ingreso, tic_hora_ingreso, tic_fecha_salida, tic_hora_salida, veh_codigo)
                        VALUES
                        (NULL, '$numero_ticket', '$fecha_ingreso', '$hora_ingreso', '$fecha_salida', '$hora_salida', '". $rowVeh['veh_codigo'] ."');";

                        if ($conn->query($sqlTic) === TRUE) {
                            echo "Se agrego";
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }
                        

                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    //cerrar la base de datos
    $conn->close();
?>