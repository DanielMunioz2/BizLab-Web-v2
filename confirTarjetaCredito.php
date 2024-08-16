<?php

    session_start();

    require("conexion.php");
    require("vendor\autoload.php");

    // Comprobamos si el usuario esta logueado
    if(isset($_SESSION["iniciado"])){

        // Comprobamos si existe el envio del formulario
        if(isset($_POST["numeroTarjeta"])){

            // Tomando datos de la tarjeta de crédito
            $numTarje = $_POST["numeroTarjeta"];
            $cvcTarje = $_POST["cvcTarjeta"];
            $mesVTarje = $_POST["mesVTarjeta"];
            $añoVTarje = $_POST["anioVTarjeta"];
            //---------------------------------------------------------------

            // Conexión con Epayco
            $epayco = new Epayco\Epayco(array(
                "apiKey" => "2748d9ab9c7041e36711c19f4802c8cf",
                "privateKey" => "f668dd14c93aff3d78e8876a4634628e",
                "lenguage" => "ES",
                "test" => true
            ));
            //---------------------------------------------------------------

            // Buscando la data del usuario
            $resultUser = "";

            $resultUser = $conn->query(
                "SELECT * FROM `bizlab`.`usuarios`
                WHERE `usuarios`.`id_usuario` = ".$_SESSION['iniciado'].";"
            );

            $resultUser = $resultUser->fetch_assoc();
            //---------------------------------------------------------------

            // Buscando las tarjetas registradas
            $resultadoTarjetas = "";

            $resultadoTarjetas = $conn->query(
                "SELECT * FROM `bizlab`.`tarjetascredito`
                WHERE `tarjetascredito`.`tarje_numero` = '".$numTarje."'"
            );

            $resultadoTarjetas = $resultadoTarjetas->fetch_assoc();
            //---------------------------------------------------------------
            
            //-----------------------------------------------------------------------------------

            // Comprobando la existencia de la tarjeta en la DB 
            //(Si no esta registrada, insertar la nueva tarjeta)
            //(Si esta registrada, se actualizara el token Epayco de la tarjeta)
            $idTarjeta = "";
            $existe = "";
            $resultToken = "";
            $token = "";
            $estadoT = "";

            if($resultadoTarjetas == null){

                $token = $epayco->token->create(array(
                    "card[number]" => $numTarje, //4575623182290326
                    "card[exp_year]" => $añoVTarje, //2025
                    "card[exp_month]" => $mesVTarje, //12
                    "card[cvc]" => $cvcTarje, //123
                    "hasCvv" => true //hasCvv: validar codigo de seguridad en la transacción
                ));

                $resultToken = $token->{"status"};

                if($resultToken==true){
                    
                    $existe = "Tarjeta Existente, NO REGISTRADA en DB";
                    $idTarjeta = $token->{"id"};
                    $estadoT = $token->{"data"};
                    $maskCard = $token->{"card"}->{"mask"};

                    $conn->query("INSERT INTO `bizlab`.`tarjetascredito` (`tarje_mask`, `tarje_tokenEpayco`, `tarje_numero`, `tarje_cvc`) VALUES ('$maskCard', '$idTarjeta', '$numTarje', '$cvcTarje');"); 
                    
                }else{

                    $idTarjeta = null;
                    $estadoT = null;
                    $existe = "Tarjeta Inexistente";
                    
                }

            }else{

                $idTarjeta = "";
                $existe = "Tarjeta Existente, REGISTRADA en DB";
                
                $token = $epayco->token->create(array(
                    "card[number]" => $numTarje, 
                    "card[exp_year]" => $añoVTarje,
                    "card[exp_month]" => $mesVTarje, 
                    "card[cvc]" => $cvcTarje, 
                    "hasCvv" => true //hasCvv: validar codigo de seguridad en la transacción
                ));

                $idTarjeta = $token->{"id"};
                $estadoT = $token->{"data"};
                $maskCard = $token->{"card"}->{"mask"};

                $conn->query("UPDATE `bizlab`.`tarjetascredito` SET `tarjetascredito`.`tarje_tokenEpayco` = '$idTarjeta', `tarjetascredito`.`tarje_mask` = '$maskCard' WHERE (`tarjetascredito`.`id_tarjetaCre` = '".$resultadoTarjetas["id_tarjetaCre"]."');");

            }
            //---------------------------------------------------------------

            echo json_encode([$idTarjeta, $existe, $token], JSON_UNESCAPED_UNICODE);
            
        }else{

            header("location:index.php");

        }

    }else{

        header("location:inicioSesion.php");

    }

?>