<?php

    include("conexion.php");

    session_start();

    $htmlHeaderIniciado = "";

    if(isset($_SESSION["iniciado"])){

        $resultUsuario = $conn->query(
            "SELECT * FROM `bizlabDB`.`usuarios`
            WHERE `usuarios`.`id_usuario` = ".$_SESSION["iniciado"].";"
        );

        $resultUsuario = $resultUsuario->fetch_assoc();

        $htmlHeaderIniciado = '
        <header class="headerCli"> 
            <div class="headerDiv1">
                <div class="divLogo">  
                    <a href="index.php" title="Inicio"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1994.45 241.28"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M443,120.46c-3.67-3.34-4.15-5.32-1.12-9.62C457.28,88.93,459.79,65.17,448.4,41S417.2,2.5,390.19.87C367.78-.48,345.24.14,322.76.14Q220.82.15,
                    118.88.37A109.3,109.3,0,0,0,92.66,3.58C30.79,18.93-10.21,79.09,2.23,144.06c10.49,54.84,60.61,97,116.59,97.16,45,.12,89.94,0,134.91,0,47.47,0,95,.09,142.42,0,27.89-.07,53.87-18,64.07-43.91C470.79,170.5,464,139.54,443,120.46Zm-48.13,81.41c-38.14.11-76.28-.09-114.42-.16-8.17,0-16.33,0-24.49,
                    0v.22q-67.71,0-135.41,0C83,201.86,51.6,177,41.74,139.63c-8.94-33.86,7.62-71.74,39.07-89.36a82.6,82.6,0,0,1,41.13-10.6q71.7.07,143.4.2c39.31,0,78.62-.19,117.93-.18,16.94,0,29.23,10.33,31.9,26.44,2.81,17-10.52,33.7-27.76,34.73-2.49.14-5,.1-7.49.1q-118.18,0-236.36,0c-11,0-19,5.62-21.2,14.66-3.53,14.51,
                    4.76,24.93,20,24.94q125.17,0,250.35,0c13.65,0,24,5.26,29.91,17.64C432.39,178.69,417.73,201.81,394.85,201.87Z"/><path d="M1956.25,145.57c16.93-1.18,29.1-9.57,35.21-25.2,6-15.45,2.86-29.79-8.74-41.83-2.67-2.77-2.57-4.53-.64-7.59,16.42-26-.5-60-31.14-60.6-46.11-.93-92.26-.25-138.4-.25a11,11,0,0,0-2,.21,
                    10.8,10.8,0,0,0-9.32,11.18c.06,7.08,4.9,11.13,13.6,11.13q64,0,127.92,0a63.87,63.87,0,0,1,9,.45,16.45,16.45,0,0,1,13.89,14.33,16.65,16.65,0,0,1-10.22,17.63c-3.32,1.42-6.76,1.56-10.28,1.56q-64.71,0-129.41,0c-11,0-14.68,3.58-14.74,14.64q-.12,24.66,0,49.33c0,11.61,3.64,15.13,15.38,15.15q34.47,0,69,0v0h68C1954.26,145.72,
                    1955.26,145.64,1956.25,145.57ZM1891.58,123c-20.65,0-41.29-.13-61.93.1-4.68,0-6.07-1.47-5.89-6,.32-7.79.2-15.61,0-23.41-.07-3.39,1.1-4.67,4.61-4.66,41.62.09,83.24,0,124.86.12,10.74,0,18.26,7.37,18.19,17.1S1964,122.91,1953,123C1932.53,123,1912.05,123,1891.58,123Z"/><path d="M754.81,70.49c6.44-9.7,7.83-20.46,4.67-31.51-5.11-17.86-20.19-28.88-39.11-28.9q-65.94-.11-131.89,0a31.16,31.16,0,0,0-6,.39,10.42,10.42,0,0,0-8.73,10.06c-.45,7.66,4.44,12.1,13.56,12.1q63.95,0,127.9,0a58.17,58.17,0,0,1,9,.46,16.55,16.55,0,0,1,12.58,23.09c-3.41,7.63-9.75,10.42-17.74,10.41q-65.7,0-131.39,0c-10.31,0-13.92,3.54-13.94,13.67q0,25.17,0,50.32c0,11.8,3.29,15.11,15.16,15.13q34.47,0,69,0v-.22c23.81,0,47.63.49,71.42-.17,16.76-.46,28.65-9.64,34.68-25s3-29.5-8.44-41.44C752.51,75.79,752.62,73.8,754.81,70.49Zm-29,52.45c-20.64.1-41.27,0-61.91,0s-41.28-.09-61.91.09c-4.33,0-5.92-1.2-5.74-5.64.3-7.78.19-15.6,0-23.39-.07-3.54,1-5,4.82-5,41.61.11,83.21,0,124.82.13,10.59,0,18.28,7.66,18.08,17.27S736.28,122.89,725.8,122.94Z"/><path d="M1059.05,145.32a10.59,10.59,0,0,0,9.3-10.62c.13-7.34-4.83-11.69-13.63-11.7q-60.47,0-120.91,0c-2.08,0-4.29.57-6.6-.88,1.07-1.91,2.63-2.6,4-3.51Q973,90.81,1014.75,63.09c15.8-10.49,31.65-20.91,47.38-31.49,7.49-5.05,8.38-13.77,2.24-18.91-3.07-2.56-6.7-2.64-10.39-2.64q-81.94,0-163.88,0a28.71,28.71,0,0,0-6.43.56,10.79,10.79,0,0,0-8.23,10.08,11,11,0,0,0,7.49,11.16c2.42.87,4.92.76,7.41.76q60,0,119.91,0c2,0,4.27-.64,6.24.95-1.34,2.58-3.79,3.47-5.79,4.8Q953.36,76.55,896,114.58c-5.26,3.49-10.61,6.88-15.71,10.61A11.1,11.1,0,0,0,876.05,138c1.71,5,5.44,7.32,10.64,7.47,1.16,0,2.33,0,3.5,0h163.37A38.66,38.66,0,0,0,1059.05,145.32Z"/><path d="M1300,134.49c0-6.82-5.31-11.41-13.5-11.49-6.33-.06-12.66,0-19,0-31,0-62,.22-92.94-.09-18.24-.18-32.07-8.71-40.09-25S1128,65.15,1139,50.42c9.72-12.94,23.36-17.89,39.33-17.82,35.47.15,71,0,
                    106.43,0,2.49,0,5,.13,7.42-.7a11,11,0,0,0,5-17.83c-3-3.56-7-4.06-11.31-4.06q-55.71,0-111.43,0a67.32,67.32,0,0,0-17.76,2.44,68,68,0,0,0-49.07,76.17c4.67,31.74,33.46,56.74,66.64,56.84,18.16.05,36.31,0,54.47,0,19.32,0,38.64,0,58,0C1294.89,145.5,1299.94,141.21,1300,134.49Z"/><path d="M1756.85,16a11.27,11.27,0,0,0-12.79-5.41c-5.09,1.31-8.32,5.3-8.35,11-.11,18.26,0,36.53-.08,54.79-.12,27.06-19.54,46.49-46.62,46.62-18,.09-36,.06-54,0-27.87-.09-47-19.19-47.12-47-.07-16.61,0-33.21,0-49.82,0-1.49,0-3,0-4.48-.33-6.72-5-11.47-11.34-11.51s-11.16,4.62-11.21,11.44q-.21,28.39,0,56.79a67.4,67.4,0,0,0,67.42,67.16c9.65,0,19.31,0,29,0,10.32,0,20.65.13,31,0,34.85-.53,64.84-30,65.44-64.53.34-19.59.07-39.19.07-58.78A11.74,11.74,0,0,0,1756.85,16Z"/><path d="M1517.29,124c-2.56-1.07-5.21-1-7.87-1H1374.08c-8.54,0-8.55,0-8.55-8.75q0-44.08,0-88.16a33.37,33.37,0,0,0-.6-7.41,10.65,10.65,0,0,0-10.34-8.51,10.87,10.87,0,0,0-11.24,8.06,23.48,23.48,0,0,0-.77,6.38q-.08,53.3,0,106.58c0,10.47,4,14.35,14.56,14.36q38.21,0,76.41,0h75.42c1.83,0,3.67.06,5.48-.12a10.73,10.73,0,0,0,9.85-9A11.05,11.05,0,0,0,1517.29,124Z"/><path d="M832.4,133.1c.1-18.43,0-36.85,0-55.28q0-15.43,0-30.87c0-8.3.1-16.6-.05-24.9C832.26,15,827.5,10.13,821,10.14c-6.34,0-10.77,4.49-11.3,11.49-.12,1.49-.09,3-.09,4.48q0,51.8,0,103.58a37.31,37.31,0,0,0,.43,6.94c.93,4.93,4.1,7.87,9,8.72C826.58,146.65,832.36,141.42,832.4,133.1Z"/><path d="M1989.32,207.63c-1.43-1.06-2.35-1.86-1-4,7-11.51,1.77-20.91-11.89-21.35-5.82-.18-11.65.17-17.46-.12-4.51-.23-6.36,1.34-6.16,6,.26,6.12.06,12.27.07,18.4q0,10,0,19.91c0,2.56.53,4.77,3.7,4.75,8.81,0,17.65.78,26.4-.68,5-.85,9.24-3.43,10.63-8.6C1995,216.49,1994.33,211.32,1989.32,207.63Zm-23.7-20.16c4.27.39,8.6-.36,12.86.67,4,1,6.67,3.13,6.67,7.43s-2.78,6.43-6.69,7.46c-3.1.83-6.24.61-9.38.68-10.36-.1-9.47,1.24-9.76-10.09C1959.19,188.81,1960.87,187,1965.62,
                    187.47Zm13.8,38a91.59,91.59,0,0,1-9.4.69c-11.72-.34-10.34,1.54-10.71-10.75-.14-4.9,1.22-7,6.41-6.53,4.6.46,9.3-.37,13.89.58,4.27.89,8,2.47,8.06,7.83C1987.69,221.87,1985.28,224.47,1979.42,225.47Z"/><path d="M605.79,207.59c-1.46-1.1-2.2-1.91-.9-4,7-11.18,1.79-20.77-11.57-21.29-6.32-.25-12.66.05-19-.13-3.64-.1-5.16,1.35-5.1,5,.12,6.48,0,12.95,0,19.43,0,6.64,0,13.29,0,19.93,0,3,1,4.82,4.29,4.75,8.31-.17,16.66.59,24.94-.59,5.47-.78,10-3.24,11.63-8.8S610.69,211.29,605.79,207.59Zm-30.13-17.08c.05-2,1.41-2.9,3.33-2.93,2.33,0,4.66,0,7,0,3.49,0,7-.21,10.37,1s5.34,3.4,5.42,6.94-1.85,6-5.19,7.08c-6,2-12.2,1.06-18.33,1a2.48,2.48,0,0,1-2.53-2.58C575.61,197.47,575.57,194,575.66,190.51ZM598.14,225c-3.91,1.21-7.91,1-11.89,1-11.76-.15-10.43,1.52-10.8-10.65-.16-5.06,1.49-7,6.56-6.47,5.43.52,11-.58,16.36,1.14,3.75,1.2,6,3.4,6,7.53S601.85,223.81,598.14,225Z"/><path d="M1068.78,187.5c0-2.21.49-5.09-3.09-5.09-3.39,0-3.31,2.62-3.31,5,0,8.3,0,16.6-.06,24.89,0,1.53.88,3.8-1.13,4.37-1.46.41-2.28-1.62-3.19-2.76q-11.37-14.19-22.7-28.41c-1.51-1.9-3.09-3.75-5.78-3s-2.15,3.43-2.18,5.47c-.09,6.14,0,12.28,0,18.42,0,6.47,0,13,0,19.42,0,2.26-.42,5.15,3,5.2,3.66.05,3.45-2.87,3.45-5.39,0-8.13,0-16.26,0-24.4,0-1.57-.81-3.83.91-4.53,1.91-.78,2.56,1.63,3.52,2.81q11.74,14.53,23.36,29.16c1.34,1.68,2.93,2.87,5.13,2.23s2-2.81,2-4.58Q1068.84,206.91,1068.78,187.5Z"/><path d="M1186.5,225.83c-4.33-.07-8.66,0-13-.06-13.06-.25-11.55,2.38-11.76-12.1,0-3.79,1.6-4.9,5.14-4.76,5,.19,10,.08,15,0,2,0,4.44.22,4.34-2.73s-2.5-2.67-4.48-2.72c-3.17-.07-6.33,0-9.5,0-11.33-.14-10.32,1.71-10.48-10.9,0-3.83,1.66-4.87,5.15-4.79,6.16.14,12.32,0,18.48,0,1.93,0,4-.38,4-2.73s-2-2.73-3.93-2.74c-8.49,0-17,.07-25.47,0-3.27,0-4.45,1.41-4.42,4.5.08,6.64,0,13.28,0,19.93s0,13.28,0,19.93c0,2.59.48,4.67,3.72,4.67,9.16,0,18.32,0,27.48,0,1.74,0,3.48-.4,3.54-2.62C1190.41,226,1188.35,225.86,
                    1186.5,225.83Z"/><path d="M733.73,199.82c0-4.65,0-9.29,0-13.94,0-2.07-1-3.54-3.33-3.44-2.22.1-2.62,1.71-2.72,3.47s0,3.32-.08,5c-.27,8,.77,16-.69,23.85-1.33,7.24-5.93,11-13.12,11.19-7.42.18-12.35-3.63-13.84-10.94a39.12,39.12,0,0,1-.65-7.41c-.1-7.14,0-14.28-.1-21.42,0-1.94-.46-3.72-3-3.77-2,0-3.38.88-3.34,2.87.21,11.09-1.52,22.28,1.21,33.23,2.17,8.68,9.49,13.25,19.93,13.06,10-.18,16.61-5.09,18.81-13.88C734.31,211.77,733.6,205.78,733.73,199.82Z"/><path d="M1866.29,200.06c0-4.82,0-9.64,0-14.45,0-1.88-.77-3.28-2.94-3.2s-3,1.31-3.06,3.22c-.08,1.49-.07,3-.09,4.48-.08,7.81,0,15.62-.29,23.42-.19,5.2-2.62,9.16-7.72,11.18-10.32,4.09-19.47-1.59-20-12.84-.41-8.62-.16-17.27-.2-25.91,0-2.08-.68-3.56-3.12-3.57s-3.16,1.45-3.14,3.55c.08,9.63-.33,19.3.4,28.88.84,11,9,17,20.94,16.73,11.24-.26,18.34-6.64,19.13-17.55.33-4.62,0-9.29,0-13.94Z"/><path d="M1296.77,206.27c-4.71-1.63-9.61-2.7-14.34-4.29-3.1-1-5.82-2.91-5.76-6.69s2.51-5.94,6-7.09c5.56-1.86,10.86-.77,16,1.5,2,.87,3.62,1,4.53-1.25.8-2-.49-3.1-2.06-3.94-4.09-2.2-8.54-2.66-14.23-2.7a49.83,49.83,0,0,0-5.78.77c-6.23,1.4-10.52,6.24-10.93,12.06s2.35,10,8.7,12.45c5.26,2,10.79,3.29,16.12,5.14,2.87,1,4.82,3.14,4.6,6.39s-2.18,5.09-5,6.2c-6.57,2.54-12.73,1.15-18.76-1.85-1.78-.89-3.93-3.08-5.54-.16s.86,4.28,2.94,5.35a30.4,30.4,0,0,0,23.28,2.14,13,13,0,0,0,9.65-12C1306.3,212.6,1303.31,208.55,1296.77,206.27Z"/><path d="M841.33,205.63c-4.4-1.47-9-2.45-13.36-4-3-1-5.21-3.16-5-6.68.22-3.33,2.25-5.38,5.31-6.54,5.5-2.08,10.82-1.14,16,1,1.94.79,3.93,1.83,5.09-.74,1.28-2.85-1.09-3.77-3.09-4.63a29.9,29.9,0,0,0-20.5-1,12.34,12.34,0,0,0-7.82,6.54c-4.06,8.16,0,15.76,10.13,18.7,4.3,1.25,8.66,2.31,12.89,3.76,3,1,5.25,3.12,4.93,6.66-.31,3.36-2.55,5.26-5.61,6.3-6.42,2.2-12.42.88-18.27-2.08-1.79-.91-3.92-3.07-5.52-.14s.91,4.22,2.95,5.35c4.46,2.47,9.32,3.46,15.75,3.38a32.35,32.35,0,0,0,
                    3.62-.31c7.82-1.2,12.8-5.63,13.47-11.88C853.08,212.68,849.78,208.45,841.33,205.63Z"/><path d="M1410.79,206.11c-4.39-1.53-9-2.52-13.4-3.94-3.52-1.14-6.56-3.1-6.24-7.33.32-4,3.2-6,6.86-7,5.26-1.38,10.26-.33,15.09,1.77,1.94.85,3.65,1.05,4.56-1.17.79-1.9-.32-3.23-2-4-8-3.41-16.09-4.11-24.14-.26a11.62,11.62,0,0,0-6.21,7.43c-2.39,7.87,1.73,14,11.33,16.68,4.16,1.18,8.35,2.25,12.44,3.64,3,1,5.17,3.06,5,6.64s-2.5,5.27-5.51,6.34c-6.42,2.27-12.45.91-18.29-2.06-1.83-.93-3.92-3-5.56-.13s.94,4.18,2.93,5.3a30.62,30.62,0,0,0,14.44,3.63c2.3-.29,4.64-.43,6.91-.91,6.85-1.46,11.12-6,11.46-12C1420.76,212.4,1418.06,208.64,1410.79,206.11Z"/><path d="M1625.81,222.27a14.52,14.52,0,0,1-1.67,1.09,20,20,0,0,1-22.83-2.35,19.19,19.19,0,0,1-4.81-22.29c3.14-7.2,11.17-11.8,19.52-11.13a20.09,20.09,0,0,1,10.62,3.94,2.83,2.83,0,0,0,4.35-.6c1.46-1.83.28-3.07-1-4.24a12.86,12.86,0,0,0-2-1.48c-8.58-5.34-22.53-4.35-30.57,2.15-8.25,6.67-11.19,18-7.4,28.45,3.49,9.65,13,15.78,24.32,15.74,5.85,0,11-1.44,14.63-4.18,1.54-1.16,3.76-2.3,2.33-4.73S1627.77,220.74,1625.81,222.27Z"/><path d="M1743.6,225.83c-5.65-.08-11.31-.25-16.95,0-4.46.21-6.25-1.24-6.13-5.92.28-10.61.14-21.22,0-31.84,0-2.26.92-5.6-3-5.63-4.11,0-3.32,3.38-3.36,5.89-.09,6.14,0,12.27,0,18.41h0c0,6.63,0,13.26,0,19.89,0,3.12,1.33,4.62,4.45,4.62,8.31,0,16.62,0,24.94,0,1.85,0,3.94-.24,4-2.73S1745.41,225.86,1743.6,225.83Z"/><path d="M940.79,187.28c0-2.28.26-5-3.33-4.86s-3.05,2.89-3.07,5.15c0,6.3,0,12.61,0,18.92,0,6.47,0,12.94,0,19.42,0,2.31-.33,5,3.11,5.13s3.29-2.6,3.3-4.92Q940.84,206.7,940.79,187.28Z"/></g></g></svg></a>
                </div>
                <div class="divPerfilGene">   
                    <div id="divPerfil" class="divPerfil">
                        <div class="divImg">
                            <img src="imagesUser/'.$resultUsuario['user_imagen'].'" alt="">
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
                <form
                    id = "form_btnPagarMensu"
                    name = "form_btnPagarMensu"
                    method = "post"
                    action = "comprobarStdMembresia.php"
                >
                    <input name="verifiMembresiaEstd" type="hidden" value="true">
                </form>
                <form
                    id = "form_btnRealizaRese"
                    name = "form_btnRealizaRese"
                    method = "post"
                    action = "realizarReserva-CLI.php"
                >
                    <input name="realizaReseCli" type="hidden" value="true">
                </form>
                <ul class="ulNav">
                    <li><a class="btnPagarMensuali">Pagar Mensualidad</a></li>
                    <li><a class="btnRealizaRese">Reservar Unidad</a></li>
                </ul>
            </nav>   
        </header>
        ';

        //---------------------------------------------------------------------------------------------------
        // Div para verificar si el usuario es miembro o no

        $htmlMembreDispo = "";
        $claseMembre = "divMembreConfirmGene-C";

        if($_SESSION["tipoUsuario"] == "Usuario"){

            $claseMembre = "divMembreConfirmGene-A";

            $htmlMembreDispo = '
            <div class="divMembreDispo">
                <div class="spanSvgDiv">
                    <div class="svgDiv">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.49 452.25"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M492.28,284.85c-28.94-45.84-57.46-91.93-86.17-137.91-21-33.56-41.37-67.5-63.11-100.55C311.86-1,247.39-14,199.68,16.32c-16.43,10.45-28.07,25-38.21,41.35Q89.26,174,16.56,290c-14,22.35-19,46.49-15.46,72.52C8,412.94,52.66,452.18,103.37,452.2q152.43.06,304.85-.05c33.23-.06,60-14.17,80.93-39.55,12.38-15,19-32.58,22.34-51.56V333.1C508.6,315.61,501.75,299.83,492.28,284.85ZM422.86,419.44a93.5,93.5,0,0,1-20.78,2.12q-73.09,0-146.17,0-73.33,0-146.67,0c-15.19,0-29.78-2.92-42.79-11.31-20.7-13.36-32.63-32.12-34.92-56.87C30,336.5,34,321.07,42.9,306.83q49.62-79.56,99.29-159.09C159,120.8,175.75,93.82,192.64,66.93c14.6-23.24,36-35.4,63.18-35.49,26.74-.09,48.35,11.53,62.75,34.39,34.65,55,68.91,110.24,103.32,165.39,15.41,24.68,30.65,49.46,46.27,74,8.19,12.86,13,26.81,12.78,41.86C480.33,384.78,455.06,412.12,422.86,419.44Z"/><path d="M295.61,83a48.46,48.46,0,0,0-9.81-11.87c-22.15-18.53-53.49-13.46-69.08,11.34-17.42,27.73-34.68,55.57-52,83.36q-49,78.51-97.9,157c-9.36,15.09-9.73,31-1.07,46.43S88.1,392.36,106,392.34q75.09-.06,150.17,0t150.18,0a44.32,44.32,0,0,0,8.93-.6c32.1-6.71,46.93-41.69,29.52-69.63Q370.24,202.49,295.61,83ZM421,348c-.66,7.81-6.57,13-15.28,13.63-2.48.17-5,.06-7.48.06H112.29c-1.66,0-3.32,0-5,0-13.82-.18-20.33-12.74-13.17-24,18.72-29.47,37-59.2,55.52-88.83,30.19-48.38,60.79-96.52,90.34-145.3,9.52-15.71,22.29-15.76,32,0,47.55,77.33,95.88,154.19,143.94,231.21C418.47,338.84,421.38,342.86,421,348Z"/><path d="M271.3,218.85c0-16.29-.08-32.57.05-48.86,0-3.61-1.14-5.07-4.87-5-7.14.2-14.29.15-21.43,0-3.19-.05-4.41,1.17-4.41,4.38q.11,48.85,0,97.72c0,3.64,1.63,4.51,4.85,4.45,6.65-.14,13.31-.27,19.94,0,4.56.22,6-1.34,6-5.93C271.15,250.1,271.3,234.47,271.3,218.85Z"/><path d="M267.43,300.82q-11.44.09-22.9,0c-2.74,0-3.88,1.14-3.86,3.86q.11,11.46,0,22.91c0,2.73,1.14,3.91,3.87,3.85,4-.08,8,0,12,0,14.82,0,14.82,0,14.78-14.83,0-4-.06-8,0-11.95C271.35,301.94,270.16,300.79,267.43,300.82Z"/></g></g></svg>
                    </div>
                    <div class="spansDiv">
                        <span>Su Rol actual en BizClub es el de <b>Usuario Común</b></span>
                        <span>Para acceder a los servicios debe hacerse miembro</span>
                    </div>
                </div>
                <a href="membresiasCliente.php"><button class="btnMembre">Obtener Membresía</button></a>
            </div>
            ';

        }

        //---------------------------------------------------------------------------------------------------

    }else{

        header("location:inicioSesion.php");

    }

?>

<!DOCTYPE html>
<html lang="es" id="serviciosHTML-CLI">
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Servicios</title>
        <link rel="shortcut icon" type="x-icon" href="images/favicon_bizclub.svg">
        <link rel="stylesheet" href="estilos/servicios.css">

        <input id="rolUserINOculto" type="hidden" value="<?php echo $resultUsuario["user_rol"]; ?>">

    </head>
    <body class="body">
        <?php echo $htmlHeaderIniciado; ?>
        <main class="main">
            <span class="serviciosSpan">Nuestros Servicios</span>
            <span class="serviReseSpan">Reserva una unidad para tus labores</span>
            <div class="divMembreConfirmGene <?php echo $claseMembre; ?>">
                <?php echo $htmlMembreDispo; ?>
            </div>
            <div id="divServiciosGene" class="divServiciosGene">
                <div id="catalogoServiGene" class="catalogoServiGene">
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="flexContainerEnlaces">
                <a target="_blank" href="https://wa.me/+573044138809">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,2c-12.69047,0 -23,10.30953 -23,23c0,4.0791 1.11869,7.88588 2.98438,11.20898l-2.94727,10.52148c-0.09582,0.34262 -0.00241,0.71035 0.24531,0.96571c0.24772,0.25536 0.61244,0.35989 0.95781,0.27452l10.9707,-2.71875c3.22369,1.72098 6.88165,2.74805 10.78906,2.74805c12.69047,0 23,-10.30953 23,-23c0,-12.69047 -10.30953,-23 -23,-23zM25,4c11.60953,0 21,9.39047 21,21c0,11.60953 -9.39047,21 -21,21c-3.72198,0 -7.20788,-0.97037 -10.23828,-2.66602c-0.22164,-0.12385 -0.48208,-0.15876 -0.72852,-0.09766l-9.60742,2.38086l2.57617,-9.19141c0.07449,-0.26248 0.03851,-0.54399 -0.09961,-0.7793c-1.84166,-3.12289 -2.90234,-6.75638 -2.90234,-10.64648c0,-11.60953 9.39047,-21 21,-21zM16.64258,13c-0.64104,0 -1.55653,0.23849 -2.30859,1.04883c-0.45172,0.48672 -2.33398,2.32068 -2.33398,5.54492c0,3.36152 2.33139,6.2621 2.61328,6.63477h0.00195v0.00195c-0.02674,-0.03514 0.3578,0.52172 0.87109,1.18945c0.5133,0.66773 1.23108,1.54472 2.13281,2.49414c1.80347,1.89885 4.33914,4.09336 7.48633,5.43555c1.44932,0.61717 2.59271,0.98981 3.45898,1.26172c1.60539,0.5041 3.06762,0.42747 4.16602,0.26563c0.82216,-0.12108 1.72641,-0.51584 2.62109,-1.08203c0.89469,-0.56619 1.77153,-1.2702 2.1582,-2.33984c0.27701,-0.76683 0.41783,-1.47548 0.46875,-2.05859c0.02546,-0.29156 0.02869,-0.54888 0.00977,-0.78711c-0.01897,-0.23823 0.0013,-0.42071 -0.2207,-0.78516c-0.46557,-0.76441 -0.99283,-0.78437 -1.54297,-1.05664c-0.30567,-0.15128 -1.17595,-0.57625 -2.04883,-0.99219c-0.8719,-0.41547 -1.62686,-0.78344 -2.0918,-0.94922c-0.29375,-0.10568 -0.65243,-0.25782 -1.16992,-0.19922c-0.51749,0.0586 -1.0286,0.43198 -1.32617,0.87305c-0.28205,0.41807 -1.4175,1.75835 -1.76367,2.15234c-0.0046,-0.0028 0.02544,0.01104 -0.11133,-0.05664c-0.42813,-0.21189 -0.95173,-0.39205 -1.72656,-0.80078c-0.77483,-0.40873 -1.74407,-1.01229 -2.80469,-1.94727v-0.00195c-1.57861,-1.38975 -2.68437,-3.1346 -3.0332,-3.7207c0.0235,-0.02796 -0.00279,0.0059 0.04687,-0.04297l0.00195,-0.00195c0.35652,-0.35115 0.67247,-0.77056 0.93945,-1.07812c0.37854,-0.43609 0.54559,-0.82052 0.72656,-1.17969c0.36067,-0.71583 0.15985,-1.50352 -0.04883,-1.91797v-0.00195c0.01441,0.02867 -0.11288,-0.25219 -0.25,-0.57617c-0.13751,-0.32491 -0.31279,-0.74613 -0.5,-1.19531c-0.37442,-0.89836 -0.79243,-1.90595 -1.04102,-2.49609v-0.00195c-0.29285,-0.69513 -0.68904,-1.1959 -1.20703,-1.4375c-0.51799,-0.2416 -0.97563,-0.17291 -0.99414,-0.17383h-0.00195c-0.36964,-0.01705 -0.77527,-0.02148 -1.17773,-0.02148zM16.64258,15c0.38554,0 0.76564,0.0047 1.08398,0.01953c0.32749,0.01632 0.30712,0.01766 0.24414,-0.01172c-0.06399,-0.02984 0.02283,-0.03953 0.20898,0.40234c0.24341,0.57785 0.66348,1.58909 1.03906,2.49023c0.18779,0.45057 0.36354,0.87343 0.50391,1.20508c0.14036,0.33165 0.21642,0.51683 0.30469,0.69336v0.00195l0.00195,0.00195c0.08654,0.17075 0.07889,0.06143 0.04883,0.12109c-0.21103,0.41883 -0.23966,0.52166 -0.45312,0.76758c-0.32502,0.37443 -0.65655,0.792 -0.83203,0.96484c-0.15353,0.15082 -0.43055,0.38578 -0.60352,0.8457c-0.17323,0.46063 -0.09238,1.09262 0.18555,1.56445c0.37003,0.62819 1.58941,2.6129 3.48438,4.28125c1.19338,1.05202 2.30519,1.74828 3.19336,2.2168c0.88817,0.46852 1.61157,0.74215 1.77344,0.82227c0.38438,0.19023 0.80448,0.33795 1.29297,0.2793c0.48849,-0.05865 0.90964,-0.35504 1.17773,-0.6582l0.00195,-0.00195c0.3568,-0.40451 1.41702,-1.61513 1.92578,-2.36133c0.02156,0.0076 0.0145,0.0017 0.18359,0.0625v0.00195h0.00195c0.0772,0.02749 1.04413,0.46028 1.90625,0.87109c0.86212,0.41081 1.73716,0.8378 2.02148,0.97852c0.41033,0.20308 0.60422,0.33529 0.6543,0.33594c0.00338,0.08798 0.0068,0.18333 -0.00586,0.32813c-0.03507,0.40164 -0.14243,0.95757 -0.35742,1.55273c-0.10532,0.29136 -0.65389,0.89227 -1.3457,1.33008c-0.69181,0.43781 -1.53386,0.74705 -1.8457,0.79297c-0.9376,0.13815 -2.05083,0.18859 -3.27344,-0.19531c-0.84773,-0.26609 -1.90476,-0.61053 -3.27344,-1.19336c-2.77581,-1.18381 -5.13503,-3.19825 -6.82031,-4.97266c-0.84264,-0.8872 -1.51775,-1.71309 -1.99805,-2.33789c-0.4794,-0.62364 -0.68874,-0.94816 -0.86328,-1.17773l-0.00195,-0.00195c-0.30983,-0.40973 -2.20703,-3.04868 -2.20703,-5.42578c0,-2.51576 1.1685,-3.50231 1.80078,-4.18359c0.33194,-0.35766 0.69484,-0.41016 0.8418,-0.41016z"></path></g></g>
                    </svg>
                </a>
                <a target="_blank" href="https://mail.google.com/mail/u/2/#inbox?compose=CllgCJvqsKdQQMdxJNjVPkmWPBMFLLCWFrQTnkZGftqFKTpBSdjcztwknBlHlNZrQNsPFdFPcSq">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M43.75391,6.40234c-1.2177,-0.05335 -2.45911,0.31055 -3.48242,1.06641l-2.74609,2.02734l-12.52539,9.25977l-12.4082,-9.17187c-0.17292,-0.16897 -0.4012,-0.26957 -0.64258,-0.2832h0.25l-2.46484,-1.82422c-1.02397,-0.75773 -2.26723,-1.12367 -3.48633,-1.07031c-1.2191,0.05336 -2.4131,0.52522 -3.33984,1.43945c-1.17726,1.16068 -1.9082,2.78413 -1.9082,4.56445v3.43359c-0.01457,0.09777 -0.01457,0.19715 0,0.29492v23.36133c0,1.92119 1.57881,3.5 3.5,3.5h7.5c0.55226,-0.00006 0.99994,-0.44774 1,-1v-16.62695l11.40625,8.43164c0.353,0.26043 0.8345,0.26043 1.1875,0l11.40625,-8.43164v16.62695c0.00006,0.55226 0.44774,0.99994 1,1h7.5c1.92119,0 3.5,-1.57881 3.5,-3.5v-23.38086c0.01129,-0.08622 0.01129,-0.17355 0,-0.25977v-3.44922c0,-1.75846 -0.70954,-3.37437 -1.87109,-4.53711c-0.03357,-0.03357 -0.04482,-0.04287 -0.03125,-0.0293c-0.00194,-0.00196 -0.0039,-0.00391 -0.00586,-0.00586c-0.92656,-0.91221 -2.12019,-1.3822 -3.33789,-1.43555zM43.64453,8.40039c0.7563,0.02965 1.48952,0.3165 2.04492,0.86328c0.01891,0.01867 0.03272,0.03277 0.02344,0.02344c0.79645,0.79726 1.28711,1.9015 1.28711,3.12305v3.08594l-8,5.91211v-10.4082c0.00042,-0.0339 -0.00088,-0.0678 -0.00391,-0.10156l2.46289,-1.82031c0.00065,0 0.0013,0 0.00195,0c0.64864,-0.47915 1.42729,-0.70739 2.18359,-0.67773zM6.35742,8.40625c0.75715,-0.02964 1.53847,0.19746 2.1875,0.67773l2.45898,1.81836c-0.00289,0.03247 -0.0042,0.06506 -0.00391,0.09766v10.4082l-8,-5.91211v-3.08594c0,-1.23567 0.50176,-2.3413 1.3125,-3.14062c0.55526,-0.54776 1.28777,-0.83364 2.04492,-0.86328zM37,12.37109v10.51563l-12,8.86914l-12,-8.86914v-10.51367l11.40625,8.43164c0.353,0.26043 0.8345,0.26043 1.1875,0zM3,17.98242l8,5.91406v17.10352h-6.5c-0.84081,0 -1.5,-0.65919 -1.5,-1.5zM47,17.98242v21.51758c0,0.84081 -0.65919,1.5 -1.5,1.5h-6.5v-17.10352z"></path></g></g>
                    </svg>
                </a>
                <a target="_blank" href="https://www.instagram.com/bizclubworld?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M16,3c-7.16752,0 -13,5.83248 -13,13v18c0,7.16752 5.83248,13 13,13h18c7.16752,0 13,-5.83248 13,-13v-18c0,-7.16752 -5.83248,-13 -13,-13zM16,5h18c6.08648,0 11,4.91352 11,11v18c0,6.08648 -4.91352,11 -11,11h-18c-6.08648,0 -11,-4.91352 -11,-11v-18c0,-6.08648 4.91352,-11 11,-11zM37,11c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2c1.10457,0 2,-0.89543 2,-2c0,-1.10457 -0.89543,-2 -2,-2zM25,14c-6.06329,0 -11,4.93671 -11,11c0,6.06329 4.93671,11 11,11c6.06329,0 11,-4.93671 11,-11c0,-6.06329 -4.93671,-11 -11,-11zM25,16c4.98241,0 9,4.01759 9,9c0,4.98241 -4.01759,9 -9,9c-4.98241,0 -9,-4.01759 -9,-9c0,-4.98241 4.01759,-9 9,-9z"></path></g></g>
                    </svg>
                </a>
            </div>
            <div class="flexContainerLogo">
                <svg class="footer_logoBizSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 76.43 39.84"><g id="Capa_2" data-name="Capa 2"><g id="Capa_1-2" data-name="Capa 1"><path d="M72.55,19.72c-.51-.49-.49-.79-.1-1.27a9.71,9.71,0,0,0,1.65-3A11.54,11.54,0,0,0,63.13,0Q41.55,0,19.94,0a19.89,19.89,0,0,0-.68,39.76c7.53.15,15.07,0,22.61,0v0H64.24a12.61,12.61,0,0,0,3.91-.44C76.92,36.52,79.26,26.12,72.55,19.72ZM65.42,33.37a13.3,13.3,0,0,1-1.55.08H20.32A13.18,13.18,0,0,1,8.84,27.68,12.85,12.85,0,0,1,7.69,14.15C10,9.38,13.91,6.54,19.22,6.49c14.72-.15,29.44-.07,44.16,0a5.05,5.05,0,0,1,5,5.09,5.13,5.13,0,0,1-4.91,5.18c-.4,0-.8,0-1.2,0l-38.53,0A3.21,3.21,0,0,0,20.39,20a3.26,3.26,0,0,0,3.42,3.23q20.52,0,41-.06a5.11,5.11,0,0,1,.57,10.2Z"/></g></g></svg>
                <div class="footer_copyrightContent">
                    Copyright​ © 2024 BizLab SAS 
                </div>
            </div>
        </footer> 
        <script src="scripts\app1.js"></script>
    </body>
</html>
