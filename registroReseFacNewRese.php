<?php
    
    session_start();

    require("conexion.php");

    require __DIR__ . "/vendor/autoload.php";
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use Dompdf\Dompdf;
    use Dompdf\Options;

    date_default_timezone_set('America/Bogota');

    if(isset($_POST["diaReseInicioXH"])){

        $tituloRese = $_POST["tituloRese"];
        $activiRese = $_POST["activiRese"];
        $idUserRese = $_POST["idUserRese"];
        $idProdRese = $_POST["idProdRese"];
        $idUnidRese = $_POST["idUnidRese"];
        $numPersoRese = $_POST["numPersoRese"];
        $tipoRese = $_POST["tipoRese"];
        $diaReseInicioXH = $_POST["diaReseInicioXH"];
        $horaEntraInputXH = $_POST["horaEntraInputXH"];
        $horaSaleInputXH = $_POST["horaSaleInputXH"];
        $cantHorasXH = $_POST["cantHorasXH"];
        $cantMinusXH = $_POST["cantMinusXH"];
        $diaReseInicioXD = $_POST["diaReseInicioXD"];
        $diaReseFinalXD = $_POST["diaReseFinalXD"];
        $cadenaDiasInputXD = $_POST["cadenaDiasInputXD"];
        $cantDiasInputXD = $_POST["cantDiasInputXD"];
        $semanaDiaInicio = $_POST["semanaDiaInicio"];
        $semanaDiaFinal = $_POST["semanaDiaFinal"];
        $semanaCadenaDias = $_POST["semanaCadenaDias"];
        $ivaPdt = $_POST["ivaPdt"];
        $descuPdt = $_POST["descuPdt"];
        $reseCodigo = $_POST["reseCodigo"];

        // Fecha y hora de la creación
        $fechaCrea = date("Y-m-d");
        $horaCrea = date("h:i A");
        //--------------------------------------------------------
        
        $serieReseFac = $_POST["serieReseFac"];
        $fechaFactuVenci = $_POST["fechaFactuVenci"];
        $precio = $_POST["precio"];
        $precioXCant = $_POST["precioXCant"];
        $precioTotal = $_POST["precioTotal"];
        $referenceEpaycoRese = $_POST["referenceEpaycoRese"];
        $codigoFacRese = $_POST["codigoFacRese"];
        $numCuotasRese = $_POST["numCuotasRese"];
        $transaTipoPago = $_POST["transaTipoPago"];
        $franquicieCard = $_POST["franquicieCard"];
        $nombreBanco = $_POST["nombreBanco"];
        $respuestaEpaycoTransa = $_POST["respuestaEpaycoTransa"];
        $motivoEpaycoTransa = $_POST["motivoEpaycoTransa"];

        $_SESSION["iniciado"] = intval($idUserRese);
        $_SESSION["stdProd"] = 4;

        if($tipoRese == "hora"){

            $fechaReseInicioDB = $diaReseInicioXH;
            $fechaReseFinalDB = $diaReseInicioXH;
            $fechaHistoInicioDB = $diaReseInicioXH ;
            $fechaHistoFinalDB = $diaReseInicioXH;
            $horaEntrada = $horaEntraInputXH;
            $horaSalida = $horaSaleInputXH;

        }else{

            if($tipoRese == "dia"){

                $fechaReseInicioDB = $diaReseInicioXD;
                $fechaReseFinalDB = $diaReseFinalXD;
                $fechaHistoInicioDB = $diaReseInicioXD;
                $fechaHistoFinalDB = $diaReseFinalXD;
                $horaEntrada = "7:00 AM";
                $horaSalida = "7:00 PM";

            }else{

                $fechaReseInicioDB = $semanaDiaInicio;
                $fechaReseFinalDB = $semanaDiaFinal;
                $fechaHistoInicioDB = $semanaDiaInicio;
                $fechaHistoFinalDB = $semanaDiaFinal;
                $horaEntrada = "7:00 AM";
                $horaSalida = "7:00 PM";

            }

        }
        
?>
<script>history.replaceState(null,null,"index.php");</script>
<?php

        //--------------------------------------------------------------------------------------------------
        // Insertando RESERVA en la Base de Datos

            if($tipoRese == "hora"){

                $resultado = $conn->query(
                    "INSERT INTO `bizlabDB`.`reservas`
                    (`codigoReserva`, `serieReserva`, `estadoReserva`, `fechaCompraReser`, 
                    `horaCompraReser`, `reserTipo`, `fechaReserva`, 
                    `horaEntradaR`, `horaSalidaR`, 
                    `reserHorasDuracion`, `reserMinusDuracion`, 
                    `reserDiasDuracion`, `reserDiaFinal`,
                    `reserDiaFechas`, `reserSemanaFechas`,
                    `precioReserva`, `comisionReserva`, 
                    `numPersonas`, `reservaTitulo`, `reservaActividad`, 
                    `id_unidad`, `id_usuario`, `id_producto`)
                    VALUES
                    ('$reseCodigo', '$serieReseFac', 'Pendiente', '$fechaCrea', 
                    '$horaCrea', '$tipoRese', '$fechaReseInicioDB', 
                    '$horaEntrada', '$horaSalida',
                    '$cantHorasXH', '$cantMinusXH', 
                    '$cantDiasInputXD', '$fechaReseFinalDB',
                    '$cadenaDiasInputXD', '$semanaCadenaDias',
                    ".$precioTotal.", 0,
                    '$numPersoRese', '$tituloRese', '$activiRese', 
                    ".intval($idUnidRese).", ".intval($idUserRese).", ".intval($idProdRese).");"
                );

            }
            
            if($tipoRese == "dia"){

                $dias = explode(",", $cadenaDiasInputXD);

                for($i = 0; $i < count($dias); $i++){

                    $resultado = $conn->query(
                        "INSERT INTO `bizlabDB`.`reservas`
                        (`codigoReserva`, `serieReserva`, `estadoReserva`, `fechaCompraReser`, 
                        `horaCompraReser`, `reserTipo`, `fechaReserva`, 
                        `horaEntradaR`, `horaSalidaR`, 
                        `reserHorasDuracion`, `reserMinusDuracion`, 
                        `reserDiasDuracion`, `reserDiaFinal`,
                        `reserDiaFechas`, `reserSemanaFechas`,
                        `precioReserva`, `comisionReserva`, 
                        `numPersonas`, `reservaTitulo`, `reservaActividad`, 
                        `id_unidad`, `id_usuario`, `id_producto`)
                        VALUES
                        ('$reseCodigo', '$serieReseFac', 'Pendiente', '$fechaCrea', 
                        '$horaCrea', '$tipoRese', '".$dias[$i]."', 
                        '$horaEntrada', '$horaSalida',
                        '$cantHorasXH', '$cantMinusXH', 
                        '$cantDiasInputXD', '$fechaReseFinalDB',
                        '$cadenaDiasInputXD', '$semanaCadenaDias',
                        ".intval($precioTotal).", 0,
                        '$numPersoRese', '$tituloRese', '$activiRese', 
                        ".intval($idUnidRese).", ".intval($idUserRese).", ".intval($idProdRese).");"
                    );

                }

            }

            if($tipoRese == "semana"){

                $dias = explode(",", $semanaCadenaDias);

                for($i = 0; $i < count($dias); $i++){

                    $resultado = $conn->query(
                        "INSERT INTO `bizlabDB`.`reservas`
                        (`codigoReserva`, `serieReserva`, `estadoReserva`, `fechaCompraReser`, 
                        `horaCompraReser`, `reserTipo`, `fechaReserva`, 
                        `horaEntradaR`, `horaSalidaR`, 
                        `reserHorasDuracion`, `reserMinusDuracion`, 
                        `reserDiasDuracion`, `reserDiaFinal`,
                        `reserDiaFechas`, `reserSemanaFechas`,
                        `precioReserva`, `comisionReserva`, 
                        `numPersonas`, `reservaTitulo`, `reservaActividad`, 
                        `id_unidad`, `id_usuario`, `id_producto`)
                        VALUES
                        ('$reseCodigo', '$serieReseFac', 'Pendiente', '$fechaCrea', 
                        '$horaCrea', '$tipoRese', '".$dias[$i]."', 
                        '$horaEntrada', '$horaSalida',
                        '$cantHorasXH', '$cantMinusXH', 
                        '$cantDiasInputXD', '$fechaReseFinalDB',
                        '$cadenaDiasInputXD', '$semanaCadenaDias',
                        ".intval($precioTotal).", 0,
                        '$numPersoRese', '$tituloRese', '$activiRese', 
                        ".intval($idUnidRese).", ".intval($idUserRese).", ".intval($idProdRese).");"
                    );

                }

            }
        
            $idInsertadoReserva = $conn->insert_id;

        //--------------------------------------------------------------------------------------------------
        
        //--------------------------------------------------------------------------------------------------
        // Insertando FACTURA en la Base de Datos

            $resultado2 = $conn->query(
                "INSERT INTO `bizlabDB`.`facturas`
                (`refEpayco`, `epaycoRespuesta`, `epaycoMotivo`, 
                `facturaCodigo`, `facturaSerie`, `fechaFactura`, 
                `horaFactura`, `fechaFacturaV`, `estadoFactura`, `precioFactura`, 
                `factuSubTotal`, `ivaFactura`, `descuFactura`, `montoFactuTotal`,
                `metodoPago`, `tarjetaFranquicia`, `bancoNombre`, `id_producto`, 
                `id_usuario`, `id_unidad`, `id_reserva`)
                VALUES
                ('$referenceEpaycoRese', '$respuestaEpaycoTransa', '$motivoEpaycoTransa', 
                '$codigoFacRese', '$serieReseFac', '$fechaCrea',
                '$horaCrea', '$fechaFactuVenci', 'Pagada', '$precio', 
                ".intval($precioXCant).", ".intval($ivaPdt).", ".intval($descuPdt).", ".intval($precioTotal).",
                '$transaTipoPago', '$franquicieCard', '$nombreBanco', ".intval($idProdRese).",
                ".intval($idUserRese).", ".intval($idUnidRese).", $idInsertadoReserva);"
            );

            $idInsertadoFactura = $conn->insert_id;

        //--------------------------------------------------------------------------------------------------

        //--------------------------------------------------------------------------------------------------
        // Insertando HISTORIAL en la Base de Datos

            $resultado3 = $conn->query(
                "INSERT INTO `bizlabDB`.`historial`
                (`tarea_fOrigen`, `tarea_hOrigen`, `tarea_fechaEje`, `tarea_fechaFEje`, 
                `tarea_horaEje`, `tarea_horaFEje`, `tarea_tipo`, `tarea_estado`, `tarea_usuario`, 
                `tarea_producto`, `tarea_factura`, `tarea_reserva`, `tarea_unidad`)
                VALUES
                ('$fechaCrea', '$horaCrea', '$fechaHistoInicioDB', '$fechaHistoFinalDB',
                '$horaEntrada', '$horaSalida', 'Reserva', 'Pendiente', ".intval($idUserRese).",
                ".intval($idProdRese).", $idInsertadoFactura, $idInsertadoReserva, ".intval($idUnidRese).");"
            );

            $idInsertadoHistorial = $conn->insert_id;

        //--------------------------------------------------------------------------------------------------

        //--------------------------------------------------------------------------------------------------
        //---------------------
        // Crear Factura
        //---------------------

            $resultadoUser = 
            $conn->query(
                "SELECT * FROM `bizlabDB`.`usuarios` 
                WHERE `usuarios`.`id_usuario` = ".$_SESSION["iniciado"]."");
        
            $resultadoUser = $resultadoUser->fetch_assoc();

            $direccUser = $resultadoUser["user_direc"];
            $numPedido = $idInsertadoReserva;
            $fCaduFac = date("Y-m-d",strtotime($fechaCrea."+ 7 days"));
            $numFac = $idInsertadoFactura;
            $nomUser = $resultadoUser["user_nombre"]." ".$resultadoUser["user_apellido"];
            $correoUser = $resultadoUser["user_correo"];

            $options = new Options;
            $options->setChroot(__DIR__);
            $options->setIsRemoteEnabled(true);

            $dompdf = new Dompdf($options);

            $dompdf->setPaper("A5", "landscape");

            $html = file_get_contents("plantillaFacRese.html");
            $html = str_replace(["{{fechaCreaFac}}", "{{horaCreaFac}}", "{{serieFac}}", 
                "{{codFac}}", "{{iva}}", "{{descu}}", 
                "{{precio}}", "{{subtotal}}", "{{total}}", 
                "{{direcc}}", "{{numPedido}}", "{{fCaduca}}",
                "{{numFac}}", "{{nomUser}}"],
                [$fechaCrea, $horaCrea, $serieReseFac,
                $codigoFacRese, $ivaPdt, $descuPdt,
                $precio, $precioXCant, $precioTotal,
                $direccUser, $numPedido, $fCaduFac,
                $codigoFacRese, $nomUser], 
                $html);

            $dompdf->loadHtml($html);
            $dompdf->render();

            $dompdf->addInfo("Title", "Factura-Reserva");

            // $dompdf->stream("Factura-Mem".$diaTexto.$hora1.$hora2.$hora3.".pdf", ["Attachment" => 1]);

            $diaTexto = date("Ymd");
            $hora1 = date("H");
            $hora2 = date("i");
            $hora3 = date("s");

            $output = $dompdf->output();
            file_put_contents("bills/Factura-Rese".$diaTexto.$hora1.$hora2.$hora3.".pdf", $output);

        //--------------------------------------------------------------------------------------------------

        //--------------------------------------------------------------------------------------------------
        //------------------------------------------------------------
        // Enviar Correo con la Factura y el código de la reserva
        //------------------------------------------------------------

            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();                              //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;             //Enable SMTP authentication
            $mail->Username   = 'dmunioz2034@gmail.com';   //SMTP write your email
            $mail->Password   = 'jiabbmmobophejbg';      //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
            $mail->Port       = 465;                                    

            //Recipients
            $mail->setFrom('abcde2034@gmail.com', 'BizLab SAS'); // Sender Email and name
            $mail->addAddress($correoUser);     //Add a recipient email  
            $mail->addReplyTo('abcde2034@gmail.com', 'BizLab SAS'); // reply to sender email

            //Attachments
            $mail->addAttachment('bills/Factura-Rese'.$diaTexto.$hora1.$hora2.$hora3.'.pdf');

            //Content
            $mail->isHTML(true);               //Set email format to HTML
            $mail->Subject = 'BizClub - Nueva Reserva | Factura de Compra';   // email subject headings
            $mail->Body    = '<span style="font-size: 15px; color: #444; font-family: `Montserrat`, sans-serif;">Descargue la factura adjunta:</span><br><br>
            <b style="font-size: 15px; color: #444; font-family: `Montserrat`, sans-serif;">Su código de reserva es: </b><span style="font-size: 15px; margin-left: .2rem; color: #444; font-family: `Montserrat`, sans-serif;">'.$reseCodigo.'</span><br><br>
            <span style="font-size: 15px; color: #444; font-family: `Montserrat`, sans-serif;">IMPORTANTE: Guarde este código para acceder a las instalaciones de BizClub e identificarse.</span><br><br><br>
            ------------------------------------------------------------------------------------------------<br><br>
            <span style="font-size: 15px; color: #444; font-family: `Montserrat`, sans-serif;">Correo generado automáticamente, por favor no responder.</span><br><br>
            ------------------------------------------------------------------------------------------------'; //email message

            // Success sent message alert
            $mail->send();
            // echo
            // " 
            // <script> 
            //  document.location.href = 'recuperarContrasenia2.php';
            // </script>
            // ";

            //---------------------------------------------------------------------

        //--------------------------------------------------------------------------------------------------

    }

?>

<!DOCTYPE html>
<html lang="es" class="reseFactuCompraHTML">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Compra - Nueva Reserva</title>
    <link rel="stylesheet" href="estilos/factuCompraRese.css">
</head>
<body class="body">
    <main class="main">
        <div class="divSvg">
            <svg class="footer_logoBizSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 194.79 194.79"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M97.39,0a97.4,97.4,0,1,0,97.4,97.39A97.4,97.4,0,0,0,97.39,0Zm0,20L20,97.39A77.48,77.48,0,0,1,97.39,20Zm0,154.79a77.53,77.53,0,0,1-74-54.75L120,23.39a77.39,77.39,0,0,1-22.65,151.4Z"/><path d="M117,70.07a43.72,43.72,0,1,0,43.72,43.72A43.71,43.71,0,0,0,117,70.07Zm0,67.43a23.72,23.72,0,1,1,23.72-23.71A23.74,23.74,0,0,1,117,137.5Z"/></g></g></svg>
        </div>
        <div class="baseFactura">
            <span class="tituloRespuesta">Respuesta de la transacción</span>
            <div class="divDataRespuestaTransa">
                <div class="divDatoBasePri">
                    <div class="div1">
                        <span>Referencia</span>
                    </div>
                    <div class="div2">
                        <span><?php echo $codigoFacRese; ?></span>
                    </div>
                </div> 
                <div class="divDatoBase">
                    <div class="div1">
                        <span>Fecha</span>
                    </div>
                    <div class="div2">
                        <span><?php echo $fechaCrea." | ".$horaCrea; ?></span>
                    </div>
                </div>
                <div class="divDatoBase">
                    <div class="div1">
                        <span>Respuesta</span>
                    </div>
                    <div class="div2">
                        <span><?php echo $respuestaEpaycoTransa; ?></span>
                    </div>
                </div> 
                <div class="divDatoBase">
                    <div class="div1">
                        <span>Motivo</span>
                    </div>
                    <div class="div2">
                        <span><?php echo $motivoEpaycoTransa; ?></span>
                    </div>
                </div> 
                <div class="divDatoBaseUlti">
                    <div class="div1">
                        <span>TOTAL</span>
                    </div>
                    <div class="div2">
                        <span><?php echo $precioTotal; ?></span>
                    </div>
                </div> 
            </div>
        </div>
        <div class="spanInfoCorreo">
            <span>Se ha enviado un correo a <b><?php echo $resultadoUser["user_correo"]; ?></b>. Revisa tu bandeja para obtener tu código de acceso.</span>
        </div>
        <div class="btnDiv">
            <button class="btnVolver">Volver a <b>BizClub</b></button>
        </div>
    </main>
</body>
<script>

    history.replaceState(null,null,"index.php");
    document.querySelector(".btnVolver").addEventListener("click", ()=>{

        window.location.href = "index.php";

    });

</script>
</html>