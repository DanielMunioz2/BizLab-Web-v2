//--------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------
// Funciones y Variables Globales - INICIO
//------------------------------------------

  //-----------------------------------------------------------------------------------------------------------------------------
  // VARIABLES

  var urlInfoClienteDB = "http://localhost/BizLab/consultarInfoCliente.php";

  //-----------------------------------------------------------------------------------------------------------------------------

  //-----------------------------------------------------------------------------------------------------------------------------
  // FUNCIONES
  
  //-----------------------------------------------------------------------------------------------------------------------------

//------------------------------------------
// Funciones y Variables Globales - FIN
//------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------
// <<-- Index - INICIO -->>
//---------------------------

if(document.querySelector("#indexHTML") != null){

  //---------------------------------------------------------------------------------------------------------------------------
  // Tomando elementos del DOM

    // CONTENEDORES
    const cuadroOPerfil = document.querySelector(".cuadroPOculto");
    const divPerfilFotoBtn = document.querySelector(".divPerfil");
    const ajustesCuentaBtn = document.querySelector("#ajustesCuentaBtn"); 
    const btnCerrarSesion = document.querySelector(".btnCerrar");

  // Tomando elementos del DOM
  //---------------------------------------------------------------------------------------------------------------------------

  //---------------------------------------------------------------------------------------------------------------------------
  // FUNCIONES

  // FUNCIONES
  //---------------------------------------------------------------------------------------------------------------------------

  //---------------------------------------------------------------------------------------------------------------------------
  // EVENTOS

    // (Click fuera) ocultar cuadro perfil opciones
    if(document.querySelector("#cuadroPOculto") != null){

      window.addEventListener('click', function mostrarCuadroPerfil(e) {

        if (document.getElementById('divPerfil').contains(e.target)) {
            

        } else {
                
            document.querySelector("#cuadroPOculto").classList.replace("cuadroOPerfil2", "cuadroOPerfil1");

        }

      });

    }

    // Foto Perfil Botón
    divPerfilFotoBtn.addEventListener("click", () => {
      if (cuadroOPerfil.classList.contains("cuadroOPerfil1")) {
          cuadroOPerfil.classList.replace("cuadroOPerfil1", "cuadroOPerfil2");
      } else {
          if (cuadroOPerfil.classList.contains("cuadroOPerfil2")) {
          cuadroOPerfil.classList.replace("cuadroOPerfil2", "cuadroOPerfil1");
          }
      }
    });

    // Botón Ajustes de la Cuenta
    ajustesCuentaBtn.addEventListener("click", (e) => {
      
      e.preventDefault();
      window.location.href = "usuarioPerfil.php";

    })
    
    // Botón Cerrar Sesión
    btnCerrarSesion.addEventListener("click", (e) => {

      window.location.href = "cerrar.php";

    });

  // EVENTOS
  //---------------------------------------------------------------------------------------------------------------------------
  

}

//-------------------------
// <<-- Index - FIN -->>
//-------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------
// <<-- Inicio Sesión - INICIO -->>
//------------------------------------

if(document.querySelector("#iniSesionHTML") !== null) {
  const inputCorreo = document.querySelector(".inputCorreo");
  const inputContraseña = document.querySelector(".inputContraseña");
  const spanCorreoErr = document.querySelector(".spanErrCorreo");
  const spanContraseñaErr = document.querySelector(".spanErrContraseña");
  const buttonEntrar = document.querySelector(".btnEntrar");
  const spanErrorEntrada = document.querySelector(".spanErrorEntrada");
  const formEntrar = document.querySelector(".formInicioSesion");
  const ojoIconoA = document.querySelector(".ojoAbierto");
  const ojoIconoC = document.querySelector(".ojoCerrado");

  //Comprobando que los inputs no esten vacios antes de iniciar sesion
  inputCorreo.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputContraseña.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputCorreo.addEventListener("focus", () => {
    if (!inputCorreo.getAttribute("maxlength")) {
      inputCorreo.setAttribute("maxlength", "50");
    }
    spanErrorEntrada.textContent = "";
    spanCorreoErr.textContent = "";
    spanContraseñaErr.textContent = "";
  });

  inputContraseña.addEventListener("focus", () => {
    if (!inputContraseña.getAttribute("maxlength")) {
      inputContraseña.setAttribute("maxlength", "30");
    }
    spanErrorEntrada.textContent = "";
    spanCorreoErr.textContent = "";
    spanContraseñaErr.textContent = "";
  });

  buttonEntrar.addEventListener("click", (e) => {
    e.preventDefault();
    if (inputCorreo.value !== "" && inputContraseña.value !== "") {
      let correo = inputCorreo.value;
      let contraseña = inputContraseña.value;
      let url = "http://localhost/BizLab/consultarUsuario.php";

      let formUserLogin = new FormData();

      formUserLogin.append("correoUser", correo);
      formUserLogin.append("contraseñaUser", contraseña);
      formUserLogin.append("userVerifi", true);

      fetch(url, {
        method: "POST",
        body: formUserLogin,
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data[0]);
          console.log(data[1]);
          if (data[0] == 3) {
            spanErrorEntrada.innerHTML = `<span style="color: #f20; font-size:2rem">El usuario que ingresó NO Existe</span>`;
            spanCorreoErr.textContent = "";
            spanContraseñaErr.textContent = "";
          }
          if (data[0] == 2) {
            spanErrorEntrada.innerHTML = `<span style="color: #f20; font-size:2rem">La contraseña es Incorrecta</span>`;
            spanCorreoErr.textContent = "";
            spanContraseñaErr.textContent = "";
          }
          if (data[0] == 1) {
            spanErrorEntrada.innerHTML = `<span style="color: green; font-size:2rem">Ingresando...</span>`;
            spanCorreoErr.textContent = "";
            spanContraseñaErr.textContent = "";
            if (data[1] == 1) {
              setTimeout(() => {
                window.location.href = "administracion.php";
              }, 1200);
            } else {
              if (data[1] == 2) {
                setTimeout(() => {
                  window.location.href = "index.php";
                }, 1200);
              }
            }
          }
        })
        .catch((err) => console.log(err));
    } else {
      if (inputCorreo.value !== "" && inputContraseña.value == "") {
        spanCorreoErr.textContent = "";
        spanContraseñaErr.textContent = "Digite su contraseña";
      } else {
        if (inputCorreo.value == "" && inputContraseña.value !== "") {
          spanContraseñaErr.textContent = "";
          spanCorreoErr.textContent = "Digite su correo electrónico";
        } else {
          if (inputCorreo.value == "" && inputContraseña.value == "") {
            spanErrorEntrada.textContent = "Debe llenar los campos";
          }
        }
      }
    }
  });
  //Comprobando que los inputs no esten vacios antes de iniciar sesion

  //Boton mostrar/ocultar contraseña
  ojoIconoA.addEventListener("click", (e) => {
    if (ojoIconoA.classList.contains("ojoIconA")) {
      ojoIconoA.classList.replace("ojoIconA", "ojoIconA2");
      ojoIconoC.classList.replace("ojoIconC2", "ojoIconC");
      inputContraseña.removeAttribute("type");
      inputContraseña.setAttribute("type", "text");
    }
  });
  
  ojoIconoC.addEventListener("click", (e) => {
    if (ojoIconoC.classList.contains("ojoIconC")) {
      ojoIconoA.classList.replace("ojoIconA2", "ojoIconA");
      ojoIconoC.classList.replace("ojoIconC", "ojoIconC2");
      inputContraseña.removeAttribute("type");
      inputContraseña.setAttribute("type", "password");
    }
  });
  //Boton mostrar/ocultar contraseña
}

//-------------------------------
// <<-- Inicio Sesión - FIN -->>
//-------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------
// <<-- Registro - INICIO -->>
//-----------------------------

if (document.querySelector(".registroHTML") !== null) {
  //SELECCIONANDO OBJETOS DEL DOM (REGISTRO.PHP) - INICIO

  //INPUTS

  const nombreRegisInput = document.querySelector(".nombreRegisInput");
  const apellidoRegisInput = document.querySelector(".apellidoRegisInput");
  const documentoInput = document.querySelector(".documentoInput");
  const fechaNInputRegis = document.querySelector(".fechaNInputRegis");
  const telefonoInputRegis = document.querySelector(".telefonoInputRegis");
  const direccInputRegis = document.querySelector(".direccInputRegis");
  const inputSelectRol = document.querySelector("#inputSelectRol");

  const inputCorreo = document.querySelector(".inputCorreoMiembro");
  const correoAdminInput = document.querySelector(".correoAdminInput");

  const empresaInput = document.querySelector(".empresaInput");

  const inputContraseña = document.querySelector(".contraInputRegis");
  const inputContraConfir = document.querySelector(".inputContraConfir");
  const inputContraseña2 = document.querySelector(".contraInputRegis2");
  const inputContraConfir2 = document.querySelector(".inputContraConfir2");

  const inputNit = document.querySelector(".inputNIT");
  const inputCodigoAcce = document.querySelector(".inputCodigoAcce");

  //FORM INPUTS REGISTRO
  const inputNomM = document.querySelector(".nomM");
  const inputApeM = document.querySelector(".apeM");
  const inputDocuM = document.querySelector(".docuM");
  const inputFechaM = document.querySelector(".fechaM");
  const inputTelefM = document.querySelector(".telefM");
  const inputDireccM = document.querySelector(".dirrecM");
  const inputRolM = document.querySelector(".rolM");
  const inputCorreoM = document.querySelector(".correoM");
  const inputContraM = document.querySelector(".contraM");
  const inputEmpreM = document.querySelector(".empreM");
  const inputNitM = document.querySelector(".nitM");
  const inputCorreoA = document.querySelector(".correoA");
  const inputContraA = document.querySelector(".contraA");
  //----------------------------

  //BOTONES

  const btnSiguiente = document.querySelector(".btnSiguiente-1");

  const btnAtrasM = document.querySelector(".btnAtrasRegisFM");
  const btnAtrasA = document.querySelector(".btnAtrasRegisFA");

  const btnCancelarRegis1 = document.querySelector(".btnCancelRegisF1");
  const btnCancelarRegisM = document.querySelector(".btnCancelRegisFM");
  const btnCancelarRegisA = document.querySelector(".btnCancelRegisFA");

  const btnRegistrarseM = document.querySelector(".btnRegistrarseFM");
  const btnRegistrarseA = document.querySelector(".btnRegistrarseFA");

  const ojoIconoA = document.querySelector(".ojoAbierto");
  const ojoIconoC = document.querySelector(".ojoCerrado");

  const ojoIconoA_A = document.querySelector(".ojoAbiertoA");
  const ojoIconoC_A = document.querySelector(".ojoCerradoA");

  //FORMULARIOS

  const formRegisF1 = document.querySelector(".formRe1");
  const formRegisF2 = document.querySelector(".formRe2");
  const formRegisF3 = document.querySelector(".formRe3");
  const formRegistrarseM = document.querySelector("#formRegisMiembro");

  //SPAN

  const spanRegisPer = document.querySelector(".registroSpan2");

  const spanErrNombre = document.querySelector(".sparErrNombre");
  const spanErrApellido = document.querySelector(".sparErrApellido");
  const spanErrDocumento = document.querySelector(".sparErrDocumento");
  const spanErrNacimiento = document.querySelector(".sparErrNacimiento");
  const spanErrTelefono = document.querySelector(".sparErrTelefono");
  const spanErrDirecc = document.querySelector(".sparErrDireccion");
  const sparErrTipoUser = document.querySelector(".sparErrTipoUser");
  const spanErrCorreoMiembro = document.querySelector(".sparErrCorreo");
  const spanErrNit = document.querySelector(".spanErrNit");
  const spanErrCodigoAcc = document.querySelector(".spanErrCodigoAcc");
  const spanErrCorreoAdmi = document.querySelector(".spanErrCorreoAdmi");

  const contraNoCoincide = document.querySelector(".contraNoCoincide");
  const contraNoCoincideA = document.querySelector(".contraNoCoincide2");

  //SELECCIONANDO OBJETOS DEL DOM (REGISTRO.PHP) - FIN

  //
  //------------------------------------------------------------------------------
  //

  //VARIABLES GLOBALES

  var numeros = "0123456789 ";
  var numeros2 = "1234567890+ ";
  var numeros3 = "1234567890- ";
  var arroba = "@";
  var letras = "abcdefghijklmnñopqrstuvwxyz";

  //Array para verificar que los inputs tengan datos correctos (0=TRUE, 1=FALSE).
  //Si es FALSE, se desactivarán algunos botones.
  var erroneos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

  //
  //-----------------------------------------------------------------------------------------
  //

  //FUNCIONES

  //Funcion para bloquear botones "Registrarse", "Atras" y "Siguiente" basado
  //en la cantidad de errores representados como 1 en erroneos[]
  const desbloqBloqBoton = () => {
    let suma = 0;
    var estadoInputs = null;

    for (let i = 0; i < erroneos.length; i++) {
      suma = suma + erroneos[i];
    }

    if (suma != 0) {
      estadoInputs = false;
    } else {
      if (suma == 0) {
        estadoInputs = true;
      }
    }

    if (estadoInputs == false) {
      btnSiguiente.setAttribute("disabled", "");
      btnSiguiente.classList.replace("btnSigue-1", "btnSigue-2");

      btnRegistrarseM.setAttribute("disabled", "");
      btnRegistrarseM.classList.replace("btnRegistrarFM-1", "btnRegistrarFM-2");

      btnRegistrarseA.setAttribute("disabled", "");
      btnRegistrarseA.classList.replace("btnRegistrarFA-1", "btnRegistrarFA-2");

      btnAtrasM.setAttribute("disabled", "");
      btnAtrasM.classList.replace("btnAtrasFM-1", "btnAtrasFM-2");

      btnAtrasA.setAttribute("disabled", "");
      btnAtrasA.classList.replace("btnAtrasFA-1", "btnAtrasFA-2");
    } else {
      if (estadoInputs == true) {
        if (btnSiguiente.getAttribute("disabled") != null) {
          btnSiguiente.removeAttribute("disabled");
          btnSiguiente.classList.replace("btnSigue-2", "btnSigue-1");
        }

        if (btnAtrasM.getAttribute("disabled") != null) {
          btnAtrasM.removeAttribute("disabled");
          btnAtrasM.classList.replace("btnAtrasFM-2", "btnAtrasFM-1");
        }

        if (btnAtrasA.getAttribute("disabled") != null) {
          btnAtrasA.removeAttribute("disabled");
          btnAtrasA.classList.replace("btnAtrasFA-2", "btnAtrasFA-1");
        }

        if (btnRegistrarseM.getAttribute("disabled") != null) {
          btnRegistrarseM.removeAttribute("disabled");
          btnRegistrarseM.classList.replace(
            "btnRegistrarFM-2",
            "btnRegistrarFM-1"
          );
        }

        if (btnRegistrarseA.getAttribute("disabled") != null) {
          btnRegistrarseA.removeAttribute("disabled");
          btnRegistrarseA.classList.replace(
            "btnRegistrarFA-2",
            "btnRegistrarFA-1"
          );
        }
      }
    }

    console.log(erroneos);
    return estadoInputs;
  };

  const verificarErroneos = (indice, numero) => {
    erroneos[indice] = numero;
    desbloqBloqBoton();
  };

  const cambiarSpanRegistro = (numero) => {
    if (numero == 1) {
      spanRegisPer.textContent = "Datos Personales";
    }
    if (numero == 2) {
      spanRegisPer.textContent = "Datos del Nuevo Miembro";
    }
    if (numero == 3) {
      spanRegisPer.textContent = "Datos del Nuevo Administrador";
    }
  };

  //
  //-----------------------------------------------------------------------------------------
  //

  //EVENTOS

  //
  //NOMBRE INPUT (Registro.php)
  nombreRegisInput.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  nombreRegisInput.addEventListener("input", () => {
    let nombre = nombreRegisInput.value;
    let estNombre = null;

    if (nombre.length == 0) {
      spanErrNombre.textContent = "#";
      spanErrNombre.style.opacity = "0";

      verificarErroneos(0, 0);
    }
    if (nombre.length != 0) {
      for1: for (let i = 0; i < nombre.length; i++) {
        let letraActual = nombre.charAt(i).toLowerCase();
        for2: for (let e = 0; e < letras.length; e++) {
          if (letraActual == letras.charAt(e)) {
            estNombre = true;
            break for2;
          } else {
            estNombre = false;
          }
        }
        if (estNombre == false) {
          break for1;
        }
      }

      if (estNombre == false) {
        spanErrNombre.textContent =
          "No utilice números ni caracteres especiales";
        spanErrNombre.style.opacity = "1";

        verificarErroneos(0, 1);
      } else {
        if (estNombre == true) {
          spanErrNombre.textContent = "#";
          spanErrNombre.style.opacity = "0";

          verificarErroneos(0, 0);
        }
      }
    }
  });

  //
  //APELLIDO INPUT (Registro.php)
  apellidoRegisInput.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  apellidoRegisInput.addEventListener("input", (e) => {
    let apellido = apellidoRegisInput.value;
    let estApellido = null;

    if (apellido.length == 0) {
      spanErrApellido.textContent = "#";
      spanErrApellido.style.opacity = "0";

      verificarErroneos(1, 0);
    }

    if (apellido.length != 0) {
      for1: for (let i = 0; i < apellido.length; i++) {
        let letraActual = apellido.charAt(i).toLowerCase();

        for2: for (let e = 0; e < letras.length; e++) {
          if (letraActual == letras.charAt(e)) {
            estApellido = true;
            break for2;
          } else {
            estApellido = false;
          }
        }

        if (estApellido == false) {
          break for1;
        }
      }

      if (estApellido == false) {
        spanErrApellido.textContent =
          "No utilice números ni caracteres especiales";
        spanErrApellido.style.opacity = "1";

        verificarErroneos(1, 1);
      } else {
        if (estApellido == true) {
          spanErrApellido.textContent = "#";
          spanErrApellido.style.opacity = "0";

          verificarErroneos(1, 0);
        }
      }
    }
  });

  //
  //DOCUMENTO INPUT (Registro.php)
  documentoInput.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  //Verificar errores (Sin letras ni caracteres especiales)
  documentoInput.addEventListener("input", (e) => {
    let documento = documentoInput.value.trim();
    let estDocumento = null;

    if (documento.length == 0) {
      spanErrDocumento.textContent = "#";
      spanErrDocumento.style.opacity = "0";

      verificarErroneos(2, 0);
    }

    if (documento.length != 0) {
      if (documento.length < 7 || documento.length > 11) {
        spanErrDocumento.textContent = "Número de Documento inválido";
        spanErrDocumento.style.opacity = "1";

        verificarErroneos(2, 1);
      } else {
        for1: for (let i = 0; i < documento.length; i++) {
          let letraActual = documento.charAt(i).toLowerCase();

          for2: for (let e = 0; e < numeros.length; e++) {
            if (letraActual == numeros.charAt(e)) {
              estDocumento = true;
              break for2;
            } else {
              estDocumento = false;
            }
          }

          if (estDocumento == false) {
            break for1;
          }
        }

        if (estDocumento == false) {
          spanErrDocumento.textContent =
            "No utilice letras ni caracteres especiales";
          spanErrDocumento.style.opacity = "1";

          verificarErroneos(2, 1);
        } else {
          if (estDocumento == true) {
            spanErrDocumento.textContent = "#";
            spanErrDocumento.style.opacity = "0";

            verificarErroneos(2, 0);
          }
        }
      }
    }
  });

  //Comprobamos si existe un Documento similar en la base de datos
  //si es así, bloquear boton "Siguiente"
  documentoInput.addEventListener("input", (e) => {
    if (documentoInput.value.length != 0 && erroneos[2] == 0) {
      let documentTamanio = documentoInput.value;

      if (
        documentTamanio.length > 6 &&
        documentTamanio.length <= 11 &&
        documentTamanio.length != 0
      ) {
        let documentoComprobar = documentoInput.value;

        let url = "http://localhost/BizLab/consultarUsuario.php";

        let formDocumentoVerificar = new FormData();

        formDocumentoVerificar.append(
          "documentoExistencia",
          documentoComprobar
        );
        formDocumentoVerificar.append("userVerifi", true);

        fetch(url, {
          method: "POST",
          body: formDocumentoVerificar,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data == true) {
              spanErrDocumento.textContent = "El documento ya está registrado";
              spanErrDocumento.style.opacity = "1";
              verificarErroneos(3, 1);
            } else {
              if (data == false) {
                spanErrDocumento.textContent = "#";
                spanErrDocumento.style.opacity = "0";
                verificarErroneos(3, 0);
              }
            }
          })
          .catch((err) => console.log(err));
      }
    }
  });

  //
  //FECHA NACIMIENTO INPUT (Registro.php)
  fechaNInputRegis.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  //Verfificamos que la fecha de nacimiento sea lógica
  fechaNInputRegis.addEventListener("input", () => {
    let fecha = null;

    if (fechaNInputRegis.value != "") {
      fecha = fechaNInputRegis.value.trim();
    }

    let url = "http://localhost/BizLab/consultarUsuario.php";

    let formFechaVerificar = new FormData();

    formFechaVerificar.append("fechaVerificar", fecha);
    formFechaVerificar.append("userVerifi", true);

    fetch(url, {
      method: "POST",
      body: formFechaVerificar,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data == false) {
          spanErrNacimiento.textContent = "Digite su fecha de nacimiento";
          spanErrNacimiento.style.opacity = "1";

          verificarErroneos(4, 1);
        } else {
          if (data == true) {
            spanErrNacimiento.textContent = "#";
            spanErrNacimiento.style.opacity = "0";

            verificarErroneos(4, 0);
          }
        }
      })
      .catch((err) => console.log(err));
  });

  //
  //TELEFONO INPUT EVENTO (Registro.php) - INICIO
  telefonoInputRegis.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  telefonoInputRegis.addEventListener("input", (e) => {
    let telefono = telefonoInputRegis.value.trim();
    let estTelefono = null;

    if (telefono.length == 0) {
      spanErrTelefono.textContent = "#";
      spanErrTelefono.style.opacity = "0";

      verificarErroneos(5, 0);
    }

    if (telefono.length != 0) {
      for1: for (let i = 0; i < telefono.length; i++) {
        let letraActual = telefono.charAt(i);

        for2: for (let e = 0; e < numeros2.length; e++) {
          if (letraActual == numeros2.charAt(e)) {
            estTelefono = true;
            break for2;
          } else {
            estTelefono = false;
          }
        }

        if (estTelefono == false) {
          break for1;
        }
      }

      if (estTelefono == false) {
        spanErrTelefono.textContent =
          "No utilice letras ni caracteres especiales";
        spanErrTelefono.style.opacity = "1";

        verificarErroneos(5, 1);
      } else {
        if (estTelefono == true) {
          spanErrTelefono.textContent = "#";
          spanErrTelefono.style.opacity = "0";

          verificarErroneos(5, 0);
        }
      }
    }
  });

  //Comprobamos si existe un número de teléfono similar en la base de datos
  //si es así, bloquear boton "Siguiente"
  telefonoInputRegis.addEventListener("input", (e) => {
    if (erroneos[5] == 0 && telefonoInputRegis.value.length != 0) {
      let telefonoExistente = telefonoInputRegis.value;

      let url = "http://localhost/BizLab/consultarUsuario.php";

      let formTelefVerificar = new FormData();

      formTelefVerificar.append("telefExistencia", telefonoExistente);
      formTelefVerificar.append("userVerifi", true);

      fetch(url, {
        method: "POST",
        body: formTelefVerificar,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data == true) {
            spanErrTelefono.textContent = "Este número ya está registrado";
            spanErrTelefono.style.opacity = "1";
            verificarErroneos(6, 1);
          } else {
            if (data == false) {
              spanErrTelefono.textContent = "#";
              spanErrTelefono.style.opacity = "0";
              verificarErroneos(6, 0);
            }
          }
        })
        .catch((err) => console.log(err));
    }
  });

  //
  //DIRECCIÓN INPUT (Registro.php)
  direccInputRegis.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  direccInputRegis.addEventListener("input", (e) => {
    let direccion = direccInputRegis.value;

    if (direccion.length == 0) {
      spanErrDirecc.textContent = "#";
      spanErrDirecc.style.opacity = "0";

      verificarErroneos(7, 0);
    } else {
      if (direccion.length < 10) {
        spanErrDirecc.textContent = "La dirección es muy corta";
        spanErrDirecc.style.opacity = "1";

        verificarErroneos(7, 1);
      } else {
        if (direccion.length > 10) {
          spanErrDirecc.textContent = "#";
          spanErrDirecc.style.opacity = "0";

          verificarErroneos(7, 0);
        }
      }
    }
  });

  //
  //TIPO MIEMBRO SELECT (Registro.php)
  inputSelectRol.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputSelectRol.addEventListener("input", () => {
    let seleccion = inputSelectRol.options[inputSelectRol.selectedIndex].text;

    if (seleccion == "Miembro Común" || seleccion == "Administrador") {
      verificarErroneos(8, 0);
      sparErrTipoUser.style.opacity = "0";
      sparErrTipoUser.textContent = "#";
    } else {
      verificarErroneos(8, 1);
      sparErrTipoUser.textContent = "Rol inválido";
      sparErrTipoUser.style.opacity = "1";
    }
  });

  //
  //MIEMBRO INPUT CORREO (Registro.php)
  inputCorreo.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputCorreo.addEventListener("input", (e) => {
    let correo = inputCorreo.value;
    let arrobaNumber = 0;
    let estCorreo = null;

    if (correo.length == 0) {
      spanErrCorreoMiembro.textContent = "#";
      spanErrCorreoMiembro.style.opacity = "0";

      verificarErroneos(9, 0);
    }

    if (correo.length != 0) {
      for (let i = 0; i < correo.length; i++) {
        if (correo.charAt(i) == "@") {
          arrobaNumber++;
        }
      }

      if (arrobaNumber != 1) {
        estCorreo = false;
      } else {
        estCorreo = true;
      }

      if (estCorreo == false) {
        spanErrCorreoMiembro.textContent = "El correo es inválido";
        spanErrCorreoMiembro.style.opacity = "1";

        verificarErroneos(9, 1);
      } else {
        if (estCorreo == true) {
          spanErrCorreoMiembro.textContent = "#";
          spanErrCorreoMiembro.style.opacity = "0";

          verificarErroneos(9, 0);
        }
      }
    }
  });

  inputCorreo.addEventListener("input", () => {
    if (erroneos[9] == 0 && inputCorreo.value.length != 0) {
      let correoExistente = inputCorreo.value;

      let url = "http://localhost/BizLab/consultarUsuario.php";

      let formCorreoVerificar = new FormData();

      formCorreoVerificar.append("correoExistencia", correoExistente);
      formCorreoVerificar.append("userVerifi", true);

      fetch(url, {
        method: "POST",
        body: formCorreoVerificar,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data == true) {
            spanErrCorreoMiembro.textContent = "Este correo ya está en uso";
            spanErrCorreoMiembro.style.opacity = "1";
            verificarErroneos(10, 1);
          } else {
            if (data == false) {
              spanErrCorreoMiembro.textContent = "#";
              spanErrCorreoMiembro.style.opacity = "0";
              verificarErroneos(10, 0);
            }
          }
        })
        .catch((err) => console.log(err));
    }
  });

  //
  //ADMIN INPUT CORREO (Registro.php)
  correoAdminInput.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  correoAdminInput.addEventListener("input", (e) => {
    let correoA = correoAdminInput.value;
    let arrobaNumber = 0;
    let estCorreoA = null;

    if (correoA.length == 0) {
      spanErrCorreoAdmi.textContent = "#";
      spanErrCorreoAdmi.style.opacity = "0";

      desbloqBloqBoton();
    }

    if (correoA.length != 0) {
      for (let i = 0; i < correoA.length; i++) {
        if (correoA.charAt(i) == "@") {
          arrobaNumber += 1;
        }
      }

      if (arrobaNumber != 1) {
        estCorreoA = false;
      } else {
        estCorreoA = true;
      }

      if (estCorreoA == false) {
        spanErrCorreoAdmi.textContent = "El correo es inválido";
        spanErrCorreoAdmi.style.opacity = "1";

        verificarErroneos(11, 1);
      } else {
        if (estCorreoA == true) {
          spanErrCorreoAdmi.textContent = "#";
          spanErrCorreoAdmi.style.opacity = "0";

          verificarErroneos(11, 0);
        }
      }
    }
  });

  //Comprobamos si existe un correo similar en la base de datos
  //si es así, bloquear boton "Siguiente"
  correoAdminInput.addEventListener("input", () => {
    if (erroneos[11] == 0 && correoAdminInput.value.length != 0) {
      let correoAdminExis = correoAdminInput.value;

      let url = "http://localhost/BizLab/consultarUsuario.php";

      let formCorreoAVerifi = new FormData();

      formCorreoAVerifi.append("correoExisteAdmin", correoAdminExis);
      formCorreoAVerifi.append("userVerifi", true);

      fetch(url, {
        method: "POST",
        body: formCorreoAVerifi,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data == true) {
            spanErrCorreoAdmi.textContent = "Este correo ya está en uso";
            spanErrCorreoAdmi.style.opacity = "1";
            verificarErroneos(12, 1);
          } else {
            if (data == false) {
              spanErrCorreoAdmi.textContent = "#";
              spanErrCorreoAdmi.style.opacity = "0";
              verificarErroneos(12, 0);
            }
          }
        })
        .catch((err) => console.log(err));
    }
  });

  //
  //INPUT CONTRASEÑA (Registro.php)
  inputContraseña.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputContraseña.addEventListener("input", () => {
    let valor1 = inputContraseña.value.trim();
    let valor2 = inputContraConfir.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(13, 0);
      verificarErroneos(14, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != valor2 && valor1.length >= 9) {
      contraNoCoincide.textContent = "Las contraseñas NO coinciden";
      contraNoCoincide.style.opacity = "1";

      verificarErroneos(13, 1);
      verificarErroneos(14, 1);
    } else {
      if (valor1 != valor2 && valor1.length < 9) {
        contraNoCoincide.textContent = "La contraseña es muy corta";
        contraNoCoincide.style.opacity = "1";

        verificarErroneos(13, 1);
        verificarErroneos(14, 1);
      } else {
        if (valor1 == valor2 && valor1.length >= 9) {
          contraNoCoincide.textContent = "#";
          contraNoCoincide.style.opacity = "0";

          verificarErroneos(13, 0);
          verificarErroneos(14, 0);
        }
      }
    }
  });

  inputContraConfir.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputContraConfir.addEventListener("input", () => {
    let valor1 = inputContraseña.value.trim();
    let valor2 = inputContraConfir.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(13, 0);
      verificarErroneos(14, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != valor2 && valor1.length >= 9) {
      contraNoCoincide.textContent = "Las contraseñas NO coinciden";
      contraNoCoincide.style.opacity = "1";

      verificarErroneos(13, 1);
      verificarErroneos(14, 1);
    } else {
      if (valor1 != valor2 && valor1.length < 9) {
        contraNoCoincide.textContent = "La contraseña es muy corta";
        contraNoCoincide.style.opacity = "1";

        verificarErroneos(13, 1);
        verificarErroneos(14, 1);
      } else {
        if (valor1 == valor2 && valor1.length >= 9) {
          contraNoCoincide.textContent = "#";
          contraNoCoincide.style.opacity = "0";

          verificarErroneos(13, 0);
          verificarErroneos(14, 0);
        }
      }
    }
  });

  //
  //INPUT CONTRASEÑA ADMIN (Registro.php)
  inputContraseña2.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputContraseña2.addEventListener("input", () => {
    let valor1 = inputContraseña2.value.trim();
    let valor2 = inputContraConfir2.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(15, 0);
      verificarErroneos(16, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != valor2 && valor1.length >= 9) {
      contraNoCoincideA.textContent = "Las contraseñas NO coinciden";
      contraNoCoincideA.style.opacity = "1";

      verificarErroneos(15, 1);
      verificarErroneos(16, 1);
    } else {
      if (valor1 != valor2 && valor1.length < 9) {
        contraNoCoincideA.textContent = "La contraseña es muy corta";
        contraNoCoincideA.style.opacity = "1";

        verificarErroneos(15, 1);
        verificarErroneos(16, 1);
      } else {
        if (valor1 == valor2 && valor1.length >= 9) {
          contraNoCoincideA.textContent = "#";
          contraNoCoincideA.style.opacity = "0";

          verificarErroneos(15, 0);
          verificarErroneos(16, 0);
        }
      }
    }
  });

  inputContraConfir2.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputContraConfir2.addEventListener("input", () => {
    let valor1 = inputContraseña2.value.trim();
    let valor2 = inputContraConfir2.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(15, 0);
      verificarErroneos(16, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != "" && valor2 != "") {
      if (valor1 != valor2 && valor1.length >= 9) {
        contraNoCoincideA.textContent = "Las contraseñas NO coinciden";
        contraNoCoincideA.style.opacity = "1";

        verificarErroneos(15, 1);
        verificarErroneos(16, 1);
      } else {
        if (valor1 != valor2 && valor1.length < 9) {
          contraNoCoincideA.textContent = "La contraseña es muy corta";
          contraNoCoincideA.style.opacity = "1";

          verificarErroneos(15, 1);
          verificarErroneos(16, 1);
        } else {
          if (valor1 == valor2 && valor1.length >= 9) {
            contraNoCoincideA.textContent = "#";
            contraNoCoincideA.style.opacity = "0";

            verificarErroneos(15, 0);
            verificarErroneos(16, 0);
          }
        }
      }
    }
  });

  //
  //INPUT EMPRESA
  empresaInput.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  //
  //INPUT NIT (Registro.php)
  inputNit.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  inputNit.addEventListener("input", (e) => {
    let nit = inputNit.value.trim();
    let estNit = null;

    if (nit.length == 0) {
      spanErrNit.textContent = "#";
      spanErrNit.style.opacity = "0";

      verificarErroneos(17, 0);
    }

    if (nit.length != 0) {
      for1: for (let i = 0; i < nit.length; i++) {
        let letraActual = nit.charAt(i);

        for2: for (let e = 0; e < numeros3.length; e++) {
          if (letraActual == numeros3.charAt(e)) {
            estNit = true;
            break for2;
          } else {
            estNit = false;
          }
        }

        if (estNit == false) {
          break for1;
        }
      }

      if (estNit == false) {
        spanErrNit.textContent = "No use letras ni caracteres especiales";
        spanErrNit.style.opacity = "1";

        verificarErroneos(17, 1);
      } else {
        if (estNit == true) {
          spanErrNit.textContent = "#";
          spanErrNit.style.opacity = "0";

          verificarErroneos(17, 0);
        }
      }
    }
  });

  //
  //INPUT CODIGO DE ACCESO (Registro.php)
  inputCodigoAcce.addEventListener("keypress", (e) => {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  //
  //--------------------------------------------------------------------------
  //

  btnSiguiente.addEventListener("click", (e) => {
    console.log("Boton Siguiente Tocado");
    e.preventDefault();
    if (
      nombreRegisInput.value == "" ||
      nombreRegisInput.value == null ||
      apellidoRegisInput.value == "" ||
      apellidoRegisInput.value == null ||
      documentoInput.value == "" ||
      documentoInput.value == null ||
      fechaNInputRegis.value == "" ||
      fechaNInputRegis.value == null ||
      telefonoInputRegis.value == "" ||
      telefonoInputRegis.value == null ||
      direccInputRegis.value == "" ||
      direccInputRegis.value == null ||
      (inputSelectRol.options[inputSelectRol.selectedIndex].text !=
        "Miembro Común" &&
        inputSelectRol.options[inputSelectRol.selectedIndex].text !=
          "Administrador")
    ) {
      sparErrTipoUser.textContent = "Debe llenar los campos";
      sparErrTipoUser.style.opacity = "1";
      console.log("Boton Siguiente Vacios Bloqueados");
    } else {
      if (sparErrTipoUser.textContent == "Debe llenar los campos") {
        sparErrTipoUser.textContent = "#";
        sparErrTipoUser.style.opacity = "0";
      }
      if (
        nombreRegisInput.value != "" &&
        apellidoRegisInput.value != "" &&
        documentoInput.value !== "" &&
        fechaNInputRegis.value !== "" &&
        telefonoInputRegis.value !== "" &&
        direccInputRegis.value !== "" &&
        inputSelectRol.options[inputSelectRol.selectedIndex].text ==
          "Miembro Común"
      ) {
        if (formRegisF1.classList.contains("formRegisF1")) {
          formRegisF1.classList.replace("formRegisF1", "formRegisF1B");
          if (!formRegisF2.classList.contains("formRegisF2")) {
            formRegisF2.classList.replace("formRegisF2B", "formRegisF2");
          }
          posicionFormRegis = 2;
          cambiarSpanRegistro(posicionFormRegis);
          window.scroll({
            top: 0,
            left: 0,
            behavior: "smooth",
          });
        }
        btnAtrasM.addEventListener("click", (e) => {
          e.preventDefault();
          posicionFormRegis = 1;
          cambiarSpanRegistro(posicionFormRegis);
          if (formRegisF1.classList.contains("formRegisF1B")) {
            formRegisF1.classList.replace("formRegisF1B", "formRegisF1");
            if (!formRegisF2.classList.contains("formRegisF2B")) {
              formRegisF2.classList.replace("formRegisF2", "formRegisF2B");
            }
          }
        });
        btnAtrasA.addEventListener("click", (e) => {
          e.preventDefault();
          posicionFormRegis = 1;
          cambiarSpanRegistro(posicionFormRegis);
          if (formRegisF1.classList.contains("formRegisF1B")) {
            formRegisF1.classList.replace("formRegisF1B", "formRegisF1");
            if (!formRegisF3.classList.contains("formRegisF3B")) {
              formRegisF3.classList.replace("formRegisF3", "formRegisF3B");
            }
          }
        });
      }
      if (
        nombreRegisInput.value != "" &&
        apellidoRegisInput.value != "" &&
        documentoInput.value !== "" &&
        fechaNInputRegis.value !== "" &&
        telefonoInputRegis.value !== "" &&
        direccInputRegis.value !== "" &&
        inputSelectRol.options[inputSelectRol.selectedIndex].text ==
          "Administrador"
      ) {
        if (formRegisF1.classList.contains("formRegisF1")) {
          formRegisF1.classList.replace("formRegisF1", "formRegisF1B");
          if (!formRegisF3.classList.contains("formRegisF3")) {
            formRegisF3.classList.replace("formRegisF3B", "formRegisF3");
          }
          posicionFormRegis = 3;
          cambiarSpanRegistro(posicionFormRegis);
          window.scroll({
            top: 0,
            left: 0,
            behavior: "smooth",
          });
        }
        btnAtrasA.addEventListener("click", (e) => {
          e.preventDefault();
          posicionFormRegis = 1;
          cambiarSpanRegistro(posicionFormRegis);
          if (formRegisF1.classList.contains("formRegisF1B")) {
            formRegisF1.classList.replace("formRegisF1B", "formRegisF1");
            if (!formRegisF3.classList.contains("formRegisF3B")) {
              formRegisF3.classList.replace("formRegisF3", "formRegisF3B");
            }
          }
        });
      }
    }
  });

  btnRegistrarseM.addEventListener("click", (e) => {
    e.preventDefault();
    var estadoBTN = desbloqBloqBoton();
    if (
      inputCorreo.value == "" ||
      inputCorreo.value == null ||
      inputContraseña.value == "" ||
      inputContraseña.value == null ||
      inputContraConfir.value == "" ||
      inputContraConfir.value == null ||
      empresaInput.value == "" ||
      empresaInput.value == null ||
      inputNit.value == "" ||
      inputNit.value == null
    ) {
      spanErrNit.textContent = "Debe llenar los campos";
      spanErrNit.style.opacity = "1";
      console.log("Boton Registrarse Vacios Bloqueados");
    } else {
      console.log("Boton Registrarse Tocado");
      if (estadoBTN != false) {
        console.log(estadoBTN);
        spanErrNit.textContent = "Redireccionando...";
        spanErrNit.classList.replace("spanErr", "spanRegisAdminExito");
        spanErrNit.style.opacity = "1";

        inputNomM.value = nombreRegisInput.value;
        inputApeM.value = apellidoRegisInput.value;
        inputDocuM.value = documentoInput.value;
        inputFechaM.value = fechaNInputRegis.value;
        inputTelefM.value = telefonoInputRegis.value;
        inputDireccM.value = direccInputRegis.value;
        inputRolM.value =
          inputSelectRol.options[inputSelectRol.selectedIndex].text;
        inputCorreoM.value = inputCorreo.value;
        inputContraM.value = inputContraseña.value;
        inputEmpreM.value = empresaInput.value;
        inputNitM.value = inputNit.value;
        inputCorreoA.value = correoAdminInput.value;
        inputContraA.value = inputContraseña2.value;

        nombreRegisInput.value = "";
        apellidoRegisInput.value = "";
        documentoInput.value = "";
        fechaNInputRegis.value = "";
        telefonoInputRegis.value = "";
        direccInputRegis.value = "";
        inputSelectRol.value = "";
        inputCorreo.value = "";
        correoAdminInput.value = "";
        empresaInput.value = "";
        inputContraseña.value = "";
        inputContraConfir.value = "";
        inputContraseña2.value = "";
        inputContraConfir2.value = "";
        inputNit.value = "";
        inputCodigoAcce.value = "";
        correoAdminInput.value = "";
        inputContraseña2.value = "";

        formRegistrarseM.submit();
      }
    }
  });

  btnRegistrarseA.addEventListener("click", (e) => {
    e.preventDefault();
    if (
      correoAdminInput.value == "" ||
      correoAdminInput.value == null ||
      inputContraseña2.value == "" ||
      inputContraseña2.value == null ||
      inputContraConfir2.value == "" ||
      inputContraConfir2.value == null ||
      inputCodigoAcce.value == "" ||
      inputCodigoAcce.value == null
    ) {
      spanErrCodigoAcc.textContent = "Debe llenar los campos";
      spanErrCodigoAcc.style.opacity = "1";
      console.log("Boton Registrarse Admin Vacios Bloqueados");
    } else {
      console.log("Boton Registrarse Admin Tocado");
      estadoBTNA = desbloqBloqBoton();

      if (estadoBTNA != false) {
        let codAcceso = inputCodigoAcce.value.trim();
        let url = "http://localhost/BizLab/consultarUsuario.php";

        let formRegisAdmin = new FormData();

        formRegisAdmin.append("codigoAcceso", codAcceso);
        formRegisAdmin.append("userVerifi", true);

        fetch(url, {
          method: "POST",
          body: formRegisAdmin,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data == null) {
              e.preventDefault();
              spanErrCodigoAcc.textContent =
                "El código es incorrecto, intente de nuevo";
              spanErrCodigoAcc.style.opacity = "1";
            } else {
              if (data != null) {
                e.preventDefault();

                inputNomM.value = nombreRegisInput.value;
                inputApeM.value = apellidoRegisInput.value;
                inputDocuM.value = documentoInput.value;
                inputFechaM.value = fechaNInputRegis.value;
                inputTelefM.value = telefonoInputRegis.value;
                inputDireccM.value = direccInputRegis.value;
                inputRolM.value =
                  inputSelectRol.options[inputSelectRol.selectedIndex].text;
                inputCorreoM.value = inputCorreo.value;
                inputContraM.value = inputContraseña.value;
                inputEmpreM.value = empresaInput.value;
                inputNitM.value = inputNit.value;
                inputCorreoA.value = correoAdminInput.value;
                inputContraA.value = inputContraseña2.value;

                nombreRegisInput.value = "";
                apellidoRegisInput.value = "";
                documentoInput.value = "";
                fechaNInputRegis.value = "";
                telefonoInputRegis.value = "";
                direccInputRegis.value = "";
                inputSelectRol.value = "";
                inputCorreo.value = "";
                correoAdminInput.value = "";
                empresaInput.value = "";
                inputContraseña.value = "";
                inputContraConfir.value = "";
                inputContraseña2.value = "";
                inputContraConfir2.value = "";
                inputNit.value = "";
                inputCodigoAcce.value = "";
                correoAdminInput.value = "";
                inputContraseña2.value = "";

                formRegistrarseM.submit();

                // let nombre = nombreRegisInput.value;
                // let apellidos = apellidoRegisInput.value;
                // let documento = documentoInput.value;
                // let fechaNacimiento = fechaNInputRegis.value;
                // let telefono = telefonoInputRegis.value;
                // let direccion = direccInputRegis.value;
                // let rol =
                //   inputSelectRol.options[inputSelectRol.selectedIndex].text;
                // let correo = correoAdminInput.value;
                // let contrasenia = inputContraseña2.value;
                // var ultimoAdminRegistrado = 0;

                // let formRegisAdmin = new FormData();

                // formRegisAdmin.append("nombreAdmin", nombre);
                // formRegisAdmin.append("apellidoAdmin", apellidos);
                // formRegisAdmin.append("documentoAdmin", documento);
                // formRegisAdmin.append("fechaNAdmin", fechaNacimiento);
                // formRegisAdmin.append("telefonoAdmin", telefono);
                // formRegisAdmin.append("direccAdmin", direccion);
                // formRegisAdmin.append("rolAdmin", rol);
                // formRegisAdmin.append("correoAdmin", correo);
                // formRegisAdmin.append("contraseniaAdmin", contrasenia);
                // formRegisAdmin.append("empresaAdmin", "");
                // formRegisAdmin.append("nitAdmin", 0);
                // formRegisAdmin.append("userVerifi", true);

                // fetch("http://localhost/BizLab/consultarUsuario.php", {
                //   method: "POST",
                //   body: formRegisAdmin,
                // })
                //   .then((response) => response.json())
                //   .then((data) => {
                //     ultimoAdminRegistrado = data;
                //     console.log(ultimoAdminRegistrado);

                //     btnRegistrarseA.setAttribute("disabled", "");
                //     btnRegistrarseA.classList.replace(
                //       "btnRegistrarFA-1",
                //       "btnRegistrarFA-2"
                //     );

                //     btnAtrasA.setAttribute("disabled", "");
                //     btnAtrasA.classList.replace("btnAtrasFA-1", "btnAtrasFA-2");

                //     document
                //       .querySelector(".btnCancelRegisFA")
                //       .setAttribute("disabled", "");
                //     document
                //       .querySelector(".btnCancelRegisFA")
                //       .classList.replace("btnCancelarFA-1", "btnCancelarFA-2");

                //     nombreRegisInput.value = "";
                //     apellidoRegisInput.value = "";
                //     documentoInput.value = "";
                //     fechaNInputRegis.value = "";
                //     telefonoInputRegis.value = "";
                //     direccInputRegis.value = "";
                //     inputSelectRol.value = "";
                //     inputCorreo.value = "";
                //     correoAdminInput.value = "";
                //     empresaInput.value = "";
                //     inputContraseña.value = "";
                //     inputContraConfir.value = "";
                //     inputContraseña2.value = "";
                //     inputContraConfir2.value = "";
                //     inputNit.value = "";
                //     inputCodigoAcce.value = "";

                //     setTimeout(() => {
                //       window.location.href = "index.php";
                //     }, 1200);
                //   })
                //   .catch((err) => console.log(err));

                // spanErrCodigoAcc.textContent = "Registrando...";
                // spanErrCodigoAcc.classList.replace(
                //   "spanErr",
                //   "spanRegisAdminExito"
                // );
              }
            }
          })
          .catch((err) => console.log(err));
      }
    }
  });

  btnCancelarRegis1.addEventListener("click", (e) => {
    e.preventDefault();
    nombreRegisInput.value = "";
    apellidoRegisInput.value = "";
    documentoInput.value = "";
    fechaNInputRegis.value = "";
    telefonoInputRegis.value = "";
    direccInputRegis.value = "";
    inputSelectRol.value = "";
    inputCorreo.value = "";
    correoAdminInput.value = "";
    inputContraseña.value = "";
    inputContraConfir.value = "";
    inputContraseña2.value = "";
    inputContraConfir2.value = "";
    empresaInput.value = "";
    inputNit.value = "";
    inputCodigoAcce.value = "";
    window.location.href = "index.php";
  });

  btnCancelarRegisM.addEventListener("click", (e) => {
    e.preventDefault();
    nombreRegisInput.value = "";
    apellidoRegisInput.value = "";
    documentoInput.value = "";
    fechaNInputRegis.value = "";
    telefonoInputRegis.value = "";
    direccInputRegis.value = "";
    inputSelectRol.value = "";
    inputCorreo.value = "";
    correoAdminInput.value = "";
    inputContraseña.value = "";
    inputContraConfir.value = "";
    inputContraseña2.value = "";
    inputContraConfir2.value = "";
    empresaInput.value = "";
    inputNit.value = "";
    inputCodigoAcce.value = "";
    window.location.href = "index.php";
  });

  btnCancelarRegisA.addEventListener("click", (e) => {
    e.preventDefault();
    nombreRegisInput.value = "";
    apellidoRegisInput.value = "";
    documentoInput.value = "";
    fechaNInputRegis.value = "";
    telefonoInputRegis.value = "";
    direccInputRegis.value = "";
    inputSelectRol.value = "";
    inputCorreo.value = "";
    correoAdminInput.value = "";
    inputContraseña.value = "";
    inputContraConfir.value = "";
    inputContraseña2.value = "";
    inputContraConfir2.value = "";
    empresaInput.value = "";
    inputNit.value = "";
    inputCodigoAcce.value = "";
    window.location.href = "index.php";
  });

  //
  //--------------------------------------------------------------------------
  //

  ojoIconoA.addEventListener("click", (e) => {
    if (ojoIconoA.classList.contains("ojoIconA")) {
      ojoIconoA.classList.replace("ojoIconA", "ojoIconA2");
      ojoIconoC.classList.replace("ojoIconC2", "ojoIconC");
      inputContraseña.removeAttribute("type");
      inputContraseña.setAttribute("type", "text");
      inputContraConfir.removeAttribute("type");
      inputContraConfir.setAttribute("type", "text");
    }
  });

  ojoIconoC.addEventListener("click", (e) => {
    if (ojoIconoC.classList.contains("ojoIconC")) {
      ojoIconoA.classList.replace("ojoIconA2", "ojoIconA");
      ojoIconoC.classList.replace("ojoIconC", "ojoIconC2");
      inputContraseña.removeAttribute("type");
      inputContraseña.setAttribute("type", "password");
      inputContraConfir.removeAttribute("type");
      inputContraConfir.setAttribute("type", "password");
    }
  });

  ojoIconoA_A.addEventListener("click", (e) => {
    if (ojoIconoA_A.classList.contains("ojoIconAAdmi")) {
      ojoIconoA_A.classList.replace("ojoIconAAdmi", "ojoIconA2Admi");
      ojoIconoC_A.classList.replace("ojoIconC2Admi", "ojoIconCAdmi");
      inputContraseña2.removeAttribute("type");
      inputContraseña2.setAttribute("type", "text");
      inputContraConfir2.removeAttribute("type");
      inputContraConfir2.setAttribute("type", "text");
    }
  });

  ojoIconoC_A.addEventListener("click", (e) => {
    if (ojoIconoC_A.classList.contains("ojoIconCAdmi")) {
      ojoIconoA_A.classList.replace("ojoIconA2Admi", "ojoIconAAdmi");
      ojoIconoC_A.classList.replace("ojoIconCAdmi", "ojoIconC2Admi");
      inputContraseña2.removeAttribute("type");
      inputContraseña2.setAttribute("type", "password");
      inputContraConfir2.removeAttribute("type");
      inputContraConfir2.setAttribute("type", "password");
    }
  });

  //
  //--------------------------------------------------------------------------
  //
}

//---------------------------
// <<-- Registro - FIN -->>
//---------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------
// <<-- recuperarContraseña.php - INICIO -->>
//--------------------------------------------

if (document.querySelector(".recuvaContraHTML") !== null) {
  //SELECION OBJETOS DEL DOM
  //

  //CONTENEDORES
  const form2Contenedor = document.querySelector(".conteForm2");

  //FORM
  const formCambioPassConfir = document.querySelector("#formCambioPassConfir");

  //INPUTS
  const correoInput = document.querySelector(".correoExisRecuInput");
  const codigoInput = document.querySelector(".codigoInput");
  const inputOConfirmado = document.querySelector(".esend");

  //SPAN
  const spanErrCorreo = document.querySelector(".spanErrCorreo1");
  const spanErrCodigo = document.querySelector(".spanErrCodigo");
  const spanCorreoEnviar = document.querySelector(".spanCorreo2");

  //BOTONES
  const btnCancelar = document.querySelector(".btnCancelar");
  const btnEnviar = document.querySelector(".btnEnviar");
  const btnVerifCodi = document.querySelector(".btnCodiVerif");
  const aReenviarCodigo = document.querySelector(".reenviarA");

  //
  //SELECION OBJETOS DEL DOM

  //

  //EVENTOS
  //

  correoInput.addEventListener("input", (e) => {
    var correo = correoInput.value;
    var url = "http://localhost/BizLab/consultarUsuario.php";

    if (correo.length != 0) {
      let formCorreoRecuContra = new FormData();

      formCorreoRecuContra.append("correoRecuContra", correo);
      formCorreoRecuContra.append("userVerifi", true);

      fetch(url, {
        method: "POST",
        body: formCorreoRecuContra,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data == true) {
            spanErrCorreo.textContent = "Correo Encontrado";
            spanErrCorreo.style.color = "#2d0";
            spanErrCorreo.style.opacity = "1";
            btnEnviar.classList.replace("btnEnv1", "btnEnv2");
            btnEnviar.removeAttribute("disabled");
          } else {
            if (data == false) {
              spanErrCorreo.textContent = "El Correo NO existe";
              spanErrCorreo.style.opacity = "1";
              spanErrCorreo.style.color = "#f30";
              if (btnEnviar.removeAttribute("disabled") == null) {
                btnEnviar.setAttribute("disabled", "");
                btnEnviar.classList.replace("btnEnv2", "btnEnv1");
              }
            }
          }
        })
        .catch((err) => console.log(err));
    } else {
      spanErrCorreo.textContent = "#";
      spanErrCorreo.style.opacity = "0";
      btnCancelar.classList.replace("btnCancelar1", "btnCancelar2");
      if (btnEnviar.removeAttribute("disabled") == null) {
        btnEnviar.setAttribute("disabled", "");
        btnEnviar.classList.replace("btnEnv2", "btnEnv1");
      }
    }
  });

  btnEnviar.addEventListener("click", (e) => {
    e.preventDefault();

    if (correoInput.value.trim() != "") {
      btnEnviar.setAttribute("disabled", "");
      btnEnviar.classList.replace("btnEnv2", "btnEnv1");

      btnCancelar.setAttribute("disabled", "");
      btnCancelar.classList.replace("btnCan1", "btnCan2");

      let correo = correoInput.value.trim();
      let url = "http://localhost/BizLab/enviarContraRecu.php";
      var cod = "";

      let formRecuContra = new FormData();

      formRecuContra.append("correoUser", correo);
      formRecuContra.append("send", true);

      fetch(url, {
        method: "POST",
        body: formRecuContra,
      })
        .then((response) => response.json())
        .then((data) => {
          
          cod = data;
          btnVerifCodi.addEventListener(
            "click",
            (funcionEnv1 = (e) => {
              e.preventDefault();
              console.log("boton codigo verificar tocado");
              let codigo = codigoInput.value;

              if (cod != codigo && codigo.length != 0) {
                spanErrCodigo.textContent =
                  "El código es incorrecto, intente de nuevo";
                spanErrCodigo.style.opacity = "1";
              } else {
                if (cod == codigo && codigo.length != 0) {
                  spanErrCodigo.textContent = "#";
                  spanErrCodigo.style.opacity = "0";
                  cod = "";
                  codigoInput.value = "";
                  correoInput.value = "";
                  console.log("te fuiste por el boton normal");
                  inputOConfirmado.value = spanCorreoEnviar.textContent;
                  document.getElementById("formCambioPassConfir").submit();
                }
              }
            })
          );

          aReenviarCodigo.addEventListener("click", (e) => {
            cod = "";
            btnVerifCodi.removeEventListener("click", funcionEnv1);
            console.log("boton codigo REENVIAR tocado");
            btnVerifCodi.setAttribute("disabled", "");
            let correo = correoInput.value.trim();
            let url = "http://localhost/BizLab/enviarContraRecu.php";

            let formRecuContraRe = new FormData();

            formRecuContraRe.append("correoUser", correo);
            formRecuContraRe.append("send", true);

            fetch(url, {
              method: "POST",
              body: formRecuContraRe,
            })
              .then((response) => response.json())
              .then((data) => {
                cod = data;
                btnVerifCodi.removeAttribute("disabled");
                btnVerifCodi.addEventListener("click", (e) => {
                  e.preventDefault();

                  console.log("boton codigo verificar tocado");
                  let codigo = codigoInput.value;

                  if (data != codigo && codigo.length != 0) {
                    spanErrCodigo.textContent =
                      "El código es incorrecto, intente de nuevo";
                    spanErrCodigo.style.opacity = "1";
                  } else {
                    if (data == codigo && codigo.length != 0) {
                      spanErrCodigo.textContent = "#";
                      spanErrCodigo.style.opacity = "0";
                      cod = "";
                      codigoInput.value = "";
                      correoInput.value = "";
                      console.log("te fuiste por boton REENVIADO");
                      inputOConfirmado.value = spanCorreoEnviar.textContent;
                      document.getElementById("formCambioPassConfir").submit();
                    }
                  }
                });
              })
              .catch((err) => console.log(err));
          });

          spanCorreoEnviar.textContent = correoInput.value;
          spanErrCorreo.textContent = "Enviado";

          btnCancelar.removeAttribute("disabled");
          btnCancelar.classList.replace("btnCan1", "btnCan2");
          btnVerifCodi.style.cursor = "pointer";
          btnVerifCodi.removeAttribute("disabled");

          form2Contenedor.style.opacity = "1";

          codigoInput.style.cursor = "text";

          aReenviarCodigo.style.cursor = "pointer";

        })
        .catch((err) => console.log(err));
    }
  });

  btnCancelar.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = "inicioSesion.php";
  });

  //
  //EVENTOS
}

//------------------------------------------
// <<-- recuperarContraseña.php - FIN -->>
//------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------
// <<-- recuperarContraseña2.php - INICIO -->>
//----------------------------------------------

if (document.querySelector(".recuvaContra2HTML") !== null) {
  //INPUTS
  const contraNewInput = document.querySelector(".contraNewInput");
  const contraNewInputConfir = document.querySelector(".contraNewInputConfir");

  //SPAN
  const spanErrCorreo1 = document.querySelector(".spanErrCorreo1");

  //BOTONES
  const btnCambioContra = document.querySelector(".btnEnviar");
  const btnCancel = document.querySelector(".btnCancelar");
  const ojoAbierto = document.querySelector(".ojoAbierto");
  const ojoCerrado = document.querySelector(".ojoCerrado");

  //FORM
  const formContraNew = document.querySelector("#formCambiarContra");

  //
  //EVENTOS
  //

  btnCancel.addEventListener("click", (e) => {
    e.preventDefault();
    btnCambioContra.setAttribute("disabled", "");
    btnCambioContra.classList.replace("btnEnv1", "btnEnv2");
    btnCancel.setAttribute("disabled", "");
    btnCancel.classList.replace("btnCan1", "btnCan2");
    window.location.href = "inicioSesion.php";
  });

  btnCambioContra.addEventListener("click", (e) => {
    e.preventDefault();

    var contra1 = contraNewInput.value;
    var contra2 = contraNewInputConfir.value;

    if (contra1 != "" && contra2 != "") {
      btnCambioContra.setAttribute("disabled", "");
      btnCambioContra.classList.replace("btnEnv1", "btnEnv2");
      btnCancel.setAttribute("disabled", "");
      btnCancel.classList.replace("btnCan1", "btnCan2");
      spanErrCorreo1.textContent =
        "Contraseña cambiada con éxito. Redireccionando…";
      spanErrCorreo1.style.opacity = "1";
      spanErrCorreo1.style.color = "green";
      formContraNew.submit();
    }
  });

  ojoAbierto.addEventListener("click", () => {
    ojoAbierto.classList.replace("ojoIconA", "ojoIconA2");
    ojoCerrado.classList.replace("ojoIconC2", "ojoIconC");

    contraNewInput.removeAttribute("type");
    contraNewInputConfir.removeAttribute("type");

    contraNewInput.setAttribute("type", "text");
    contraNewInputConfir.setAttribute("type", "text");
  });

  ojoCerrado.addEventListener("click", () => {
    ojoAbierto.classList.replace("ojoIconA2", "ojoIconA");
    ojoCerrado.classList.replace("ojoIconC", "ojoIconC2");

    contraNewInput.removeAttribute("type");
    contraNewInputConfir.removeAttribute("type");

    contraNewInput.setAttribute("type", "password");
    contraNewInputConfir.setAttribute("type", "password");
  });

  contraNewInput.addEventListener("input", (e) => {
    var contra1 = contraNewInput.value;
    var contra2 = contraNewInputConfir.value;

    if (contra1 == "" && contra2 == "") {
      spanErrCorreo1.textContent = "#";
      spanErrCorreo1.style.opacity = "0";
      btnCambioContra.setAttribute("disabled", "");
      btnCambioContra.classList.replace("btnEnv1", "btnEnv2");
    } else {
      if (contra1.length < 9) {
        spanErrCorreo1.textContent = "La contraseña es muy corta";
        spanErrCorreo1.style.opacity = "1";
        btnCambioContra.setAttribute("disabled", "");
        btnCambioContra.classList.replace("btnEnv1", "btnEnv2");
      } else {
        if (contra1.length >= 9 && contra1 != contra2) {
          spanErrCorreo1.textContent = "Las contraseñas no coinciden";
          spanErrCorreo1.style.opacity = "1";
          btnCambioContra.setAttribute("disabled", "");
          btnCambioContra.classList.replace("btnEnv1", "btnEnv2");
        } else {
          if (contra1.length >= 9 && contra1 == contra2) {
            spanErrCorreo1.textContent = "#";
            spanErrCorreo1.style.opacity = "0";
            if (btnCambioContra.getAttribute("disabled") != null) {
              btnCambioContra.removeAttribute("disabled");
            }
            btnCambioContra.classList.replace("btnEnv2", "btnEnv1");
          }
        }
      }
    }
  });

  contraNewInputConfir.addEventListener("input", (e) => {
    let contra1 = contraNewInput.value;
    let contra2 = contraNewInputConfir.value;

    if (contra1 == "" && contra2 == "") {
      spanErrCorreo1.textContent = "#";
      spanErrCorreo1.style.opacity = "0";
    } else {
      if (contra1.length < 8) {
        spanErrCorreo1.textContent = "La contraseña es muy corta";
        spanErrCorreo1.style.opacity = "1";
      } else {
        if (contra1.length >= 8 && contra1 != contra2) {
          spanErrCorreo1.textContent = "Las contraseñas no coinciden";
          spanErrCorreo1.style.opacity = "1";
        } else {
          spanErrCorreo1.textContent = "#";
          spanErrCorreo1.style.opacity = "0";
          if (contra1.length >= 8 && contra1 == contra2) {
            spanErrCorreo1.textContent = "#";
            spanErrCorreo1.style.opacity = "0";
            if (btnCambioContra.getAttribute("disabled") != null) {
              btnCambioContra.removeAttribute("disabled");
            }
            btnCambioContra.classList.replace("btnEnv2", "btnEnv1");
          }
        }
      }
    }
  });
}

//-------------------------------------------
// <<-- recuperarContraseña2.php - FIN -->>
//-------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------
// <<-- confirmarNuevoMiembro.php - INICIO -->>
//-----------------------------------------------

if (document.querySelector(".confirmarCorreoHTML") != null) {
  //TOMANDO OBJETOS DEL DOM

  //INPUTS
  const inputCodigo = document.querySelector(".correoMCodigo");

  const inputNomM = document.querySelector(".inputNom");
  const inputApeM = document.querySelector(".inputApe");
  const inputDocuM = document.querySelector(".inputDocu");
  const inputFechaM = document.querySelector(".inputFecha");
  const inputTelefM = document.querySelector(".inputTelef");
  const inputDireccM = document.querySelector(".inputDirecc");
  const inputRolM = document.querySelector(".inputRol");
  const inputCorreoM = document.querySelector(".inputCorreo");
  const inputContraM = document.querySelector(".inputContra");
  const inputEmpresaM = document.querySelector(".inputEmpre");
  const inputNitM = document.querySelector(".inputNit");
  const inputCorreoA = document.querySelector(".correoAdmin");
  const inputContraA = document.querySelector(".contraAdmin");

  //BOTONES
  const btnConfirmar = document.querySelector(".btnRegistrarM");
  const btnCancelar = document.querySelector(".btnCancelarM");

  //SPAN
  const spanErrCodigo = document.querySelector(".spanErrCodigo");

  //VARIABLES GLOBALES
  var datos = ["", "", "", "", "", "", "", "", "", "", "", "", ""];

  window.addEventListener("load", () => {
    datos[0] = inputNomM.value;
    datos[1] = inputApeM.value;
    datos[2] = inputDocuM.value;
    datos[3] = inputFechaM.value;
    datos[4] = inputTelefM.value;
    datos[5] = inputDireccM.value;
    datos[6] = inputRolM.value;
    datos[7] = inputCorreoM.value;
    datos[8] = inputContraM.value;
    datos[9] = inputEmpresaM.value;
    datos[10] = inputNitM.value;
    datos[11] = inputCorreoA.value;
    datos[12] = inputContraA.value;

    console.log(datos);
    let correo = "";

    if (inputCorreoM.value != "") {
      correo = inputCorreoM.value;
    } else {
      if (inputCorreoA.value != "") {
        correo = inputCorreoA.value;
      }
    }

    let url = "http://localhost/BizLab/enviarContraRecu.php";

    let formCorreoCodigo = new FormData();

    formCorreoCodigo.append("correoUser", correo);
    formCorreoCodigo.append("send2Correo", true);

    fetch(url, {
      method: "POST",
      body: formCorreoCodigo,
    })
      .then((response) => response.json())
      .then((data) => {
        if (datos[10] != "") {
          btnConfirmar.addEventListener("click", (e) => {
            e.preventDefault();

            console.log("correcto1");

            if (
              inputNomM.value == datos[0] &&
              inputApeM.value == datos[1] &&
              inputDocuM.value == datos[2] &&
              inputFechaM.value == datos[3] &&
              inputTelefM.value == datos[4] &&
              inputDireccM.value == datos[5] &&
              inputRolM.value == datos[6] &&
              inputCorreoM.value == datos[7] &&
              inputContraM.value == datos[8] &&
              inputEmpresaM.value == datos[9] &&
              inputNitM.value == datos[10]
            ) {
              console.log("correcto2");

              if (data == inputCodigo.value) {
                var ultimoMiembroRegistrado = 0;

                let formRegisMiembro = new FormData();

                formRegisMiembro.append("nombreMiembroR", inputNomM.value);
                formRegisMiembro.append("apellidoMiembro", inputApeM.value);
                formRegisMiembro.append("documentoMiembro", inputDocuM.value);
                formRegisMiembro.append("fechaNMiembro", inputFechaM.value);
                formRegisMiembro.append("telefonoMiembro", inputTelefM.value);
                formRegisMiembro.append("direccMiembro", inputDireccM.value);
                formRegisMiembro.append("rolMiembro", inputRolM.value);
                formRegisMiembro.append("correoMiembro", inputCorreoM.value);
                formRegisMiembro.append(
                  "contraseniaMiembro",
                  inputContraM.value
                );
                formRegisMiembro.append("empresaMiembro", inputEmpresaM.value);
                formRegisMiembro.append("nitMiembro", inputNitM.value);
                formRegisMiembro.append("userVerifi", true);

                fetch("http://localhost/BizLab/consultarUsuario.php", {
                  method: "POST",
                  body: formRegisMiembro,
                })
                  .then((response) => response.json())
                  .then((data) => {
                    ultimoMiembroRegistrado = data;

                    btnConfirmar.setAttribute("disabled", "");
                    btnConfirmar.classList.replace(
                      "btnRegistrarM",
                      "btnRegistrarM2"
                    );

                    btnCancelar.setAttribute("disabled", "");
                    btnCancelar.classList.replace(
                      "btnCancelarM",
                      "btnCancelarM2"
                    );

                    setTimeout(() => {
                      window.location.href = "inicioSesion.php";
                    }, 1200);
                  })
                  .catch((err) => console.log(err));
              } else {
                spanErrCodigo.textContent =
                  "El código es incorrecto. Intente de nuevo";
                spanErrCodigo.style.opacity = "1";
              }
            }
          });
        } else {
          if (datos[10] == "") {
            btnConfirmar.addEventListener("click", (e) => {
              e.preventDefault();

              console.log("correcto1");

              if (
                inputNomM.value == datos[0] &&
                inputApeM.value == datos[1] &&
                inputDocuM.value == datos[2] &&
                inputFechaM.value == datos[3] &&
                inputTelefM.value == datos[4] &&
                inputDireccM.value == datos[5] &&
                inputRolM.value == datos[6] &&
                inputCorreoA.value == datos[11] &&
                inputContraA.value == datos[12]
              ) {
                console.log("correcto2");

                if (data == inputCodigo.value) {
                  var ultimoMiembroRegistrado = 0;

                  let formRegisMiembro = new FormData();

                  formRegisMiembro.append("nombreMiembroR", inputNomM.value);
                  formRegisMiembro.append("apellidoMiembro", inputApeM.value);
                  formRegisMiembro.append("documentoMiembro", inputDocuM.value);
                  formRegisMiembro.append("fechaNMiembro", inputFechaM.value);
                  formRegisMiembro.append("telefonoMiembro", inputTelefM.value);
                  formRegisMiembro.append("direccMiembro", inputDireccM.value);
                  formRegisMiembro.append("rolMiembro", inputRolM.value);
                  formRegisMiembro.append("correoMiembro", inputCorreoA.value);
                  formRegisMiembro.append(
                    "contraseniaMiembro",
                    inputContraA.value
                  );
                  formRegisMiembro.append("userVerifi", true);

                  fetch("http://localhost/BizLab/consultarUsuario.php", {
                    method: "POST",
                    body: formRegisMiembro,
                  })
                    .then((response) => response.json())
                    .then((data) => {
                      ultimoMiembroRegistrado = data;

                      btnConfirmar.setAttribute("disabled", "");
                      btnConfirmar.classList.replace(
                        "btnRegistrarM",
                        "btnRegistrarM2"
                      );

                      btnCancelar.setAttribute("disabled", "");
                      btnCancelar.classList.replace(
                        "btnCancelarM",
                        "btnCancelarM2"
                      );

                      setTimeout(() => {
                        window.location.href = "inicioSesion.php";
                      }, 1200);
                    })
                    .catch((err) => console.log(err));
                } else {
                  spanErrCodigo.textContent =
                    "El código es incorrecto. Intente de nuevo";
                  spanErrCodigo.style.opacity = "1";
                }
              }
            });
          }
        }
      })
      .catch((err) => console.log(err));
  });

  //
  //EVENTO
  inputCodigo.addEventListener("input", (e) => {
    if (inputCodigo.value == "") {
      spanErrCodigo.textContent = "#";
      spanErrCodigo.style.opacity = "0";
    }
  });

  btnCancelar.addEventListener("click", (e) => {
    e.preventDefault();
    inputNomM.value = "";
    inputApeM.value = "";
    inputDocuM.value = "";
    inputFechaM.value = "";
    inputTelefM.value = "";
    inputDireccM.value = "";
    inputRolM.value = "";
    inputCorreoM.value = "";
    inputContraM.value = "";
    inputEmpresaM.value = "";
    inputNitM.value = "";
    window.location.href = "inicioSesion.php";
  });
}

//--------------------------------------------
// <<-- confirmarNuevoMiembro.php - FIN -->>
//--------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
