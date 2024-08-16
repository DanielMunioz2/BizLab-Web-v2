<?php

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    session_start();

    require("conexion.php");

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

if(isset($_SESSION["iniciado"])){

    //---------------------------------------------------------------------------------------------------------------------------
    // Obteniendo datos del USUARIO INICIADO

        $resultadoUser = $conn->query(
            "SELECT * FROM `bizlab`.`usuarios` 
            WHERE `usuarios`.`id_usuario` = ".$_SESSION["iniciado"].";");
        
        $resultadoUser = $resultadoUser->fetch_assoc();

    //---------------------------------------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------------------------------------
    // Obteniendo datos de las MEMBRESÍAS

        $resultadoMembre = $conn->query("SELECT * FROM `bizlab`.`membresias`;");
        $membreNumRows = $resultadoMembre->num_rows;

        $arrayMembreGene = [];
        $membreHtml = "";

        if($membreNumRows > 0){

            while($row = $resultadoMembre->fetch_assoc()){

                $arrayMembreGene[strval($row["id_membresia"])] = [
                    $row["id_membresia"], 
                    $row["membre_codigoEpayco"], 
                    $row["membre_nombre"], 
                    $row["membre_mensualidad"], 
                    $row["membre_descuento"], 
                    $row["membre_iva"],
                    $row["membre_numMiembros"], 
                    $row["membre_ingreTotal"], 
                    $row["membre_descripCor"], 
                    $row["membre_descrip"], 
                    $row["membre_fechaCrea"], 
                    $row["membre_horaCrea"], 
                    $row["membre_beneficios"],
                    $row["membre_diasDisponibilidad"],
                    $row["membre_imgPrin"],
                    $row["membre_imgSecun"]];
                
            }

        }
        
    //---------------------------------------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------------------------------------
    // Dias disponibles

        $diasDispo = $arrayMembreGene[strval($resultadoUser["user_membresia"])][13];

    //------------------------------------------------------------------------------------

}else{
    
    header("location: inicioSesion.php");

}

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

?>

<!DOCTYPE html>
<html lang="es" class="realizarReseCLI-HTML" id="realizarReseCLI-HTML">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nueva Reserva BizClub</title>
        <link rel="stylesheet" href="estilos\productosClientes.scss">
        <script type="text/javascript" src="https://checkout.epayco.co/checkout.js"></script>

        <!-- Datos del usuario iniciado -->
        <input type = "text" id="documentoUserOcul" value = "<?php echo $resultadoUser["user_documento"]; ?>">
        <input type = "text" id="celularUserOcul" value = "<?php echo $resultadoUser["user_celular"]; ?>">
        <input type = "text" id="direccUserOcul" value = "<?php echo $resultadoUser["user_direc"]; ?>">
        <input type = "text" id="emailUserOcul" value = "<?php echo $resultadoUser["user_correo"]; ?>">
        <!-------------------------------------------------------------------------------------------------------->

        <!-- Datos de la reserva -->

            <input type = "text" value = "<?php echo $diasDispo; ?>" id="diasDisponiblesMembre">
            <input type = "text" id="idPdtSelectedInput" value = "">
            <input type = "text" id="miembroInId" value = "">
            <input type = "text" id="miembroInNombre" value="<?php echo $resultadoUser["user_nombre"]." ".$resultadoUser["user_apellido"]; ?>">
            
            <!-- Tipo y precio -->
            <input type="text" id="tipoReservaIn" value = "">
            <input type="text" id="precioIndividualIn" value = "">

            <!-- Reserva por Hora -->
            <input type="text" id="diaInicioInputXH" value = "">
            <input type="text" id="horaEntradaXH" value="">
            <input type="text" id="horaSalidaXH" value="">
            <input type="text" id="cantHorasInputXH" value = "">
            <input type="text" id="cantMinuInputXH" value = "">

            <!-- Reserva por Día -->
            <input type="text" id="diaInicioInputXD" value = "">
            <input type="text" id="diaFinalInputXD" value = "">
            <input type="text" id="cadenaDiasInputXD" value = "">
            <input type="text" id="cantDiasInputXD" value = "">

            <!-- Reserva por Semana -->
            <input type="text" id="diaInicioInputXS" value = "">
            <input type="text" id="diaFinalInputXS" value = "">
            <input type="text" id="diasSemanaInputXS" value = "">

            <!-- Unidad -->
            <input type = "text" id="unidadInId" value = "">

            <!-- Número de Personas -->
            <input typr = "text" id="numeroPersoIn" value = "">
            
            <!-- Título y Actividad -->
            <input type="text" id="tituloReserOcul" value="">
            <input type="text" id="actividadesReserOcul" value="">

        <!--------------------------------------------------------------------------------------->

    </head>
    <body class="body">
        <header class="header"> 
            <div class="headerDiv1">
                <div class="divLogo">   
                </div>
                <div class="divPerfilGene">   
                    <div class="divPerfil">
                        <div class="divImg">
                            <img src="imagesUser/<?php echo $resultadoUser["user_imagen"]; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <nav class="headerNav">
                <ul class="ulNav">
                </ul>
            </nav>   
        </header>
        <main class="main">
            <div class="realiceReseDiv">
                <div></div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 383.69 361.2"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M382.22,64.71C374.73,25.83,342.49,0,302.77,0H81.24A95.91,95.91,0,0,0,70.81.56C47.58,3.12,29.07,13.89,15,32.4,6.74,43.27,2.27,55.72,0,69.06V90c.18.72.4,1.43.54,2.16q8.19,42.66,47.85,60.36c11,4.92,22.77,6.2,34.68,6.26,16.09.08,32.18.11,48.27-.05,3.64,0,4.68,1.19,4.65,4.75-.15,17.71-.06,35.42-.08,53.13,0,1.07.36,2.23-.67,3.59l-3.18-2.34c-17.53-12.79-43.11-7.42-53.13,11.29-6.53,12.19-5.33,29.33,10,41.68,14.87,11.95,29.27,24.48,44,36.65a7.81,7.81,0,0,1,3,6.75c-.13,11.35-.08,22.7,0,34.05,0,8.18,4.57,12.86,12.69,12.87q66,.06,132.09,0c8.33,0,13-4.75,13-13q0-62.68,0-125.36a33.27,33.27,0,0,0-26.14-32.68c-10.83-2.35-21.93-3-32.91-4.46-8.88-1.19-17.79-2.19-26.69-3.19-3-.33-4.38-1.46-4.15-4.76.32-4.47.08-9,.08-13.47,0-5.38,0-5.4,5.34-5.4,30.06,0,60.12.05,90.18,0a120.12,120.12,0,0,0,17.14-1.09C358.63,151.45,391.11,110.82,382.22,64.71ZM266.59,337.64c-17.32-.1-34.64-.05-52-.05-16.95,0-33.89-.09-50.84.08-3.65,0-5.22-.8-4.92-4.75a123.84,123.84,0,0,0,0-13.07c-.08-2.47.63-3.61,3.34-3.6q52.53.09,105,0c2.69,0,3.46,1.08,3.4,3.58-.13,4.6-.2,9.22,0,13.82C270.87,336.83,269.6,337.66,266.59,337.64Zm-6.51-125.27q10.47,1.33,10.55,13.51c.09,14.22,0,28.44,0,42.66,0,6.74-.1,13.47,0,20.21.06,2.81-.71,4-3.77,4q-56.31-.12-112.63,0a7,7,0,0,1-4.77-1.75C133.7,277.64,117.77,264.41,102,251c-5.42-4.6-4.14-12.54,2.45-15.26,5.09-2.1,10.22-2,14.76,1.81,6.67,5.63,13.31,11.3,20.06,16.83,7,5.75,16.56,3.29,19.2-4.79a16.22,16.22,0,0,0,.47-5.18q0-34.8,0-69.6V104.46c0-4.93,1.45-9.11,6.1-11.56a10.62,10.62,0,0,1,15.13,6.81,28.73,28.73,0,0,1,.67,7.05q0,41.53,0,83.07c0,9.55,3.43,13.13,12.93,14.27Q226.94,208.11,260.08,212.37Zm50.36-77.51a174.35,174.35,0,0,1-17.54.54q-41.91.07-83.81,0c-5.22,0-5.23,0-5.23-5.38,0-9.48,0-19,0-28.43-.08-17.57-14-32.06-32-33.43C155,66.9,138.11,80,136.33,96.89c-1.11,10.49-.33,21.18-.4,31.77-.05,7.66.71,6.73-6.86,6.75-16.59,0-33.17.07-49.76,0A56.44,56.44,0,0,1,26.05,97.72C14.63,65,35.86,29.53,70,24.24a60.57,60.57,0,0,1,9.3-.63H191.91c37.16,0,74.33.31,111.49-.1,26.07-.3,51.22,18,56.08,46.42A55.78,55.78,0,0,1,310.44,134.86Z"/><path d="M307.17,45.6c-5-1.62-9,.23-12.51,3.7-11,11-22.1,22-33,33.11-2.1,2.12-3.42,2.09-5.41,0-3.75-4-7.6-7.93-11.68-11.59-3.69-3.32-8.06-4.45-12.81-2.23-4.5,2.11-6.79,5.69-6.76,11.59-.21,2.92,1.64,5.78,4.2,8.34Q239,98.24,248.76,108c7.11,7.09,13.22,7.13,20.31.06q20.65-20.61,41.26-41.28a23,23,0,0,0,3.15-3.68A11.57,11.57,0,0,0,307.17,45.6Z"/></g></g></svg>
                <span>Realice una nueva Reserva</span>
            </div>
            <div class="separador"></div>
            <div class="divGeneReserva">
                <div class="div1 div1-A">
                    <span class="spanQueReserva">¿Qué quiere reservar?</span>
                    <div class="divInputGene">
                        <div class="divInput">
                            <input 
                                type="text" 
                                id="inputSelecPdt"
                                class="inputReserva inputReser-A"
                                value=""
                                placeholder="Nombre del Producto"
                            >
                            <div class="producReserLista prodRLista-C">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div2 div2-C">
                    <div class="productoContGene prodContGene-A">
                    </div>
                </div>
                <div class="div3 div3-A">
                    <div class="divDatosReseGene divDaReGene-A">
                        <div class="cubierta cubierta-A"></div>     
                        <span class="datosReseSpan">Datos de la Reserva</span>
                        <div class="divTipoReserva">
                            <span class="tipoReseSpan">Tipo de Reserva</span>
                            <div class="btnDiv btnDiv-A">
                                <button class="btnTR btnBloq btr" disabled>Por Hora</button>
                                <button class="btnTR btnBloq btr" disabled>Por Día</button>
                                <button class="btnTR btnBloq btr" disabled>Por Semana</button>
                            </div>
                        </div>
                        <div class="divDuracionGene divDurGene-A">
                        </div>
                        <div class="divMiembroGene divMiemGene-A">
                            <div class="divMiembroInput divMiemIn-A">
                                <span class="miembroSpan">Miembro</span>
                                <div class="divMiembroInput2">
                                    <input 
                                        class = "inputMiembro inputMiembro-A-Bloq" 
                                        id = "inputMiembro"
                                        placeholder = "Escriba su nombre o apellido"
                                        disabled
                                    >
                                    <div class="miembroSelectDiv miemSeleDiv-C">
                                    </div>
                                    <div class = "miembroLis miembroLis-C">
                                    </div>
                                </div>
                            </div>
                            <div class="divNumPerso divNumPerso-A">
                                <span class="numPerso">Número de Personas</span>
                                <div class="divNumPerso">
                                    <input 
                                        class = "inputNumPerso inputNumPerso-A"
                                        id = "inputNumPerso"
                                        type = "number"
                                        min = "0"
                                        value = "0"
                                        disabled
                                    >
                                    <span class="limitePersoSpan"></span>
                                </div>
                            </div>
                        </div>
                        <div class="divTituloActiGene divTituActiGene-A">
                            <div class="tituloDiv">
                                <span>Título</span>
                                <input 
                                    disabled 
                                    class="inputTitulo inputTitulo-A" 
                                    id = "inputTitulo";
                                    maxlength="50" 
                                    placeholder="Ejemplo: Reunión de Equipo"
                                >
                            </div>
                            <div class="actividadDiv">
                                <span>Actividades</span>
                                <textarea 
                                    disabled rows="10" cols="50" 
                                    name="actividadRese" 
                                    placeholder="Descripción de sus labores en la reserva"
                                    id = "actividadRese"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="divCalendaGene">
                        <div class="cubiertaCalen cubiertaCalen-A"></div>
                        <div class="divCalendaPrin divCalePrin-A">
                            <div class="divSpanInstru">
                                <span>Introduzca la fecha de la reserva en el panel de la izquierda, o elija un día en el calendario para empezar</span>
                            </div>
                            <div class="calendario">
                                <div class="calendaHeader">
                                    <div class="divBtns">
                                        <button id="atrasBTN" title="Mes Anterior" class="btnMoverMes btnMoverMesAtras"><</button>
                                        <button id="adelanteBTN" title="Mes Siguiente" class="btnMoverMes btnMoverMesDelante">></button>
                                    </div>
                                    <span class="spanFecha">Fecha - Mes Año</span>
                                    <div class="divBtnHoy">
                                        <button class="btnHoy btnHoy-A">Hoy</button>
                                    </div>
                                    <span class="spanPdtHeaderCalen"></span>
                                </div>
                                <div class="cabeceraDiasCalenda">
                                    <span>Domingo</span>
                                    <span>Lunes</span>
                                    <span>Martes</span>
                                    <span>Miercoles</span>
                                    <span>Jueves</span>
                                    <span>Viernes</span>
                                    <span class="spanSabadoCabeza">Sábado</span>
                                </div>
                                <div class="diasDivGene diasDivGene-A">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="divDisponibiDia divDispoDia-A">
                            <div class="divSpan-fecha">
                                <span class="diaSpanPrin diaSpanPrin-D"></span>
                                <span class="spanInstru spanInstru-D"></span>
                            </div>
                            <div class="dataDiv">
                                <div class="divLineaTiempo">
                                    <div class="barraLT" id="barraLT"
                                        style="
                                            height: 100%;
                                            position: absolute;
                                            width: .2rem;
                                            background-color: #2e0896;
                                            z-index: 800;
                                        "
                                    ></div>
                                    <div class="divDispoReserBase"></div>
                                    <div class="divHora">
                                        <span>7 AM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>8 AM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>9 AM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>10 AM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>11 AM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>12 PM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>1 PM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>2 PM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>3 PM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>4 PM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>5 PM</span>
                                    </div>
                                    <div class="divHora">
                                        <span>6 PM</span>
                                    </div>
                                </div>
                                <!-- Próximamente -->
                                <!-- <span class="horaDispoSpan">Horarios disponibles en este momento</span>
                                <div class="divHorariosDispo">
                                    <div class="divHorarios">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div4 div4-A">
                    <div class="cubiertaBtn cubiertaBtn-A"></div>
                    <div id="separador"></div>
                    <div class="contPrecios">
                        <div class="cabecera">
                            <span class="precioTituloSpan">Precio</span>
                            <span>Cantidad</span>
                            <span>Subtotal</span>
                        </div>
                        <div>
                            <span class="spanPrecio">0</span>
                            <span class="spanCantidad">0</span>
                            <span class="spanSubtotal">0</span>
                        </div>
                        <div>
                            <span>+ Iva</span>
                            <span class="spanPrecioIva">0</span>
                        </div>
                        <div>
                            <span>- Descuento</span>
                            <span class="spanPrecioDescu">0</span>
                        </div>
                        <div class="divTotal">
                            <span>TOTAL</span>
                            <span class="spanTotalPrecio">0</span>
                        </div>
                    </div>
                    <div id="separador"></div>
                    <div class="btnDivGene">
                        <button class="btnCancelar btnCancelar-A">Cancelar</button>
                        <div class="spanInstru">
                            <span class="spanInstruBtn">Debe llenar todos los campos para continuar</span>
                        </div>
                        <button id="btnContinuar" class="btnContinuar btnContinuar-C" disabled>Continuar</button>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="footer_contenido">
                <div class="footer_redesSocialesContent">
                    
                </div>
                <svg class="footer_logoBizSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 194.79 194.79"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M97.39,0a97.4,97.4,0,1,0,97.4,97.39A97.4,97.4,0,0,0,97.39,0Zm0,20L20,97.39A77.48,77.48,0,0,1,97.39,20Zm0,154.79a77.53,77.53,0,0,1-74-54.75L120,23.39a77.39,77.39,0,0,1-22.65,151.4Z"/><path d="M117,70.07a43.72,43.72,0,1,0,43.72,43.72A43.71,43.71,0,0,0,117,70.07Zm0,67.43a23.72,23.72,0,1,1,23.72-23.71A23.74,23.74,0,0,1,117,137.5Z"/></g></g></svg>
                <div class="footer_copyrightContent">
                    Copyright​ © 2024 BizLab SAS 
                </div>
            </div>
        </footer>
        <script src="scripts\app3.js"></script>
    </body>
</html>