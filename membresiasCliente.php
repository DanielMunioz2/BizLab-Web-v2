<?php

    require("conexion.php");

    session_start();

    // Datos USUARIO INICIADO 
    $resultUsuario = $conn->query(
        "SELECT * FROM `bizlab`.`usuarios` 
        WHERE `usuarios`.`id_usuario` = ".$_SESSION["iniciado"].";");
    $resultUsuario = $resultUsuario->fetch_assoc();
    //-----------------------------------------------------------------------------

    //

    // Buscando las membresías en la base de datos
    $resultMembresias = $conn->query("SELECT * FROM `bizlab`.`membresias`;");
    $MembreNumRows = $resultMembresias->num_rows;

    $arrayMembresiasGene = [];
    $membresiasHtml = "";

    if($MembreNumRows > 0){

        while($row = $resultMembresias->fetch_assoc()){

            $arrayMembresiasGene[strval($row["id_membresia"])] = [
                $row["id_membresia"], 
                $row["membre_nombre"], 
                $row["membre_mensualidad"], 
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

            $membresiasHtml .= '
            <div class="divContentMembre">
                <div class="divImgGene">
                    <img src="images/productosImages/'.$row["membre_imgPrin"].'" alt="">
                </div>
                <div class="datosDivGeneral">
                    <div class="divDatosGene2">
                        <div class="divNombreMembre">
                            <div class="divSvg">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 313.95 277.09"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M146.71,144a2.29,2.29,0,0,1-2.49-1.69c-1-2.94-2-5.87-3.05-8.79a2.69,2.69,0,0,1,.58-3c11.88-13,16.18-28.63,15-45.84-.61-9,.8-17.19,5.9-24.73a23.72,23.72,0,0,0,2.66-6.53,20.23,20.23,0,0,0,.79-9.57A34.33,34.33,0,0,0,153.94,23c-3.08-2.56-6.08-5-7.39-9.1-2.22-7-7.42-10.69-14.34-12.14-23.05-4.83-44.07.4-62.85,14C56.28,25.19,49.47,38,51.9,54.82c1.66,11.55,3.1,23.09,2.78,34.87a56.81,56.81,0,0,0,14.69,40.4c1.49,1.69-1.73,13.14-3.9,13.8a12.65,12.65,0,0,1-2.24.11,60,60,0,0,0-17.71,4.1c-21.57,9.28-34,25.91-39,48.53C1.16,220.74.41,245.26,0,269.81c-.1,5.84,1.42,7.28,7.22,7.28H204.36c4.61,0,6.42-1.38,6.43-5.29,0-25-1.06-49.81-6.1-74.35C197.47,162.33,171.12,145.06,146.71,144Zm-5.09,10.92c3.15-2.18,6.39-.35,10.35-.47-8.72,9.48-17,18.42-25.16,27.4a1.77,1.77,0,0,1-2.82.28c-3.41-2.47-6.88-4.85-10.8-7.6ZM107.55,166.5c-2.25,1.64-3.69,1.4-5.78-.18-7.65-5.77-15.35-11.48-23.24-16.92-2.48-1.71-3-3.27-1.68-5.78a16.83,16.83,0,0,0,1.34-3.47c.43-1.7,1.17-1.45,2.37-.74,17.27,10.2,34.44,9.72,51.5-.54.1-.06.25,0,.37,0s.21.14.25.23c3.07,7.7,3.07,7.69-3.73,12.42C121.8,156.48,114.58,161.35,107.55,166.5Zm4.23,19.76c-.06,2.93-4.18,7-7.27,7-1.07-.32-2.77.75-3.6-.66a47.94,47.94,0,0,1-3.11-6.7c-.26-.64,6-5.26,6.86-5.21S111.78,185.65,111.78,186.26ZM72.57,25.35C83.49,16.22,96.3,11.49,110.35,9.9a58,58,0,0,1,20,1.28c3.69.86,6.19,2.84,7.35,6.6A21.56,21.56,0,0,0,146,29a26.27,26.27,0,0,1,7.75,9,20.09,20.09,0,0,1-2.53,22.73c-1.14,1.34-1.86.49-2.33-.2-5.06-7.4-10.84-5.59-18-2.83-18.89,7.25-37.79,6.44-56-3C71.67,53,69.23,53.33,67,56c-1.18,1.43-2.26,2.94-3.68,4.8C58.44,48.48,62.44,33.81,72.57,25.35Zm-8,61.09c0-5.14.1-8.64,0-12.12-.08-1.92.72-3.1,2-4.49,3.73-4.15,7.18-4.62,12.72-2.43,18.88,7.45,38,6.32,56.82-.81,2.35-.89,3.73-.6,5.85.82,4.34,2.91,5.55,6.5,5.31,11.55-.43,8.93.54,18-2.37,26.66-5.45,16.27-15.68,27.83-33.2,30.7-16.92,2.76-32.07-5.51-40.75-20.89A52.58,52.58,0,0,1,64.57,86.44Zm6.8,69.71c7.86,6.31,16.21,12,24.7,18.2-3.95,2.8-7.42,5.21-10.83,7.69-1.09.8-1.83.87-2.82-.22-8-8.84-16.16-17.63-24.92-27.16C62.72,154.49,66.89,152.56,71.37,156.15Zm20.11,55.28c-2,17.56-4.36,35.1-6.4,52.66-.29,2.52-1,3.34-3.61,3.3q-15.52-.21-31,0c-2.69,0-3.3-.82-3.28-3.37.11-15.09,0-30.18,0-45.27A27.32,27.32,0,0,0,47,215a4.35,4.35,0,0,0-4.23-4,4.42,4.42,0,0,0-5.14,3.34,15.29,15.29,0,0,0-.38,4.06c0,15.22-.08,30.43,0,45.64,0,2.56-.57,3.41-3.25,3.34-7.11-.19-14.22-.11-21.32,0-1.77,0-2.7-.19-2.67-2.36.37-23.33,1.34-46.6,6.92-69.4,3.93-16.08,13-28.3,27.72-36.2,2-1.07,3.1-.93,4.64.77,8.86,9.8,17.85,19.49,26.81,29.2C82,195.65,82,195.64,89,191.63,94.71,197.8,92.26,204.76,91.48,211.43Zm20.93,55.94c-2.61-.13-5.23,0-8.42,0-2.63-.27-6.79,1.37-8.8-.59s.09-5.88.45-8.92c2-17.29,4.29-34.57,6.42-51.85.21-1.68.14-3,2.6-3,2.63,0,2.36,1.78,2.54,3.2,1.64,13,3.2,25.93,4.77,38.9.81,6.67,1.51,13.35,2.45,20C114.69,267,114.26,267.46,112.41,267.37Zm86,0c-7.23-.13-14.47-.15-21.69,0-2.47.06-3.2-.64-3.16-3.11.15-7.85.06-15.71.06-23.57,0-7.6,0-15.21,0-22.81,0-4.73-1.57-6.92-4.86-6.94s-5,2.27-5,7.2c0,15.09-.14,30.18.09,45.27.06,3.46-1,4-4.15,4-10.59-.2-21.19-.17-31.79,0-2.53,0-3.43-.74-3.71-3.18-2-16.94-4.1-33.88-6.17-50.81a74.74,74.74,0,0,0-1.14-8.89c-1-4.24.22-7.76,2.34-11.29.91-1.52,1.51-1.44,2.85-.61,4.66,2.89,5.69,2.7,9.51-1.45,9.55-10.37,19.15-20.68,28.54-31.18,1.91-2.14,3.35-2.21,5.67-1,16.37,8.62,25.53,22.44,29.27,40.23,4.54,21.57,5.6,43.46,6,65.4C201.08,266.72,200.54,267.42,198.38,267.38Z" /><path d="M284.16,87.54c-3-21.69-22.43-37.75-44-36.26A41.8,41.8,0,0,0,201,92.92a40.86,40.86,0,0,0,9.57,26.82,24.83,24.83,0,0,1,4.53,7.23c2.09,5.83,6.59,10.51,8,16.69a3.93,3.93,0,0,0,1.54,2.07c2.22,1.59,2.73,3.85,3.19,6.36a15,15,0,0,0,14.25,12.51c6.7.43,13.62-4.06,15.3-10.75a33,33,0,0,1,4.58-9.78c3-4.81,4.82-10.3,7.76-15.27,1.8-3,3.1-6.4,5.38-9.24C282.62,110.19,285.82,99.57,284.16,87.54Zm-40.42,67a5.19,5.19,0,0,1-5.78-2.9h9.3C247,153.67,245.45,154.25,243.74,154.5Zm4.82-12.92c-3.84.22-7.7.13-11.55,0a8.29,8.29,0,0,1-3.15-1c-1.37-.66-2.94-1.82-2.65-3.26.35-1.74,2.32-.74,3.5-.76,6.54-.12,13.07-.06,20-.06C253.64,140,251.43,141.41,248.56,141.58Zm19.35-28.89c-2.94,3.74-5.84,7.45-7,12.17a2.13,2.13,0,0,1-2.33,1.88c-3,0-6,0-9,.12-1.83.07-2-1-1.94-2.39,0-3.24,0-6.48,0-9.72a40.74,40.74,0,0,0-.06-6.35c-.72-4.5,1.46-7,5.28-8.62a10.61,10.61,0,0,0,2.56-1.5,4.52,4.52,0,0,0,1.23-6,4.44,4.44,0,0,0-5.34-2.39,14.62,14.62,0,0,0-5.93,3c-1.85,1.5-3.34,1.4-5.18,0a20.36,20.36,0,0,0-4.87-2.71c-2.65-1.06-5.09-.44-6.35,2.2s-.77,5.43,2,6.35c6.59,2.22,7.39,6.94,6.86,12.87a114.46,114.46,0,0,0,0,12.7c0,1.84-.32,2.91-2.42,2.58a4.66,4.66,0,0,0-1.12,0c-5.66.71-10.35.23-11.73-6.9-.45-2.33-2.74-4.38-4.37-6.41-8.58-10.68-9.8-24.64-3.08-36.3s19.56-17.73,33.31-15.62c12.29,1.88,22.82,11.81,25.52,24.66C275.9,95.87,274.07,104.86,267.91,112.69Z" /><path d="M237.74,40c.19,3,1.86,4.92,4.91,5a4.47,4.47,0,0,0,5-4.47,122.43,122.43,0,0,0,0-13.41c-.16-3-2.08-4.78-5.2-4.62s-4.61,2.15-4.74,5.16c-.08,2,0,4,0,6S237.61,37.89,237.74,40Z" /><path d="M176.35,98.71a107.21,107.21,0,0,0,13.05,0c2.92-.19,4.89-2.06,4.76-5.17S192,88.9,189,88.67c-2-.16-4,0-6,0v0a65.25,65.25,0,0,0-6.71,0c-2.77.29-4.65,1.86-4.73,4.83A4.65,4.65,0,0,0,176.35,98.71Z"/><path d="M308.71,88.66c-2-.15-4,0-6,0v0a60.72,60.72,0,0,0-6.33,0c-2.91.29-4.88,1.82-4.91,5s2,4.86,4.87,5a107.11,107.11,0,0,0,12.67,0c2.88-.16,4.94-1.78,4.91-5C313.93,90.37,311.8,88.89,308.71,88.66Z"/><path d="M292,71c3.49-1.89,6.9-3.92,10.3-6,1.68-1,2.85-2.41,2.74-4.29,0-4.12-3.69-6.38-7.35-4.48s-7.15,4-10.64,6.12c-2.88,1.77-3.62,4.45-2.15,7S289.17,72.58,292,71Z"/><path d="M211.56,49.5c1.76,2.85,4.45,3.57,7,2.1s3.13-4.32,1.59-7.13c-1.89-3.48-3.94-6.87-6-10.28-1-1.71-2.45-2.78-3.76-2.74-4.65,0-6.86,3.76-4.95,7.43S209.42,46,211.56,49.5Z"/><path d="M302.7,122.58c-3.69-2.29-7.5-4.39-11.28-6.53a8.18,8.18,0,0,0-1.86-.59,5,5,0,0,0-5,3.51c-.91,2.51.11,4.44,2.19,5.73,3.58,2.23,7.25,4.33,10.93,6.4,2.74,1.54,5.17.87,6.73-1.75S305.32,124.22,302.7,122.58Z" /><path d="M267,51.54a4.42,4.42,0,0,0,6.52-1.42,124.73,124.73,0,0,0,6.9-11.9,4.74,4.74,0,0,0-4.39-6.79,4.69,4.69,0,0,0-4.36,2.38c-2.2,3.74-4.44,7.46-6.49,11.28C263.79,47.7,264.62,50,267,51.54Z" /><path d="M182.19,64.21a116.88,116.88,0,0,0,12.53,7.3c3.12,1.55,6.67-1.24,6.57-4.76a4.27,4.27,0,0,0-1.72-3.57c-4.13-2.52-8.23-5.13-12.55-7.27-2.37-1.17-4.71-.1-6,2.3C179.82,60.43,180.1,62.83,182.19,64.21Z"/><path d="M194.61,115.87c-4.15,2.21-8.24,4.57-12.2,7.1-2,1.25-2.44,3.36-1.63,5.61a4.84,4.84,0,0,0,4.17,3.27c2.47.05,15-7.26,15.8-9.14a4.86,4.86,0,0,0-.75-5.57C198.51,115.57,196.56,114.82,194.61,115.87Z" /></g></g></svg>
                            </div>
                            <span class="tituloMembre">'.$row["membre_nombre"].'</span>
                            <button class="verDetalles" onclick="cargarMembresia('.$row["id_membresia"].')">Ver Más Detalles</button>
                        </div>
                        <div class="divDatos">
                            <div class="divGeneDescrip">    
                                <span class="spanDescrip">Descripción</span>
                                <div class="descrip">
                                    <span>'.$row["membre_descrip"].'</span>
                                </div>
                            </div>
                        </div>
                        <div class="mensuDiv">
                            <span class="mensu">Mensualidad:</span>
                            <span>$'.$row["membre_mensualidad"].'</span>
                            <button class="btnUnirse btnUnirse'.$row["id_membresia"].'" onclick="comprarMembresia('.$row["id_membresia"].', `formUnirseA'.$row["id_membresia"].'`)">Unirse Ahora</button>
                            <form
                                id="formUnirseA'.$row["id_membresia"].'"
                                name="formUnirseA'.$row["id_membresia"].'"
                                method="post"
                                action="membreClienteDetail.php";
                            >
                                <input type="hidden" value="'.$row["id_membresia"].'" name="idMembresia">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            '; 
            
        }

    }
    //---------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="en" class="membreClienteHTML">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membresías BizClub</title>
    <link rel="stylesheet" href="estilos\membresiasCliente.scss">
</head>
<body class="body">
    <header class="header"> 
        <div class="headerDiv1">
            <div class="divLogo">   
            </div>
            <div class="divPerfilGene">   
                <div id="divPerfil" class="divPerfil">
                    <div class="divImg">
                        <img src="imagesUser/<?php echo $resultUsuario["user_imagen"]; ?>" alt="">
                    </div>
                </div>
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
        <nav class="headerNav">
            <ul class="ulNav">
            </ul>
        </nav>   
    </header>
    <main class="main">
        <div class="divAsideGene">
            <div class="divDatosAside"></div>
        </div>
        <div class="divMembreContaintGene">
            <?php echo $membresiasHtml; ?>
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