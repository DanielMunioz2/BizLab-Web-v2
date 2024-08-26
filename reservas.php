<?php

    session_start();

    require("conexion.php");

    if(isset($_SESSION["iniciado"])){

        $idUser = $_SESSION["iniciado"];

        $resultadoUser = $conn->query(
            "SELECT * FROM `bizlabDB`.`usuarios`
            WHERE `usuarios`.`id_usuario` = $idUser;"
        ); 
        
        $resultadoUser = $resultadoUser->fetch_assoc();

    }else{

        header("location:inicioSesion.php");

    }

?>

<!DOCTYPE html>
<html lang="en" class="reservasAdminHTML" id="reservasAdminHTML">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas BizClub</title>
    <link rel="shortcut icon" type="x-icon" href="images/favicon_bizclub.svg">
    <link rel="stylesheet" href="estilos/reservas.css">

    <!-- Datos Usuario -->
    <input type="hidden" id="idUserIniciado" value="<?php echo $resultadoUser["id_usuario"]; ?>">
    <input type="hidden" id="nombreUserIniciado" value="<?php echo $resultadoUser["user_nombre"]." ".$resultadoUser["user_apellido"]; ?>">

</head>
<body class="body">
    <header class="header">
        <div class="header_div1">
            <div class="divPerfilContaint">
                <div class="divImgCont">
                    <div>
                        <img src="imagesUser\userDefaultProfileMan.webp" alt="Imágen de Perfil">
                    </div>
                </div>
                <div class="divNombreCont">
                    <span class="nombrePerfil"><?php echo $resultadoUser["user_nombre"]." ".$resultadoUser["user_apellido"]; ?></span>
                    <span class="carreraUPerfil"><?php echo $resultadoUser["user_cargo"]; ?></span>
                    <div class="divTipo">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 312.57 425.95"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M312.5,361.84a41.53,41.53,0,0,1-6.35,19.76,39.76,39.76,0,0,1-6.51,7.89,50.8,50.8,0,0,1-7.36,5.54c-2.73,1.72-5.46,3.44-8.29,5-3.08,1.69-6.18,3.36-9.37,4.86-4.13,1.95-8.33,3.73-12.58,5.38-5.46,2.11-11,3.92-16.67,5.5-6.64,1.86-13.36,3.38-20.14,4.64-4.1.76-8.21,1.45-12.34,2-2.8.36-5.6.76-8.4,1.08-2.36.28-4.74.47-7.1.69-1.83.17-3.65.37-5.48.51s-3.95.25-5.93.37l-9,.52-.75,0c-6.64,0-13.28.53-19.23.31-3.13,0-5.56,0-8,0-4.21,0-8.42-.25-12.64-.35-2.07-.05-4.16-.07-6.23-.28s-4.36-.16-6.53-.44c-1.81-.23-3.65-.25-5.48-.39-1.68-.13-3.36-.3-5-.47-1.24-.12-2.47-.24-3.7-.39-3.54-.42-7.09-.8-10.62-1.3q-7.51-1.06-15-2.56A225.53,225.53,0,0,1,61.44,414q-7.19-2.25-14.15-5A164.38,164.38,0,0,1,31,401.35a146.86,146.86,0,0,1-13.1-8A39.53,39.53,0,0,1,5.54,380.12,41.2,41.2,0,0,1,.75,367.05a26.61,26.61,0,0,1-.51-4.28,12,12,0,0,0-.14-1.33,14.79,14.79,0,0,1,0-3.12c.14-1.67.3-3.35.49-5,.32-2.76.62-5.52,1-8.27.64-4.62,1.51-9.19,2.5-13.75,1-4.75,2.27-9.45,3.65-14.11a164.4,164.4,0,0,1,6-16.67q1.52-3.63,3.2-7.2a161.83,161.83,0,0,1,9.27-17,150.11,150.11,0,0,1,9.06-12.9c2.29-2.93,4.73-5.74,7.15-8.56.23-.26.48-.5.72-.75,1.19-1.26,2.43-2.48,3.56-3.8a18.63,18.63,0,0,1,2.68-2.57,10.13,10.13,0,0,0,.77-.7,135.1,135.1,0,0,1,14.5-12.31A150.18,150.18,0,0,1,81.3,223.93a162,162,0,0,1,19.2-9.12,159.43,159.43,0,0,1,23.61-7.17c4.8-1.07,9.64-1.86,14.51-2.48,2.65-.34,5.32-.51,8-.73,5.2-.43,10.41-.25,15.61-.22,2.28,0,4.55.28,6.82.48,2,.17,4,.41,6.06.64,3.45.4,6.86,1,10.27,1.66a150.43,150.43,0,0,1,21.79,6q6.93,2.47,13.63,5.57a154.94,154.94,0,0,1,15.22,8.1,151.51,151.51,0,0,1,17,12c2.59,2.09,5.07,4.29,7.53,6.53,2,1.8,3.89,3.68,5.77,5.58a145.66,145.66,0,0,1,9.75,11A157.76,157.76,0,0,1,285.65,275c1.93,3,3.73,6.09,5.47,9.21,1.45,2.6,2.79,5.25,4.09,7.93a165.66,165.66,0,0,1,6.73,16,186,186,0,0,1,9.15,37.35c.37,2.76.77,5.5,1.06,8.26A45.75,45.75,0,0,1,312.5,361.84Z"/><path d="M245.23,89.17c-.5,24.3-9,45.34-26.24,62.54-17.44,17.36-38.67,25.91-63.23,26a85.9,85.9,0,0,1-42.57-11.13,87.89,87.89,0,0,1-34-33.52C71.33,119.36,67.46,104.6,67.48,87A85.17,85.17,0,0,1,77.87,47.11,88.81,88.81,0,0,1,219.27,26.2C236.45,43.69,244.87,64.76,245.23,89.17Z"/></g></g></svg>
                        <span><?php echo $resultadoUser["user_rol"]; ?></span>
                    </div>
                </div>
                <div class="divFlecha" id="divFlecha">
                    <svg class="flecha1 flechaIconPerfil" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 78.51 116.5"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M78.11,60.28a4.29,4.29,0,0,0,.19-.5,4.64,4.64,0,0,0,.11-.51,4.37,4.37,0,0,0,.09-.5c0-.18,0-.35,0-.52s0-.35,0-.52a4.37,4.37,0,0,0-.09-.5,4.82,4.82,0,0,0-.11-.52,4.14,4.14,0,0,0-.19-.49,3.9,3.9,0,0,0-.2-.47,5.29,5.29,0,0,0-.32-.5,2.36,2.36,0,0,0-.2-.31l-.07-.08c-.12-.14-.25-.27-.38-.4a4.75,4.75,0,0,0-.4-.38L76.46,54,8.7,1.14A5.39,5.39,0,0,0,2.07,9.63L64.39,58.25,2.07,106.86a5.39,5.39,0,1,0,6.63,8.5L76.46,62.49h0a6.31,6.31,0,0,0,.7-.67l.13-.15.09-.11c.08-.1.13-.21.2-.31a5.43,5.43,0,0,0,.32-.51A3.76,3.76,0,0,0,78.11,60.28Z"/></g></g></svg>
                </div>
                <div id="cuadroPOculto" class="cuadroOPerfil1 cuadroPOculto">
                    <div class="div1">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 312.57 425.95"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M312.5,361.84a41.53,41.53,0,0,1-6.35,19.76,39.76,39.76,0,0,1-6.51,7.89,50.8,50.8,0,0,1-7.36,5.54c-2.73,1.72-5.46,3.44-8.29,5-3.08,1.69-6.18,3.36-9.37,4.86-4.13,1.95-8.33,3.73-12.58,5.38-5.46,2.11-11,3.92-16.67,5.5-6.64,1.86-13.36,3.38-20.14,4.64-4.1.76-8.21,1.45-12.34,2-2.8.36-5.6.76-8.4,1.08-2.36.28-4.74.47-7.1.69-1.83.17-3.65.37-5.48.51s-3.95.25-5.93.37l-9,.52-.75,0c-6.64,0-13.28.53-19.23.31-3.13,0-5.56,0-8,0-4.21,0-8.42-.25-12.64-.35-2.07-.05-4.16-.07-6.23-.28s-4.36-.16-6.53-.44c-1.81-.23-3.65-.25-5.48-.39-1.68-.13-3.36-.3-5-.47-1.24-.12-2.47-.24-3.7-.39-3.54-.42-7.09-.8-10.62-1.3q-7.51-1.06-15-2.56A225.53,225.53,0,0,1,61.44,414q-7.19-2.25-14.15-5A164.38,164.38,0,0,1,31,401.35a146.86,146.86,0,0,1-13.1-8A39.53,39.53,0,0,1,5.54,380.12,41.2,41.2,0,0,1,.75,367.05a26.61,26.61,0,0,1-.51-4.28,12,12,0,0,0-.14-1.33,14.79,14.79,0,0,1,0-3.12c.14-1.67.3-3.35.49-5,.32-2.76.62-5.52,1-8.27.64-4.62,1.51-9.19,2.5-13.75,1-4.75,2.27-9.45,3.65-14.11a164.4,164.4,0,0,1,6-16.67q1.52-3.63,3.2-7.2a161.83,161.83,0,0,1,9.27-17,150.11,150.11,0,0,1,9.06-12.9c2.29-2.93,4.73-5.74,7.15-8.56.23-.26.48-.5.72-.75,1.19-1.26,2.43-2.48,3.56-3.8a18.63,18.63,0,0,1,2.68-2.57,10.13,10.13,0,0,0,.77-.7,135.1,135.1,0,0,1,14.5-12.31A150.18,150.18,0,0,1,81.3,223.93a162,162,0,0,1,19.2-9.12,159.43,159.43,0,0,1,23.61-7.17c4.8-1.07,9.64-1.86,14.51-2.48,2.65-.34,5.32-.51,8-.73,5.2-.43,10.41-.25,15.61-.22,2.28,0,4.55.28,6.82.48,2,.17,4,.41,6.06.64,3.45.4,6.86,1,10.27,1.66a150.43,150.43,0,0,1,21.79,6q6.93,2.47,13.63,5.57a154.94,154.94,0,0,1,15.22,8.1,151.51,151.51,0,0,1,17,12c2.59,2.09,5.07,4.29,7.53,6.53,2,1.8,3.89,3.68,5.77,5.58a145.66,145.66,0,0,1,9.75,11A157.76,157.76,0,0,1,285.65,275c1.93,3,3.73,6.09,5.47,9.21,1.45,2.6,2.79,5.25,4.09,7.93a165.66,165.66,0,0,1,6.73,16,186,186,0,0,1,9.15,37.35c.37,2.76.77,5.5,1.06,8.26A45.75,45.75,0,0,1,312.5,361.84Z"/><path d="M245.23,89.17c-.5,24.3-9,45.34-26.24,62.54-17.44,17.36-38.67,25.91-63.23,26a85.9,85.9,0,0,1-42.57-11.13,87.89,87.89,0,0,1-34-33.52C71.33,119.36,67.46,104.6,67.48,87A85.17,85.17,0,0,1,77.87,47.11,88.81,88.81,0,0,1,219.27,26.2C236.45,43.69,244.87,64.76,245.23,89.17Z"/></g></g></svg>
                            <span>Cuenta</span>
                        </div>
                        <a id="ajustesCuentaBtn"><button class="btnConfig">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 382.81 384.23"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M343.11,79.39c.09,4.4-1.93,8.08-4.25,11.53-4.64,6.9-9.35,13.77-14.31,20.45-2.5,3.35-2.87,6.58-1.16,10.22,4.34,9.19,8.12,18.6,11.67,28.11,1.36,3.63,4.06,5.44,7.79,6.18,9.45,1.89,18.86,3.94,28.3,5.88,6,1.24,9.62,4.41,10.4,10.92a150.81,150.81,0,0,1-.52,42.75c-.61,3.7-2.62,5.82-6.25,6.89-9.76,2.86-19.82,4.23-29.78,6-5.76,1-9.3,3.59-11.33,9.54-3.05,8.95-7.15,17.55-11.08,26.18-1.49,3.28-1.21,5.77.88,8.7,6.36,8.94,12.88,17.78,17.94,27.6,2.29,4.45,2,8.16-1,12a180.63,180.63,0,0,1-25.09,26.33c-6.29,5.45-13,5.86-20.25,1.63-8.35-4.88-16.05-10.71-23.8-16.45-2.91-2.15-5.27-2.56-8.54-.75a148.15,148.15,0,0,1-26.13,11.12c-5.42,1.76-8.5,5.11-9.42,11a240,240,0,0,1-4.92,23.93c-3.12,11.76-7.86,15.07-20,15.07-9.64,0-19.28-.08-28.9-1-8.43-.82-10.44-2.23-13-10.48-3.14-10-4.76-20.4-6.35-30.74-.58-3.76-1.93-5.88-5.7-7.07A157.29,157.29,0,0,1,119.82,323c-2.77-1.51-4.76-1.17-7.21.62-7.39,5.39-14.8,10.79-22.47,15.75-10,6.45-15.35,5.87-24.2-1.89A205.32,205.32,0,0,1,42.39,312.4c-3.29-4-3.46-7.85-1-12.35,5-9.09,11.13-17.38,17.27-25.66,2.81-3.78,3.37-6.86,1.21-11.26A217.44,217.44,0,0,1,48.08,234c-1-3.09-2.6-4.48-5.87-5-10.33-1.67-20.57-3.88-30.9-5.56-5.18-.85-8.18-3.79-9.11-8.58a134.89,134.89,0,0,1-.66-44.69c.67-4.72,3.74-7.14,8.1-8.43,9.11-2.72,18.51-4,27.83-5.6,6.34-1.09,9.78-4.08,11.9-10.23,3.08-8.94,7.1-17.58,11-26.2,1.38-3,1.11-5.11-.84-7.69C53.65,104.19,47.78,96.3,43,87.71c-5-8.9-4.87-11.91,2-19.59A308.71,308.71,0,0,1,71.77,42c3.58-3.15,6.94-3.33,10.87-1.15,6.41,3.56,12.86,7.3,18.14,12.28,9,8.48,17.45,11.14,28.58,3.26,5.79-4.1,13.44-5.61,20.32-8.09A6,6,0,0,0,154.07,43c1.72-10,3.51-20,5.77-29.87C161.94,4,165,1.84,174.3,1A191.44,191.44,0,0,1,210.13.74c6.33.59,9.54,3.88,11.41,9.4a101.64,101.64,0,0,1,4.65,23.94c.73,8.66,4.44,14.09,13.05,16.61a110.34,110.34,0,0,1,26.18,10.93c2.32,1.4,4,.59,5.87-.73,8-5.61,15.88-11.55,24.42-16.44,9.37-5.37,11.92-5.22,20,1.72a190.76,190.76,0,0,1,22.94,22.89C341.09,72,343.09,75.31,343.11,79.39ZM282.68,190.91c1.58-41.58-34.62-90.48-92-91.36-43.58-.67-92.74,39.68-91.11,94.73,1.34,45,39.75,89.34,91.66,89.4C242.74,283.74,282.62,243.28,282.68,190.91Z"/></g></g></svg>
                            Ajustes de la Cuenta
                        </button></a>
                    </div>
                    <div class="div3">
                        <button class="btnCerrar">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 538.14 531.53"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M178.42,265.55V6.61c0-7.63-.17-7.73-7.47-4.91Q117.37,22.42,63.78,43.13C46.27,49.9,28.84,56.88,11.26,63.47c-13.34,5-11,2.2-11.06,16.39Q.07,234.33.13,388.79c0,23.15.08,46.3-.13,69.46,0,4.37,1.48,6.51,5.53,8.05Q56,485.48,106.25,505c21.75,8.4,43.44,16.93,65.21,25.25,6.67,2.55,7.65,1.6,7.31-5.78-.17-3.66-.34-7.32-.34-11Q178.4,389.52,178.42,265.55Z"/><path d="M351.11,219.9h-58.5c-7.28,0-7.37.07-7.38,7.12q0,41.25,0,82.5c0,6.83.53,7.4,7.42,7.4q58.5,0,117,0c7.57,0,7.83.06,7.58,7.43-.34,10.32,1.14,20.63.09,30.94a15.77,15.77,0,0,0,.19,3.49c.62,4.79,1.24,5.13,5,2.26,6.34-4.86,12.57-9.88,18.84-14.84,31.32-24.82,62.59-49.71,94-74.38,3.83-3,3.58-4.54,0-7.34C518,251,500.79,237.37,483.55,223.75Q453,199.62,422.38,175.47c-1.09-.85-2.05-2.82-3.66-1.94-1.34.73-1.22,2.71-1.23,4.15-.13,11.81-.14,23.61-.19,35.42,0,6.6-.2,6.79-6.69,6.8Z"/><path d="M380.2,115.12c.38-22.14-.56-49.3.41-76.45.15-4.19-2.48-4.85-5.9-4.83-11.82.08-23.65.06-35.47.06h-122c-6.86,0-7,.15-7,7,0,6.66,0,13.33,0,20,0,6.1.33,6.39,6.6,6.39H337.33c8.83,0,8.85,0,8.85,8.8q0,61.49,0,123c0,7.87.13,8,8.2,8,6.5,0,13-.17,19.49.08,4.77.18,6.43-1.71,6.41-6.45C380.13,173.78,380.2,147,380.2,115.12Z"/><path d="M295.39,498.11h78c6.56,0,6.81-.23,6.82-6.7q0-50.73,0-101.47,0-26.7,0-53.42c0-6.36-.29-6.59-6.9-6.61H352.8c-6.27,0-6.6.27-6.61,6.38q0,42.48,0,85,0,18,0,36c0,6.5-.26,6.78-6.74,6.78q-60.49,0-121,0c-8,0-8.18.16-8.18,8,0,6.5,0,13,0,19.5.05,6,.6,6.54,6.63,6.55Q256.15,498.14,295.39,498.11Z"/></g></g></svg>
                            Cerrar Sesión
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <nav class="header_nav">
            <ul class="nav_ul">
                <li class="li liAdminis"><a href="administracion.php">Administración</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <div class="separador"></div>
        <div class="tituloPrincipalDiv">
            <span>Reservas BizClub</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 383.61 383.63"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M112.83,156.35q-23.55-.06-47.08,0c-6.92,0-11.69,4.72-11.73,11.74q-.15,23.53,0,47.08c0,7,4.88,11.55,11.86,11.6,7.85.06,15.7,0,23.54,0s15.45,0,23.17,0c7.13,0,12-4.36,12.07-11.38q.28-23.91,0-47.82C124.56,160.7,119.72,156.37,112.83,156.35Zm-13,48c-3.61,0-7.22,0-10.83,0s-7-.06-10.45,0c-1.61,0-2.15-.51-2.13-2.14q.11-10.63,0-21.28c0-1.65.57-2.13,2.15-2.12q10.83.09,21.65,0c1.47,0,1.95.52,1.94,2,0,7.22-.07,14.43,0,21.65C102.23,204.26,101.26,204.34,99.87,204.32Z"/><path d="M112.09,252.38q-22.78-.07-45.59,0C58.66,252.42,54,257.14,54,265q-.06,22.61,0,45.21c0,8.26,4.67,12.87,13,12.9,7.47,0,15,0,22.42,0s15,0,22.42,0c8.16,0,12.84-4.57,12.87-12.64q.11-22.8,0-45.59C124.67,257,120,252.41,112.09,252.38Zm-9.91,35.56c0,3.36-.07,6.72,0,10.08.06,1.86-.45,2.67-2.5,2.63-7-.1-13.95-.08-20.92,0-1.82,0-2.34-.68-2.33-2.41.07-7,.1-13.94,0-20.91,0-2.13.91-2.45,2.69-2.44,6.85.06,13.7.09,20.54,0,2,0,2.6.69,2.54,2.61C102.1,281,102.18,284.45,102.18,287.94Z" /><path d="M317.22,156.35c-7.84,0-15.69,0-23.54,0s-15.44,0-23.16,0c-7.29,0-12,4.48-12.09,11.74q-.19,23.53,0,47.08c.07,7.09,4.81,11.58,11.85,11.6q23.54.07,47.08,0c6.93,0,11.69-4.71,11.74-11.74q.15-23.53,0-47.08C329,161,324.23,156.4,317.22,156.35ZM306.65,202c0,1.75-.45,2.43-2.29,2.37-3.47-.12-7,0-10.44,0s-7-.1-10.45,0c-1.91.07-2.61-.47-2.58-2.48.12-6.84.11-13.69,0-20.53,0-1.9.46-2.6,2.48-2.57,7,.12,13.93.09,20.9,0,1.72,0,2.41.42,2.38,2.28C306.56,188,306.57,195,306.65,202Z"/><path d="M226.77,264.55c0-7.45-4.57-12.11-12.07-12.16q-23.16-.13-46.33,0c-7.48.05-12,4.75-12,12.21q0,23.16,0,46.33c0,7.26,4.53,12.1,11.7,12.16q23.53.18,47.08,0c7-.06,11.6-4.86,11.65-11.83,0-7.72,0-15.44,0-23.17S226.81,272.4,226.77,264.55Zm-25,36.1c-6.85-.1-13.69-.08-20.53,0-1.63,0-2.5-.25-2.48-2.2q.15-10.63,0-21.27c0-1.85.65-2.31,2.38-2.29,7,.07,13.94.09,20.91,0,1.87,0,2.32.67,2.27,2.39-.1,3.61,0,7.22,0,10.83,0,3.36-.1,6.72,0,10.07C204.43,300.17,203.69,300.68,201.78,300.65Z"/><path d="M383.46,62.54a33.25,33.25,0,0,0-1.81-12.12,42.57,42.57,0,0,0-39.9-27.63c-8.23-.06-16.46,0-24.69,0-4.18,0-4.5-.4-4.6-4.45,0-1.87,0-3.74,0-5.61-.23-6.91-2.91-10.54-9.37-12.7h-6.73c-5.49,1.22-8,5-8.93,10.23a51.23,51.23,0,0,0-.43,8.2c-.09,4-.38,4.37-4.22,4.38q-19.26.06-38.52,0c-4.07,0-4.33-.34-4.4-4.57,0-2.12,0-4.24,0-6.36-.13-7-2.69-10.25-9.33-11.88h-6c-6,1.54-9,5.38-9.31,11.71-.09,2.11,0,4.22,0,6.33-.06,4.53-.28,4.74-5,4.78-2.11,0-4.22,0-6.33,0-10.57,0-21.13-.06-31.69,0-3,0-4.35-1.05-4.19-4.12.12-2.35.09-4.72,0-7.08-.28-6.47-3.18-10.09-9.32-11.66h-6c-6.65,1.63-9.21,4.88-9.34,11.87q-.06,3.74,0,7.47c0,2.26-.81,3.49-3.26,3.48-13.58,0-27.16,0-40.74,0-2.21,0-3.12-1.07-3.14-3.21A58.15,58.15,0,0,0,96,12.13C95.2,6.39,93.24,1.48,86.8,0H80.06C73.74,2.1,71,5.9,70.8,12.73c0,2,0,4,0,6-.06,3.93-.26,4.16-4.32,4.17-7.72,0-15.45.36-23.15-.05C22.51,21.71,1,38.37,0,59.11V348.7c.84,2.49.5,5.18,1.37,7.67,4.61,13.18,19.05,27.22,37.15,27.2q153-.24,306.05.06c20,.06,39.1-19.42,39-39C383.33,250.62,383.49,156.58,383.46,62.54ZM360.67,339.82c0,13.13-7.74,20.86-20.88,20.86H43.19c-12.92,0-20.74-7.77-20.74-20.61q0-108.66-.1-217.31c0-3.6,1.13-4.12,4.33-4.11q82.47.13,164.94.07t165-.09c3.45,0,4.18.93,4.18,4.26Q360.6,231.35,360.67,339.82ZM356.89,96.14c-20.32-.16-40.64-.08-61-.08H191.59q-82.47,0-164.94.07c-3.36,0-4.4-.77-4.29-4.25.27-8.59.06-17.2.09-25.8,0-11.14,8-19.43,19.15-19.61,9.22-.15,18.45,0,27.68-.08,2.12,0,2.83.63,2.73,2.74-.14,3.24-.12,6.49,0,9.72.26,6.91,5.08,11.7,11.56,11.6s10.8-4.77,11-11.66q.14-4.86,0-9.72c0-1.81.4-2.69,2.49-2.68q22.44.12,44.88,0c2.12,0,2.46.93,2.41,2.71-.08,3.37-.07,6.74,0,10.1.14,6.49,4.72,11.17,10.94,11.25a11.12,11.12,0,0,0,11.5-10.81c.19-3.61.11-7.23,0-10.85,0-1.72.43-2.4,2.29-2.39q22.44.09,44.88,0c1.8,0,2.4.56,2.34,2.34-.1,3.37-.07,6.73,0,10.1.14,6.85,4.94,11.68,11.48,11.61,6.39-.06,10.89-4.77,11-11.58.05-3.36.08-6.73,0-10.09,0-1.79.6-2.38,2.38-2.37q22.44.08,44.88,0c2,0,2.58.77,2.53,2.63-.08,3.36-.1,6.73,0,10.1.23,6.62,4.73,11.22,10.93,11.33,6.39.11,11.21-4.45,11.59-11.17.19-3.48,0-7,.06-10.47,0-1.07-.28-2.41,1.51-2.36,10.95.3,22-1,32.84.65,8.89,1.35,15.06,9.13,15.15,18.17s-.12,18,.1,26.93C360.82,95.27,360.07,96.16,356.89,96.14Z"/><path d="M329.13,265.27c0-8.16-4.58-12.86-12.63-12.89q-22.8-.09-45.59,0c-7.87,0-12.48,4.69-12.51,12.61q-.09,22.8,0,45.59c0,7.88,4.71,12.51,12.6,12.53q22.8.09,45.59,0c7.82,0,12.48-4.77,12.53-12.62.05-7.47,0-14.95,0-22.42S329.16,272.87,329.13,265.27Zm-22.46,32.4c0,2.23-.55,3.05-2.91,3-6.72-.15-13.45-.14-20.17,0-2.22,0-2.72-.81-2.69-2.83.09-6.72.1-13.44,0-20.16,0-2.09.57-2.9,2.73-2.8,3.36.15,6.72,0,10.08,0s6.73.13,10.08-.05c2.38-.13,2.93.81,2.89,3Q306.48,287.78,306.67,297.67Z"/><path d="M209,166.85q-12,11.76-23.78,23.81c-1.54,1.57-2.46,1.94-4.07.09A85.78,85.78,0,0,0,174,183.6c-4.9-4.48-11.76-4.34-16.07.21a11.26,11.26,0,0,0,.32,15.82c5.47,5.64,11,11.21,16.68,16.65,5,4.85,11.37,4.85,16.31,0,11.27-11.12,22.43-22.36,33.61-33.57a11.49,11.49,0,0,0,3.43-8.6,19,19,0,0,0-.5-2.7C225.17,163,215.36,160.58,209,166.85Z"/></g></g></svg>
        </div>
        <div class="separador">
        </div>
        <div class="divGene">
            <div class="divListaGene">
                <div class="divHeaderGene">
                    <div class="div1">
                        <button title="Limpiar Filtros" id="limpiarFiltros" class="limpiarFiltros limpiarFiltros-D">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 406.97 409.05"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M94.74,332.7c-1-3.62-3-6.38-7.09-6.39-4.27,0-6.38,2.75-7.36,6.58a57.83,57.83,0,0,1-16.6,28.05c-5.34,5.09-5.22,8.68.17,13.81a57.8,57.8,0,0,1,16.26,27.37,12.59,12.59,0,0,0,4.35,6.93h6.39c1.42-1.56,3-3,3.58-5.17a61.75,61.75,0,0,1,18-30.38c4-3.67,3.8-7.78-.15-11.49A61.05,61.05,0,0,1,94.74,332.7Zm2,36.87a70.77,70.77,0,0,0-7.82,11c-1,1.83-1.9,1.33-2.78-.21a71.67,71.67,0,0,0-7.88-10.93c-.63-.73-1.3-1.46-.52-2.42a98.58,98.58,0,0,0,8.78-12.24,4,4,0,0,1,.81-.79c1.06,0,1.37.8,1.75,1.46a76.64,76.64,0,0,0,7.62,10.64A2.4,2.4,0,0,1,96.73,369.57Z"/><path d="M403,360.85a58.68,58.68,0,0,1-13.18-18.35,87.14,87.14,0,0,1-3.52-10.16c-1.05-3.48-3.13-6-7-6s-6,2.33-7.08,5.88c-.3,1-.66,2-1,3a57.39,57.39,0,0,1-15.07,25c-6.35,6.16-6.38,9.16,0,15.26a56.25,56.25,0,0,1,15.31,25.74c.86,3,2.05,5.74,4.45,7.83h6.39a12.19,12.19,0,0,0,4.25-6.57A58,58,0,0,1,403,374.69C408.29,369.59,408.31,366.07,403,360.85Zm-14.63,8.77a62.41,62.41,0,0,0-7.66,10.62c-1.05,1.86-1.95,2-3,.07a64.09,64.09,0,0,0-7.63-10.64c-.85-1-1.36-1.95-.36-3.16A79.23,79.23,0,0,0,378,354.87a13.6,13.6,0,0,0,.7-1.81,20.2,20.2,0,0,1,1.9,2.22,78,78,0,0,0,7.87,11C389.56,367.55,389.43,368.4,388.36,369.62Z"/><path d="M393.73,215.77c-.11-5.6-4.11-8.48-9.43-6.73-4.16,1.36-8.23,3-12.41,4.36-6.27,2-12.64,2.91-19.25,1.68-9.95-1.85-17.19-8.06-24.12-14.75-31.31-30.24-60.81-62.22-90.57-94-5.35-5.71-10.08-12.15-16.83-16.36-14.52-9.08-31.33-7.05-43.9,5.26-10.27,10-20.46,20.19-30.44,30.52-2.68,2.77-4.19,2.47-6.59-.12-4.53-4.88-9.36-9.46-14.07-14.16-1.69-1.69-3.32-3.47-5.14-5-3.13-2.68-7.2-2.72-9.77-.26-2.87,2.74-2.92,6.62-.06,10,.77.91,1.65,1.73,2.5,2.58,5.83,5.83,11.58,11.75,17.54,17.45,2,1.93,2.05,3.08,0,5q-12.15,11.82-24,24c-2.14,2.2-3.49,2.4-5.77.11Q59.51,123.25,17.4,81.24c-4.54-4.55-4.47-8,.13-12.64C22.76,63.29,28.05,58,33.33,52.78c5.63-5.59,8.69-5.57,14.41.14Q67.51,72.66,87.26,92.43c.85.85,1.67,1.73,2.56,2.52,3.22,2.83,7.41,2.94,10.06.31s2.9-6.76-.14-10c-4.27-4.57-8.78-8.91-13.2-13.33-10.26-10.26-20.43-20.6-30.8-30.74-9.32-9.12-21.29-9.06-30.56,0C18.8,47.41,12.57,53.78,6.26,60.07A20.44,20.44,0,0,0,.37,71.16C-1.16,79.58,2.2,86.11,8,91.89Q49.53,133.33,91,174.81c2.52,2.51,2.82,4,.09,6.63-10,9.72-19.85,19.67-29.69,29.59-15.54,15.68-15.51,36.4.12,52.06Q86.36,288,111.28,312.71a17.42,17.42,0,0,0,3.67,3c3,1.62,6,1.5,8.42-1s2.72-5.69.65-8.72a23.71,23.71,0,0,0-2.93-3.25c-7.82-7.81-15.58-15.67-23.52-23.34-2.33-2.25-2.55-3.69-.11-6.07q14-13.64,27.66-27.66c2.29-2.35,3.66-2.06,5.75.13,5.52,5.76,11.23,11.34,16.91,17,2.12,2.1,4.48,3.91,7.74,3.19,5.83-1.27,7.42-7.68,2.89-12.45-5.77-6.07-11.73-12-17.77-17.79-2.1-2-2.28-3.33-.08-5.46q10.91-10.54,21.44-21.45c2.34-2.43,3.82-2.28,6.11.06,9.86,10.08,19.89,20,29.86,30,4.82,4.81,9.2,5.69,12.4,2.52,3.38-3.35,2.66-7.47-2.24-12.38-10-10.09-20.08-20.2-30.23-30.18-2.22-2.18-2.29-3.65,0-5.85Q189.6,181.56,201,169.81c2.15-2.21,3.4-2,5.41.13,5.13,5.4,10.48,10.59,15.77,15.84,1.94,1.93,4.1,3.49,7.06,2.84,2.48-.54,4.47-1.86,5.26-4.39a7.59,7.59,0,0,0-2.16-8c-5.36-5.37-10.63-10.82-16.11-16.06-2.13-2-2.2-3.4,0-5.49,7.54-7.33,15-14.74,22.29-22.31,2.32-2.4,3.64-2,5.66.26,8.76,9.84,17.64,19.56,26.52,29.29,14.7,16.11,29.2,32.43,45.25,47.25C333,225,351.87,234.8,376,227c3.22-1,2.94,1.05,2.58,3.05a123.79,123.79,0,0,1-10,30.61,6.88,6.88,0,0,1-4.66,3.95,37,37,0,0,1-18.93.76c-13.68-3.15-25.15-10.54-35.74-19.48-3.78-3.2-8-3.31-10.68-.4-3,3.25-2.52,7.25,1.44,10.84a81.68,81.68,0,0,0,7.76,6.26c14.09,10,28.91,18.08,46.94,17.42,3.48-.13,2.63,1.24,1.39,3.17-7.36,11.44-15.88,22-24.46,32.49-3.6,4.43-7,4.54-11.63,2.95-11-3.79-20.36-10.27-28.85-18.09-4.89-4.51-9.66-9.16-14.66-13.54-3.26-2.85-7.57-2.58-10.05.21s-2.41,6.78.7,10c2.78,2.86,5.66,5.63,8.6,8.33,11.29,10.38,22.73,20.55,37.64,25.63,2.69.92,1.21,1.89,0,2.91-9.77,8.5-20.66,15.36-31.56,22.31-7,4.45-12.18,3.09-18.34-1.08-11.1-7.51-20.44-17-30.39-25.8-4-3.54-8-3.79-10.89-.64s-2.58,7.07,1.13,10.58c9.55,9.06,19.06,18.19,29.84,25.84.84.59,2.22.94,2.06,2.16s-1.56,1.24-2.53,1.57a102,102,0,0,1-24.5,5.22c-19.07,1.63-36.6-2.07-50.89-15.75-9-8.65-17.76-17.62-26.66-26.41a26.28,26.28,0,0,0-4.26-3.57c-2.87-1.8-5.69-1.23-8,1s-3.06,5.26-1.24,8.33a16.09,16.09,0,0,0,2.47,3.11q12.54,12.58,25.14,25.11c15.38,15.34,33.9,22.94,56,22.58,12.83.24,25.53-2.5,37.89-6.82a189.17,189.17,0,0,0,76.05-49c19-20,35.46-41.79,47-67C389,249.91,394.06,233.45,393.73,215.77ZM229.46,121.46c-.71.59-1.32,1.31-2,2L88.61,262.3c-4,4-4,4-8.21-.12C77,258.79,73.56,255.47,70.27,252c-4-4.19-6.48-9.06-6.36-14,0-7.73,3.22-12.88,7.8-17.45q42.51-42.46,85-85Q171.37,120.88,186,106.2c10.44-10.38,22.18-10.39,32.61-.07,3.59,3.56,7.1,7.2,10.75,10.71C231.09,118.47,231.36,119.86,229.46,121.46Z"/><path d="M143.22,77.46c.92,3.46,3.23,5.57,6.88,5.53s6-2.11,6.87-5.59A58.81,58.81,0,0,1,174.6,47.7a8.83,8.83,0,0,0,3.13-6.37,8.61,8.61,0,0,0-2.67-5.51c-2.31-2.38-4.72-4.69-6.82-7.25A58.21,58.21,0,0,1,157.31,6.63C156.3,2.93,154.48,0,150,0c-4.23,0-6.05,2.73-7.16,6.28-.72,2.28-1.35,4.59-2.19,6.83A58.06,58.06,0,0,1,125.84,35c-4.39,4.16-4.82,8.2-1,11.78A63.45,63.45,0,0,1,143.22,77.46Zm-2.07-38.09a64.8,64.8,0,0,0,7.38-10.32c.72-1.3,1.56-2.44,2.76-.37a77.86,77.86,0,0,0,8.36,11.57,11,11,0,0,1,.72,1.15c-.42.61-.83,1.26-1.29,1.87-2.57,3.37-5.33,6.6-7.34,10.35-1.27,2.35-2.17,2-3.5-.09-2.21-3.45-4.6-6.79-7.13-10C139.87,41.94,139.93,40.82,141.15,39.37Z"/></g></g></svg>
                        </button>
                        <div class="divEstadoFiltroGene">
                            <span class="spanFiltroEstado">Filtrar</span>
                            <div class="divInputGene">
                                <div class="divInputTipo">
                                    <span>Tipo</span>
                                    <select id="filTipoRese" class="selectTipo selectTipo-D">
                                        <option selected disabled>Sin Dato</option>
                                        <option>Hora</option>
                                        <option>Día</option>
                                        <option>Semana</option>
                                    </select>
                                </div>
                                <div class="divInputEstado">
                                    <span>Estado</span>
                                    <select id="filEstadoRese" class="selectEstado selectEstado-D">
                                        <option selected disabled>Sin Dato</option>
                                        <option>Pendiente</option>
                                        <option>En Proceso</option>
                                        <option>Terminada</option>
                                        <option>Cancelada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="divFechaFiltroGene">
                            <span class="spanFiltroFecha">Filtrar por Fecha</span>
                            <div class="divFiltrosFecha">
                                <div class="divFiltroMes">
                                    <span>Mes</span>
                                    <select id="filMesRese" class="selectMes selectMes-D">
                                        <option selected disabled>Mes</option>
                                        <option>Enero</option>
                                        <option>Febrero</option>
                                        <option>Marzo</option>
                                        <option>Abril</option>
                                        <option>Mayo</option>
                                        <option>Junio</option>
                                        <option>Julio</option>
                                        <option>Agosto</option>
                                        <option>Septiembre</option>
                                        <option>Octubre</option>
                                        <option>Noviembre</option>
                                        <option>Diciembre</option>
                                    </select>
                                </div>
                                <div class="divFiltroAño">
                                    <span>Año</span>
                                    <input id="filAnioRese" type="text" maxlength="4" class="inputFiltroAño inputFiltroAño-D">
                                </div>
                            </div>
                            <div class="divFiltroDiaEspe">
                                <div class="divDia">
                                    <span>Día</span>
                                    <input id="filDiaRese" type="text" maxlength="2" placeholder="" class="diaInput diaInput-D">
                                </div>
                                <button id="btnHoy_Reservas" class="btnHoy">
                                    Hoy
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="div2">
                        <div class="bEspecifica">
                            <span>Búsqueda Específica</span>
                            <input id="inBusquedaEspecifi" type="text" placeholder="Código de la Reserva o Nombre del Miembro" class="inputReseCodigo inputReseCodigo-D">
                        </div>
                    </div>
                </div>
                <div class="divDataGene"> 
                    <div class="divFlechasListaRese">
                        <div class="flechasDiv">
                            <button id="buttonAtrasC" class="buttonAtrasC buttonAtrasC-B" disabled><<</button>
                            <button id="buttonAtras" class="buttonAtras buttonAtras-B" disabled><</button>
                            <span class="spanPagina">0 - 0</span>
                            <button id="buttonAdelante" class="buttonAdelante buttonAdelante-D">></button>
                            <button id="buttonAdelanteC" class="buttonAdelanteC buttonAdelanteC-D">>></button>
                        </div>
                    </div>
                    <div id="baseSpinnerCargaRese" class="baseSpinnerCargaRese baseSpinnerCargaRese-A">
                    </div>
                    <div id="divReservasGene" class="divReservasGene divReservasGene-A">
                    </div>
                </div>
            </div>
            <div class="dataDivReservaGene">
                <div class="divDataReserva">
                    <div class="divReseVacia">
                        <span class="datosReseSpan">Datos de la Reserva</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 433.24 426.2"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M431.14,387c-.8-2.19-2-2.77-4.16-1.5q-21.36,12.42-42.8,24.7c-2.05,1.17-2.42,2.39-.95,4.36,6.12,8.19,14.35,12.37,24.44,11.5,13.41-1.15,21.71-9,25.57-21.72V392.54C432.54,390.7,431.81,388.88,431.14,387Z"/><path d="M285.66,340.49a83.38,83.38,0,0,1-11.09-2.57c-3.22-1-4.8-.06-6.35,2.81-8.68,16-22.41,24.33-40.52,24.4-54.54.21-109.07.12-163.61.06a45.07,45.07,0,0,1-44.9-45q-.09-100.41,0-200.82a33,33,0,0,1,.39-5.88C24,89.08,41.9,74.12,67,74.08q78.85-.14,157.7,0c7.15,0,14.32.81,21,3.78,13,5.75,21.76,15.27,25.76,29,.83,2.84,2.14,4,5.18,3a67.22,67.22,0,0,1,8.23-1.88c7-1.29,7-1.25,4.89-7.89A64.46,64.46,0,0,0,228.44,55c-30.44-.12-60.88,0-91.32,0-2.39,0-4.9.63-3.82-3.61,4-15.92,22.21-31.17,38.69-31.32,32.13-.28,64.26-.35,96.39,0,20.83.2,40.56,20,41.17,40.86.39,13.52.27,27.06.18,40.58,0,3.71,1.26,5.45,5,5.57a51,51,0,0,1,10,1.09c3.86.93,4.69-.55,4.66-4-.1-13.39,0-26.78-.11-40.17A58.79,58.79,0,0,0,328.14,53C321.62,21.13,295.9.2,263,.07q-42.48-.18-85,0a62.86,62.86,0,0,0-13,1.21c-27.13,5.83-44.19,22.39-51.13,49.16-1,3.76-2.57,4.53-6,4.5q-21.77-.22-43.54,0A64.22,64.22,0,0,0,0,119.54q0,50.1,0,100.19t0,100.2a57.86,57.86,0,0,0,.24,8c4.56,33,31.23,56.39,64.47,56.41q81.16,0,162.35,0a64.43,64.43,0,0,0,28.25-6c15.15-7.21,25.86-18.69,32.34-34.16C288.62,342,288.19,340.94,285.66,340.49Z"/><path d="M415.77,223.85c.6-58.14-46.53-110.63-111.39-110.28-61.06.33-110.1,49.15-109.71,111.66.37,59.35,47.25,109.92,111.75,109.65C368.36,334.61,416.4,283.9,415.77,223.85Zm-110,91.56c-50,.51-91.67-39-91.84-90.26-.18-56.84,45.78-92,90.43-92.24,51.73-.32,93.63,42.12,92.24,93.81C395.3,276.06,354.58,315.82,305.79,315.41Z"/><path d="M424.54,375.22c-.3-.61-.63-1.39-1.05-2.12q-16.56-28.69-33.1-57.42c-1.4-2.43-2.69-3.18-5.31-1.65q-21,12.25-42.05,24.27c-2.07,1.19-2.79,2.35-1.43,4.69q16.88,29,33.57,58.13c1.2,2.08,2.37,2.82,4.67,1.48,14.23-8.29,28.51-16.49,42.76-24.74C423.54,377.32,424.66,376.82,424.54,375.22Z"/><path d="M60.07,135.76q27.85,0,55.72,0c17.45,0,34.9.05,52.34,0,9.87,0,9.05,1.36,9.07-9,0-5.76-.08-5.84-6-5.84q-53.82,0-107.65,0c-10.05,0-9.29-1.25-9.29,9.26C54.3,135.66,54.43,135.76,60.07,135.76Z"/><path d="M59.61,318.45c18.71-.16,37.43-.07,56.15-.07,17.45,0,34.9,0,52.35,0,9.88,0,9.07,1.25,9.09-9,0-5.79-.07-5.85-5.92-5.86q-53.84,0-107.66,0c-10.11,0-9.16-1.49-9.39,9.64C54.14,317.24,55.59,318.49,59.61,318.45Z"/><path d="M59.12,196.7c14.23-.16,28.46-.06,42.7-.06,12.82,0,25.64.05,38.46,0,9.75-.05,9,1.37,9-9.1,0-5.58-.14-5.73-5.65-5.73-26.5,0-53,0-79.48,0-10.79,0-9.71-1.62-9.91,10C54.18,195.43,55.4,196.75,59.12,196.7Z"/><path d="M59.5,257.59c14-.21,27.9-.08,41.85-.08,13,0,25.93.05,38.9,0,9.78,0,9,1.33,9-9.07,0-5.7-.08-5.77-6-5.77q-39.73,0-79.48,0c-10.29,0-9.31-1.44-9.54,9.52C54.15,256.13,55.34,257.65,59.5,257.59Z"/><path d="M355.85,192.47c-2.43-3.65-4.36-3.48-7.62-.72-19,16.12-38.25,32-57.34,48-2.34,2-3.77,2.4-6.08-.29-7.35-8.53-15.12-16.71-22.53-25.2-2.33-2.68-4-2.82-6.43-.28a96.59,96.59,0,0,1-8.15,7.37c-2.22,1.84-2.33,3.32-.31,5.52q18,19.65,35.72,39.49c1.75,2,3.14,2.3,5.27.47,5.54-4.78,11.25-9.37,16.89-14.06q28.11-23.37,56.2-46.76c1-.87,2.37-1.61,2.41-3.44a28.06,28.06,0,0,0-1.57-2.33C360.16,197.66,357.71,195.26,355.85,192.47Z"/></g></g></svg>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer_contenido">
            <div class="footer_redesSocialesContent">
                
            </div>
            <svg class="footer_logoBizSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 76.43 39.84"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M72.55,19.72c-.51-.49-.49-.79-.1-1.27a9.71,9.71,0,0,0,1.65-3A11.54,11.54,0,0,0,63.13,0Q41.55,0,19.94,0a19.89,19.89,0,0,0-.68,39.76c7.53.15,15.07,0,22.61,0v0H64.24a12.61,12.61,0,0,0,3.91-.44C76.92,36.52,79.26,26.12,72.55,19.72ZM65.42,33.37a13.3,13.3,0,0,1-1.55.08H20.32A13.18,13.18,0,0,1,8.84,27.68,12.85,12.85,0,0,1,7.69,14.15C10,9.38,13.91,6.54,19.22,6.49c14.72-.15,29.44-.07,44.16,0a5.05,5.05,0,0,1,5,5.09,5.13,5.13,0,0,1-4.91,5.18c-.4,0-.8,0-1.2,0l-38.53,0A3.21,3.21,0,0,0,20.39,20a3.26,3.26,0,0,0,3.42,3.23q20.52,0,41-.06a5.11,5.11,0,0,1,.57,10.2Z"/></g></g></svg>
            <div class="footer_copyrightContent">
                Copyright​ © 2024 BizLab SAS 
            </div>
        </div>
    </footer>
    <script src="scripts\app4.js"></script>
</body>
</html>