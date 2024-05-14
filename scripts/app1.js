//
//
//<<-- Inicio Sesion COMIENZO -->>

if (document.querySelector("#iniSesionHTML") !== null) {
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
      let url = "http://localhost/BizLab-Web-v2/consultarUsuario.php";

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
          console.log(data);
          if (data == "No Existe el Usuario") {
            spanErrorEntrada.innerHTML = `<span style="color: #f20; font-size:2rem">El usuario que ingresó NO Existe</span>`;
            spanCorreoErr.textContent = "";
            spanContraseñaErr.textContent = "";
          }
          if (data == "El usuario existe y la contraseña es Incorrecta") {
            spanErrorEntrada.innerHTML = `<span style="color: #f20; font-size:2rem">La contraseña es Incorrecta</span>`;
            spanCorreoErr.textContent = "";
            spanContraseñaErr.textContent = "";
          }
          if (data == "El usuario existe y la contraseña es Correcta") {
            spanErrorEntrada.innerHTML = `<span style="color: green; font-size:2rem">Ingresando...</span>`;
            spanCorreoErr.textContent = "";
            spanContraseñaErr.textContent = "";
            setTimeout(() => {
              formEntrar.submit();
            }, 1200);
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

//<<-- Inicio Sesion FIN -->>
//
//

//
//
//
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//
//
//

//
//
//<<-- Registro Inicio-->>
//
//

if (document.querySelector(".registroHTML") !== null) {
  //
  //--------------------------------------------------------------------------
  //

  //SELECCIONES DEL DOM (REGISTRO.PHP) - INICIO

  //
  //--------------------------------------------------------------------------
  //

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

  //
  //--------------------------------------------------------------------------
  //

  //BOTONES

  const btnSiguienteF1 = document.querySelector(".btnSiguienteF1");

  const btnAtras = document.querySelector(".btnAtrasRegis");
  const btnAtrasA = document.querySelector(".btnAtrasRegisA");

  const btnCancelarRegis = document.querySelector(".btnCancelarRegis");
  const btnCancelarRegis2 = document.querySelector(".btnCancelRegisF2");
  const btnCancelarRegisM = document.querySelector(".btnCancelRegisM");

  const btnRegistrarse = document.querySelector(".btnRegistrarse");
  const btnRegistrarseA = document.querySelector(".btnRegistrarseAdmin");

  const ojoIconoA = document.querySelector(".ojoAbierto");
  const ojoIconoC = document.querySelector(".ojoCerrado");

  const ojoIconoAadmi = document.querySelector(".ojoAbiertoAdmi");
  const ojoIconoCadmi = document.querySelector(".ojoCerradoAdmi");

  //
  //--------------------------------------------------------------------------
  //

  //FORMULARIOS

  const formRegisF1 = document.querySelector(".formRe1");
  const formRegisF2 = document.querySelector(".formRe2");
  const formRegisF3 = document.querySelector(".formRe3");

  //
  //----------------------------------------------------------------------------
  //

  //SPAN

  const spanRegisPer = document.querySelector(".registroSpan2");
  const spanErrNombre = document.querySelector(".sparErrNombre");
  const spanErrApellido = document.querySelector(".sparErrApellido");
  const spanErrDocumento = document.querySelector(".sparErrDocumento");
  const spanErrNacimiento = document.querySelector(".sparErrNacimiento");
  const spanErrTelefono = document.querySelector(".sparErrTelefono");
  const sparErrTipoUser = document.querySelector(".sparErrTipoUser");
  const spanErrCorreoMiembro = document.querySelector(".sparErrCorreo");
  const spanErrNit = document.querySelector(".spanErrNit");
  const spanErrCodigoAcc = document.querySelector(".spanErrCodigoAcc");
  const spanErrCorreoAdmi = document.querySelector(".spanErrCorreoAdmi");

  const contraNoCoincide = document.querySelector(".contraNoCoincide");
  const contraNoCoincideA = document.querySelector(".contraNoCoincide2");

  //
  //----------------------------------------------------------------------------
  //

  //SELECCIONES DEL DOM (REGISTRO.PHP) - FIN

  //
  //------------------------------------------------------------------------------
  //

  //VARIABLES GLOBALES

  var posicionFormRegis = 1;
  var numeros = "0123456789";
  var numeros2 = "1234567890+";
  var numEstado = false;
  var arroba = "@";
  var letras = "abcdefghijklmnñopqrstuvwxyz";
  var estadoInputs1 = true;

  //Array para verificar que los inputs tengan datos correctos (0=true, 1=false);
  var erroneos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

  //Array que guardara temporalmente los datos digitados por el usuario
  var datosUsuario = ["", "", 0, "", 0, "", "", "", "", "", 0];

  var estadoBtn = true;
  var bloqueadoBoton = null;

  //
  //-----------------------------------------------------------------------------------------
  //

  //FUNCIONES

  const desbloqBloqBoton = () => {
    let suma = 0;
    console.log(erroneos.length);
    for (let i = 0; i < erroneos.length; i++) {
      suma = suma + erroneos[i];
    }
    if (suma != 0) {
      estadoBtn = false;
    } else {
      if (suma == 0) {
        estadoBtn = true;
      }
    }
    if (estadoBtn == false) {
      btnSiguienteF1.setAttribute("disabled", "");
      btnSiguienteF1.classList.replace("btnSigueF1", "btnSigueF2");

      btnRegistrarse.setAttribute("disabled", "");
      btnRegistrarse.classList.replace("btnRegistrar1", "btnRegistrar2");

      btnRegistrarseA.setAttribute("disabled", "");
      btnRegistrarseA.classList.replace("btnRegistrarA1", "btnRegistrarA2");

      btnAtras.setAttribute("disabled", "");
      btnAtras.classList.replace("btnAtras1", "btnAtras2");

      btnAtrasA.setAttribute("disabled", "");
      btnAtrasA.classList.replace("btnAtrasA1", "btnAtrasA2");

      bloqueadoBoton = "disabled";
    } else {
      if (estadoBtn == true) {
        if (btnSiguienteF1.getAttribute("disabled") != null) {
          btnSiguienteF1.removeAttribute("disabled");
          btnSiguienteF1.classList.replace("btnSigueF2", "btnSigueF1");

          bloqueadoBoton = null;
        }

        if (btnAtras.getAttribute("disabled") != null) {
          btnAtras.removeAttribute("disabled");
          btnAtras.classList.replace("btnAtras2", "btnAtras1");
        }

        if (btnAtrasA.getAttribute("disabled") != null) {
          btnAtrasA.removeAttribute("disabled");
          btnAtrasA.classList.replace("btnAtrasA2", "btnAtrasA1");
        }

        if (btnRegistrarse.getAttribute("disabled") != null) {
          btnRegistrarse.removeAttribute("disabled");
          btnRegistrarse.classList.replace("btnRegistrar2", "btnRegistrar1");

          btnRegistrarseA.removeAttribute("disabled");
          btnRegistrarseA.classList.replace("btnRegistrarA2", "btnRegistrarA1");

          bloqueadoBoton = null;
        }
      }
    }
    console.log(erroneos);
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

  //NOMBRE INPUT EVENTO (Registro.php) - INICIO
  nombreRegisInput.addEventListener("input", () => {
    let nombre = nombreRegisInput.value;

    if (nombre.length == 0) {
      desbloqBloqBoton();
    }
    for1: for (let i = 0; i < nombre.length; i++) {
      let letraActual = nombre.charAt(i).toLowerCase();
      for2: for (let e = 0; e < letras.length; e++) {
        if (letraActual == letras.charAt(e)) {
          estadoInputs1 = true;
          break for2;
        } else {
          estadoInputs1 = false;
        }
      }
      if (estadoInputs1 == false) {
        break for1;
      }
    }
    if (estadoInputs1 == false) {
      if (nombreRegisInput.value.length == 0) {
        spanErrNombre.textContent = "#";
        spanErrNombre.style.opacity = "0";
        verificarErroneos(0, 0);
      } else {
        spanErrNombre.textContent = "No use números ni caracteres especiales";
        spanErrNombre.style.opacity = "1";
        verificarErroneos(0, 1);
      }
    } else {
      if (estadoInputs1 == true) {
        if (nombreRegisInput.value.length == 0) {
          spanErrNombre.textContent = "#";
          spanErrNombre.style.opacity = "0";
          verificarErroneos(0, 0);
        } else {
          spanErrNombre.textContent = "#";
          spanErrNombre.style.opacity = "0";
          verificarErroneos(0, 0);
        }
      }
    }
  });
  //NOMBRE INPUT EVENTO (Registro.php) - FIN

  //APELLIDO INPUT EVENTO (Registro.php) - INICIO
  apellidoRegisInput.addEventListener("input", (e) => {
    let nombre = apellidoRegisInput.value;

    if (nombre.length == 0) {
      desbloqBloqBoton();
    }

    for1: for (let i = 0; i < nombre.length; i++) {
      let letraActual = nombre.charAt(i).toLowerCase();

      for2: for (let e = 0; e < letras.length; e++) {
        if (letraActual == letras.charAt(e)) {
          estadoInputs1 = true;
          break for2;
        } else {
          estadoInputs1 = false;
        }
      }

      if (estadoInputs1 == false) {
        break for1;
      }
    }

    if (estadoInputs1 == false) {
      if (apellidoRegisInput.value.length == 0) {
        spanErrApellido.textContent = "#";
        spanErrApellido.style.opacity = "0";

        verificarErroneos(1, 0);
      } else {
        spanErrApellido.textContent = "No use números ni caracteres especiales";
        spanErrApellido.style.opacity = "1";

        verificarErroneos(1, 1);
      }
    } else {
      if (estadoInputs1 == true) {
        if (apellidoRegisInput.value.length == 0) {
          spanErrApellido.textContent = "#";
          spanErrApellido.style.opacity = "0";

          verificarErroneos(1, 0);
        } else {
          spanErrApellido.textContent = "#";
          spanErrApellido.style.opacity = "0";

          verificarErroneos(1, 0);
        }
      }
    }
  });
  //APELLIDO INPUT EVENTO (Registro.php) - FIN

  //DOCUMENTO INPUT EVENTO (Registro.php) - INICIO
  documentoInput.addEventListener("input", () => {
    if (documentoInput.value.length != 0 && erroneos[2] == 0) {
      let documentTamanio = documentoInput.value;
      if (
        documentTamanio.length > 4 &&
        documentTamanio.length <= 11 &&
        documentTamanio.length != 0
      ) {
        let documentoComprobar = documentoInput.value;

        let url = "http://localhost/BizLab-Web-v2/consultarUsuario.php";

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
              verificarErroneos(10, 1);
            } else {
              if (data == false) {
                spanErrDocumento.textContent = "#";
                spanErrDocumento.style.opacity = "0";
                verificarErroneos(10, 0);
              }
            }
          })
          .catch((err) => console.log(err));
      }
    }
  });

  documentoInput.addEventListener("input", (e) => {
    let nombre = documentoInput.value.trim();

    if (nombre.length == 0) {
      desbloqBloqBoton();
    }

    if ((nombre.length < 5 || nombre.length > 11) && nombre.length != 0) {
      spanErrDocumento.textContent =
        "Número de Documento inválido (10 dígitos solamente)";
      spanErrDocumento.style.opacity = "1";

      verificarErroneos(2, 1);
    } else {
      verificarErroneos(2, 0);

      for1: for (let i = 0; i < nombre.length; i++) {
        let letraActual = nombre.charAt(i).toLowerCase();

        for2: for (let e = 0; e < numeros.length; e++) {
          if (letraActual == numeros.charAt(e)) {
            estadoInputs1 = true;
            break for2;
          } else {
            estadoInputs1 = false;
          }
        }

        if (estadoInputs1 == false) {
          break for1;
        }
      }

      if (estadoInputs1 == false) {
        if (documentoInput.value.length == 0) {
          spanErrDocumento.textContent = "#";
          spanErrDocumento.style.opacity = "0";

          verificarErroneos(2, 0);
        } else {
          spanErrDocumento.textContent =
            "No use letras ni caracteres especiales";
          spanErrDocumento.style.opacity = "1";

          verificarErroneos(2, 1);
        }
      } else {
        if (estadoInputs1 == true) {
          if (documentoInput.value.length == 0) {
            spanErrDocumento.textContent = "#";
            spanErrDocumento.style.opacity = "0";

            verificarErroneos(2, 0);
          } else {
            spanErrDocumento.textContent = "#";
            spanErrDocumento.style.opacity = "0";

            verificarErroneos(2, 0);
          }
        }
      }
    }
  });
  //DOCUMENTO INPUT EVENTO (Registro.php) - FIN

  //FECHA NACIMIENTO INPUT EVENTO (Registro.php) - INICIO
  fechaNInputRegis.addEventListener("input", () => {
    let fecha = null;

    if (fechaNInputRegis.value != "") {
      fecha = fechaNInputRegis.value.trim();
    }

    let url = "http://localhost/BizLab-Web-v2/consultarUsuario.php";

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
          spanErrNacimiento.textContent = "Introduzca una fecha válida";
          spanErrNacimiento.style.opacity = "1";

          verificarErroneos(3, 1);
        } else {
          if (data == true) {
            spanErrNacimiento.textContent = "#";
            spanErrNacimiento.style.opacity = "0";

            verificarErroneos(3, 0);
          }
        }
      })
      .catch((err) => console.log(err));
  });
  //FECHA NACIMIENTO INPUT EVENTO (Registro.php) - FIN

  //TELEFONO INPUT EVENTO (Registro.php) - INICIO
  telefonoInputRegis.addEventListener("input", (e) => {
    if (erroneos[4] == 0 && telefonoInputRegis.value.length != 0) {
      let telefonoExistente = telefonoInputRegis.value;

      let url = "http://localhost/BizLab-Web-v2/consultarUsuario.php";

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
            verificarErroneos(11, 1);
          } else {
            if (data == false) {
              spanErrTelefono.textContent = "#";
              spanErrTelefono.style.opacity = "0";
              verificarErroneos(11, 0);
            }
          }
        })
        .catch((err) => console.log(err));
    }
  });

  telefonoInputRegis.addEventListener("input", (e) => {
    let nombre = telefonoInputRegis.value.toLowerCase().trim();

    if (nombre.length == 0) {
      desbloqBloqBoton();
    }

    for1: for (let i = 0; i < nombre.length; i++) {
      let letraActual = nombre.charAt(i);

      for2: for (let e = 0; e < numeros2.length; e++) {
        if (letraActual == numeros2.charAt(e)) {
          estadoInputs1 = true;
          break for2;
        } else {
          estadoInputs1 = false;
        }
      }

      if (estadoInputs1 == false) {
        break for1;
      }
    }

    if (estadoInputs1 == false) {
      if (telefonoInputRegis.value.length == 0) {
        spanErrTelefono.textContent = "#";
        spanErrTelefono.style.opacity = "0";

        verificarErroneos(4, 0);
      } else {
        spanErrTelefono.textContent = "No use letras ni caracteres especiales";
        spanErrTelefono.style.opacity = "1";

        verificarErroneos(4, 1);
      }
    } else {
      if (estadoInputs1 == true) {
        if (telefonoInputRegis.value.length == 0) {
          spanErrTelefono.textContent = "#";
          spanErrTelefono.style.opacity = "0";

          verificarErroneos(4, 0);
        } else {
          spanErrTelefono.textContent = "#";
          spanErrTelefono.style.opacity = "0";

          verificarErroneos(4, 0);
        }
      }
    }
  });
  //TELEFONO INPUT EVENTO (Registro.php) - FIN

  //TIPO MIEMBRO SELECT (Registro.php) - INICIO
  inputSelectRol.addEventListener("input", () => {
    let seleccion = inputSelectRol.options[inputSelectRol.selectedIndex].text;

    if (seleccion == "Miembro Común" || seleccion == "Administrador") {
      verificarErroneos(9, 0);
      sparErrTipoUser.style.opacity = "0";
      sparErrTipoUser.textContent = "#";
    } else {
      verificarErroneos(9, 1);
      sparErrTipoUser.textContent = "Rol inválido";
      sparErrTipoUser.style.opacity = "1";
    }
  });
  //TIPO MIEMBRO SELECT (Registro.php) - FIN

  //
  //
  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //
  //
  //-- INPUTS CORREO (REGISTRO.PHP) - INICIO -- -----------------------------------------------------------------

  //MIEMBRO INPUT CORREO (REGISTRO.PHP) - INICIO
  inputCorreo.addEventListener("input", () => {
    if (erroneos[5] == 0 && inputCorreo.value.length != 0) {
      let correoExistente = inputCorreo.value;

      let url = "http://localhost/BizLab-Web-v2/consultarUsuario.php";

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
            verificarErroneos(5, 1);
          } else {
            if (data == false) {
              spanErrCorreoMiembro.textContent = "#";
              spanErrCorreoMiembro.style.opacity = "0";
              verificarErroneos(5, 0);
            }
          }
        })
        .catch((err) => console.log(err));
    }
  });

  inputCorreo.addEventListener("input", (e) => {
    let nombre = inputCorreo.value;
    let arrobaNumber = 0;

    if (nombre.length == 0) {
      desbloqBloqBoton();
    }

    for (let i = 0; i < nombre.length; i++) {
      if (nombre.charAt(i) == "@") {
        arrobaNumber++;
      }
    }

    if (arrobaNumber == 2) {
      estadoInputs1 = false;
    } else {
      if (arrobaNumber == 0) {
        estadoInputs1 = false;
      } else {
        estadoInputs1 = true;
      }
    }

    if (estadoInputs1 == false) {
      if (inputCorreo.value.length == 0) {
        spanErrCorreoMiembro.textContent = "#";
        spanErrCorreoMiembro.style.opacity = "0";

        verificarErroneos(5, 0);
      } else {
        spanErrCorreoMiembro.textContent = "El correo es inválido";
        spanErrCorreoMiembro.style.opacity = "1";

        verificarErroneos(5, 1);
      }
    } else {
      if (estadoInputs1 == true) {
        if (inputCorreo.value.length == 0) {
          spanErrCorreoMiembro.textContent = "#";
          spanErrCorreoMiembro.style.opacity = "0";

          verificarErroneos(5, 0);
        } else {
          spanErrCorreoMiembro.textContent = "#";
          spanErrCorreoMiembro.style.opacity = "0";

          verificarErroneos(5, 0);
        }
      }
    }
  });
  //MIEMBRO INPUT CORREO (REGISTRO.PHP) - FIN

  //ADMIN INPUT CORREO (REGISTRO.PHP) - INICIO
  correoAdminInput.addEventListener("input", () => {
    if (erroneos[5] == 0 && correoAdminInput.value.length != 0) {
      let correoAdminExis = correoAdminInput.value;

      let url = "http://localhost/BizLab-Web-v2/consultarUsuario.php";

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
            verificarErroneos(5, 1);
          } else {
            if (data == false) {
              spanErrCorreoAdmi.textContent = "#";
              spanErrCorreoAdmi.style.opacity = "0";
              verificarErroneos(5, 0);
            }
          }
        })
        .catch((err) => console.log(err));
    }
  });

  correoAdminInput.addEventListener("input", (e) => {
    let nombre = correoAdminInput.value;
    let arrobaNumber = 0;

    if (nombre.length == 0) {
      desbloqBloqBoton();
    }

    for (let i = 0; i < nombre.length; i++) {
      if (nombre.charAt(i) == "@") {
        arrobaNumber++;
      }
    }

    if (arrobaNumber == 2) {
      estadoInputs1 = false;
    } else {
      if (arrobaNumber == 0) {
        estadoInputs1 = false;
      } else {
        estadoInputs1 = true;
      }
    }

    if (estadoInputs1 == false) {
      if (correoAdminInput.value.length == 0) {
        spanErrCorreoAdmi.textContent = "#";
        spanErrCorreoAdmi.style.opacity = "0";

        verificarErroneos(5, 0);
      } else {
        spanErrCorreoAdmi.textContent = "El correo es inválido";
        spanErrCorreoAdmi.style.opacity = "1";

        verificarErroneos(5, 1);
      }
    } else {
      if (estadoInputs1 == true) {
        if (correoAdminInput.value.length == 0) {
          spanErrCorreoAdmi.textContent = "#";
          spanErrCorreoAdmi.style.opacity = "0";

          verificarErroneos(5, 0);
        } else {
          spanErrCorreoAdmi.textContent = "#";
          spanErrCorreoAdmi.style.opacity = "0";

          verificarErroneos(5, 0);
        }
      }
    }
  });
  //ADMIN INPUT CORREO (REGISTRO.PHP) - FIN

  //-- INPUTS CORREO (REGISTRO.PHP) - FIN -- -----------------------------------------------------------------
  //
  //
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //
  //
  //-- INPUTS CONTRASEÑA (REGISTRO.PHP) - INICIO -- ----------------------------------------------------------------------------

  //MIEMBRO INPUT CONTRASEÑA (REGISTRO.PHP) - INICIO
  inputContraseña.addEventListener("input", () => {
    let valor1 = inputContraseña.value.trim();
    let valor2 = inputContraConfir.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(6, 0);
      verificarErroneos(7, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != valor2 && valor1.length >= 9) {
      contraNoCoincide.textContent = "Las contraseñas NO coinciden";
      contraNoCoincide.style.opacity = "1";

      verificarErroneos(6, 1);
      verificarErroneos(7, 1);
    } else {
      if (valor1 != valor2 && valor1.length < 9) {
        contraNoCoincide.textContent = "La contraseña es muy corta";
        contraNoCoincide.style.opacity = "1";

        verificarErroneos(6, 1);
        verificarErroneos(7, 1);
      } else {
        if (valor1 == valor2 && valor1.length >= 9) {
          contraNoCoincide.textContent = "#";
          contraNoCoincide.style.opacity = "0";

          verificarErroneos(6, 0);
          verificarErroneos(7, 0);
        }
      }
    }
  });

  inputContraConfir.addEventListener("input", () => {
    let valor1 = inputContraseña.value.trim();
    let valor2 = inputContraConfir.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(6, 0);
      verificarErroneos(7, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != valor2 && valor1.length >= 9) {
      contraNoCoincide.textContent = "Las contraseñas NO coinciden";
      contraNoCoincide.style.opacity = "1";

      verificarErroneos(6, 1);
      verificarErroneos(7, 1);
    } else {
      if (valor1 != valor2 && valor1.length < 9) {
        contraNoCoincide.textContent = "La contraseña es muy corta";
        contraNoCoincide.style.opacity = "1";

        verificarErroneos(6, 1);
        verificarErroneos(7, 1);
      } else {
        if (valor1 == valor2 && valor1.length >= 9) {
          contraNoCoincide.textContent = "#";
          contraNoCoincide.style.opacity = "0";

          verificarErroneos(6, 0);
          verificarErroneos(7, 0);
        }
      }
    }
  });
  //MIEMBRO INPUT CONTRASEÑA (REGISTRO.PHP) - FIN

  //ADMIN INPUT CONTRASEÑA (REGISTRO.PHP) - INICIO
  inputContraseña2.addEventListener("input", () => {
    let valor1 = inputContraseña2.value.trim();
    let valor2 = inputContraConfir2.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(6, 0);
      verificarErroneos(7, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != valor2 && valor1.length >= 9) {
      contraNoCoincideA.textContent = "Las contraseñas NO coinciden";
      contraNoCoincideA.style.opacity = "1";

      verificarErroneos(6, 1);
      verificarErroneos(7, 1);
    } else {
      if (valor1 != valor2 && valor1.length < 9) {
        contraNoCoincideA.textContent = "La contraseña es muy corta";
        contraNoCoincideA.style.opacity = "1";

        verificarErroneos(6, 1);
        verificarErroneos(7, 1);
      } else {
        if (valor1 == valor2 && valor1.length >= 9) {
          contraNoCoincideA.textContent = "#";
          contraNoCoincideA.style.opacity = "0";

          verificarErroneos(6, 0);
          verificarErroneos(7, 0);
        }
      }
    }
  });

  inputContraConfir2.addEventListener("input", () => {
    let valor1 = inputContraseña2.value.trim();
    let valor2 = inputContraConfir2.value.trim();

    if (valor1 == "" && valor2 == "") {
      verificarErroneos(6, 0);
      verificarErroneos(7, 0);

      contraNoCoincide.textContent = "#";
      contraNoCoincide.style.opacity = "0";
    }

    if (valor1 != valor2 && valor1.length >= 9) {
      contraNoCoincideA.textContent = "Las contraseñas NO coinciden";
      contraNoCoincideA.style.opacity = "1";

      verificarErroneos(6, 1);
      verificarErroneos(7, 1);
    } else {
      if (valor1 != valor2 && valor1.length < 9) {
        contraNoCoincideA.textContent = "La contraseña es muy corta";
        contraNoCoincideA.style.opacity = "1";

        verificarErroneos(6, 1);
        verificarErroneos(7, 1);
      } else {
        if (valor1 == valor2 && valor1.length >= 9) {
          contraNoCoincideA.textContent = "#";
          contraNoCoincideA.style.opacity = "0";

          verificarErroneos(6, 0);
          verificarErroneos(7, 0);
        }
      }
    }
  });
  //ADMIN INPUT CONTRASEÑA (REGISTRO.PHP) - FIN

  //-- INPUTS CONTRASEÑA (REGISTRO.PHP) - FIN -- ---------------------------------------------------------------------------------
  //
  //
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

  //NIT INPUT (REGISTRO.PHP) - INICIO
  inputNit.addEventListener("input", (e) => {
    let nombre = inputNit.value.trim();

    if (nombre.length == 0) {
      desbloqBloqBoton();
    }

    for1: for (let i = 0; i < nombre.length; i++) {
      let letraActual = nombre.charAt(i);

      for2: for (let e = 0; e < numeros.length; e++) {
        if (letraActual == numeros.charAt(e)) {
          estadoInputs1 = true;
          break for2;
        } else {
          estadoInputs1 = false;
        }
      }

      if (estadoInputs1 == false) {
        break for1;
      }
    }

    if (estadoInputs1 == false) {
      if (inputNit.value.length == 0) {
        spanErrNit.textContent = "#";
        spanErrNit.style.opacity = "0";

        verificarErroneos(8, 0);
      } else {
        spanErrNit.textContent = "No use letras ni caracteres especiales";
        spanErrNit.style.opacity = "1";

        verificarErroneos(8, 1);
      }
    } else {
      if (estadoInputs1 == true) {
        if (inputNit.value.length == 0) {
          spanErrNit.textContent = "#";
          spanErrNit.style.opacity = "0";

          verificarErroneos(8, 0);
        } else {
          spanErrNit.textContent = "#";
          spanErrNit.style.opacity = "0";

          verificarErroneos(8, 0);
        }
      }
    }
  });
  //NIT INPUT (REGISTRO.PHP) - FIN

  //
  //--------------------------------------------------------------------------
  //

  btnSiguienteF1.addEventListener("click", (e) => {
    console.log("Boton Siguiente Tocado");

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
      e.preventDefault();
      sparErrTipoUser.textContent = "Debe llenar los campos";
      sparErrTipoUser.style.opacity = "1";
      console.log("Boton Siguiente Vacios Bloqueados");
    } else {
      if (sparErrTipoUser.textContent == "Debe llenar los campos") {
        sparErrTipoUser.textContent = "#";
        sparErrTipoUser.style.opacity = "0";
      }
      if (bloqueadoBoton == "disabled") {
        console.log("Boton Siguiente Bloqueado");
        e.preventDefault();
        btnSiguienteF1.setAttribute("disabled", "");
      } else {
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
          e.preventDefault();
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
          btnAtras.addEventListener("click", (e) => {
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
          e.preventDefault();
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
    }
  });

  btnRegistrarse.addEventListener("click", (e) => {
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
      e.preventDefault();
      spanErrNit.textContent = "Debe llenar los campos";
      spanErrNit.style.opacity = "1";
      console.log("Boton Registrarse Vacios Bloqueados");
    } else {
      console.log("Boton Registrarse Tocado");
      if (bloqueadoBoton == "disabled") {
        console.log("Boton Registrarse Bloqueado");
        e.preventDefault();
        btnRegistrarse.setAttribute("disabled", "");
      } else {
        e.preventDefault();

        spanErrNit.textContent = "Registrando...";
        spanErrNit.classList.replace("spanErr", "spanRegisAdminExito");
        spanErrNit.style.opacity = "1";

        let nombre = nombreRegisInput.value;
        let apellidos = apellidoRegisInput.value;
        let documento = documentoInput.value;
        let fechaNacimiento = fechaNInputRegis.value;
        let telefono = telefonoInputRegis.value;
        let direccion = direccInputRegis.value;
        let rol = inputSelectRol.options[inputSelectRol.selectedIndex].text;
        let correo = inputCorreo.value;
        let contrasenia = inputContraseña.value;
        let empresa = empresaInput.value;
        let nit = inputNit.value;
        var ultimoMiembroRegistrado = 0;

        let formRegisMiembro = new FormData();

        formRegisMiembro.append("nombreMiembro", nombre);
        formRegisMiembro.append("apellidoMiembro", apellidos);
        formRegisMiembro.append("documentoMiembro", documento);
        formRegisMiembro.append("fechaNMiembro", fechaNacimiento);
        formRegisMiembro.append("telefonoMiembro", telefono);
        formRegisMiembro.append("direccMiembro", direccion);
        formRegisMiembro.append("rolMiembro", rol);
        formRegisMiembro.append("correoMiembro", correo);
        formRegisMiembro.append("contraseniaMiembro", contrasenia);
        formRegisMiembro.append("empresaMiembro", empresa);
        formRegisMiembro.append("nitMiembro", nit);
        formRegisMiembro.append("userVerifi", true);

        fetch("http://localhost/BizLab-Web-v2/consultarUsuario.php", {
          method: "POST",
          body: formRegisMiembro,
        })
          .then((response) => response.json())
          .then((data) => {
            ultimoMiembroRegistrado = data;

            btnRegistrarse.setAttribute("disabled", "");
            btnRegistrarse.classList.replace("btnRegistrar1", "btnRegistrar2");

            btnAtras.setAttribute("disabled", "");
            btnAtras.classList.replace("btnAtras1", "btnAtras2");

            btnCancelarRegisM.setAttribute("disabled", "");
            btnCancelarRegisM.classList.replace("btnCancelar1", "btnCancelar2");

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

            setTimeout(() => {
              window.location.href = "index.php";
            }, 1200);
          })
          .catch((err) => console.log(err));
      }
    }
  });

  btnRegistrarseA.addEventListener("click", (e) => {
    e.preventDefault();
    console.log("adminRegistrar");
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
      e.preventDefault();
      spanErrCodigoAcc.textContent = "Debe llenar los campos";
      spanErrCodigoAcc.style.opacity = "1";
      console.log("Boton Registrarse Admin Vacios Bloqueados");
    } else {
      console.log("Boton Registrarse Admin Tocado");
      if (bloqueadoBoton == "disabled") {
        console.log("Boton Registrarse Bloqueado");
        e.preventDefault();
        btnRegistrarseA.setAttribute("disabled", "");
      } else {
        e.preventDefault();
        let codAcceso = inputCodigoAcce.value.trim();
        let url = "http://localhost/BizLab-Web-v2/consultarUsuario.php";

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

                let nombre = nombreRegisInput.value;
                let apellidos = apellidoRegisInput.value;
                let documento = documentoInput.value;
                let fechaNacimiento = fechaNInputRegis.value;
                let telefono = telefonoInputRegis.value;
                let direccion = direccInputRegis.value;
                let rol =
                  inputSelectRol.options[inputSelectRol.selectedIndex].text;
                let correo = correoAdminInput.value;
                let contrasenia = inputContraseña2.value;
                var ultimoAdminRegistrado = 0;

                let formRegisAdmin = new FormData();

                formRegisAdmin.append("nombreAdmin", nombre);
                formRegisAdmin.append("apellidoAdmin", apellidos);
                formRegisAdmin.append("documentoAdmin", documento);
                formRegisAdmin.append("fechaNAdmin", fechaNacimiento);
                formRegisAdmin.append("telefonoAdmin", telefono);
                formRegisAdmin.append("direccAdmin", direccion);
                formRegisAdmin.append("rolAdmin", rol);
                formRegisAdmin.append("correoAdmin", correo);
                formRegisAdmin.append("contraseniaAdmin", contrasenia);
                formRegisAdmin.append("empresaAdmin", "");
                formRegisAdmin.append("nitAdmin", 0);
                formRegisAdmin.append("userVerifi", true);

                fetch("http://localhost/BizLab-Web-v2/consultarUsuario.php", {
                  method: "POST",
                  body: formRegisAdmin,
                })
                  .then((response) => response.json())
                  .then((data) => {
                    ultimoAdminRegistrado = data;
                    console.log(ultimoAdminRegistrado);

                    btnRegistrarseA.setAttribute("disabled", "");
                    btnRegistrarseA.classList.replace(
                      "btnRegistrarA1",
                      "btnRegistrarA2"
                    );

                    btnAtrasA.setAttribute("disabled", "");
                    btnAtrasA.classList.replace("btnAtrasA1", "btnAtrasA2");

                    document
                      .querySelector(".btnCancelA")
                      .setAttribute("disabled", "");
                    document
                      .querySelector(".btnCancelA")
                      .classList.replace("btnCancelarA1", "btnCancelarA2");

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

                    setTimeout(() => {
                      window.location.href = "index.php";
                    }, 1200);
                  })
                  .catch((err) => console.log(err));

                spanErrCodigoAcc.textContent = "Registrando...";
                spanErrCodigoAcc.classList.replace(
                  "spanErr",
                  "spanRegisAdminExito"
                );
              }
            }
          })
          .catch((err) => console.log(err));
      }
    }
  });

  btnCancelarRegis.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = "index.php";
  });

  btnCancelarRegis2.addEventListener("click", (e) => {
    e.preventDefault();
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

  ojoIconoAadmi.addEventListener("click", (e) => {
    if (ojoIconoAadmi.classList.contains("ojoIconAAdmi")) {
      ojoIconoAadmi.classList.replace("ojoIconAAdmi", "ojoIconA2Admi");
      ojoIconoCadmi.classList.replace("ojoIconC2Admi", "ojoIconCAdmi");
      inputContraseña2.removeAttribute("type");
      inputContraseña2.setAttribute("type", "text");
      inputContraConfir2.removeAttribute("type");
      inputContraConfir2.setAttribute("type", "text");
    }
  });

  ojoIconoCadmi.addEventListener("click", (e) => {
    if (ojoIconoCadmi.classList.contains("ojoIconCAdmi")) {
      ojoIconoAadmi.classList.replace("ojoIconA2Admi", "ojoIconAAdmi");
      ojoIconoCadmi.classList.replace("ojoIconCAdmi", "ojoIconC2Admi");
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

//<<-- Registro Fin -->>
//
//

//
//
//
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//
//
//
