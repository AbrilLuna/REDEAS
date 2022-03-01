const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	apellidos:  /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    password: /^.{6,12}$/, // 6 a 12 digitos.	
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

/*Nos ayuda para validar que todos los campos del formulario esten llenos*/
const campos = {
    nombre: false,
    apellidos: false,
    password: false,
    email: false,
    emailSesion: false,
    passwordSesion: false,
    emailRecuperar: false,
    nuevoPassword: false
}

/** Funcion para validar el formulario **/
const validarFormulario = (e) => {
    console.log(e.target.name);
    switch (e.target.name) {
        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre');
        break;
        case "apellidos":
            validarCampo(expresiones.apellidos, e.target, 'apellidos');
        break;
        case "password":
            validarCampo(expresiones.password, e.target, 'password');
            validarPassword2();
        break;
        case "password2":
            validarPassword2();
        break;
        case "email":
            validarCampo(expresiones.email, e.target, 'email');
        break;
        /**Estos  casos pertenecen al inicio de sesion**/
        case "emailSesion":
            validarCampo(expresiones.email, e.target, 'emailSesion');
        break;
        case "passwordSesion":
            validarCampo(expresiones.password, e.target, 'passwordSesion');
        break;
        /**Este caso pertenece al formulario de recuperar contraseña */
        case "emailRecuperar":
            validarCampo(expresiones.email, e.target, 'emailRecuperar');
        break;
        /**Este caso pertenece al formulario de Ingresar nuevo password */
        case "nuevoPassword":
            validarCampo(expresiones.password, e.target, 'nuevoPassword');
        break;
    }
}

/**Funcion para mostrar los mensajes de error, recibe tres parametros para poder reutilizar el codigo en todos los casos posibles**/
const validarCampo = (expresion, input, campo) => {
    if(expresion.test(input.value)){
        document.getElementById(`sesion-${campo}`).classList.remove('formulario__datos-incorrecto');
        document.getElementById(`sesion-${campo}`).classList.add('formulario__datos-correcto');
        document.querySelector(`#sesion-${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#sesion-${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#sesion-${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true; //marcamos el campo de que esta completo
    }else{
        document.getElementById(`sesion-${campo}`).classList.add('formulario__datos-incorrecto');
        document.getElementById(`sesion-${campo}`).classList.remove('formulario__datos-correcto');
        document.querySelector(`#sesion-${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#sesion-${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#sesion-${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
}

/**Funcion para validar que las contraseñas coincidan y mostrar mensajes **/
const validarPassword2 = () => {
    const inputPassword1 = document.getElementById('password');
    const inputPassword2 = document.getElementById('password2');

    if(inputPassword1.value !== inputPassword2.value){
        document.getElementById(`sesion-password2`).classList.add('formulario__datos-incorrecto');
        document.getElementById(`sesion-password2`).classList.remove('formulario__datos-correcto');
        document.querySelector(`#sesion-password2 i`).classList.add('fa-times-circle');
        document.querySelector(`#sesion-password2 i`).classList.remove('fa-check-circle');
        document.querySelector(`#sesion-password2 .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos['password'] = false;
    }else{
        document.getElementById(`sesion-password2`).classList.remove('formulario__datos-incorrecto');
        document.getElementById(`sesion-password2`).classList.add('formulario__datos-correcto');
        document.querySelector(`#sesion-password2 i`).classList.remove('fa-times-circle');
        document.querySelector(`#sesion-password2 i`).classList.add('fa-check-circle');
        document.querySelector(`#sesion-password2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos['password'] = true;
    }
}

//mostrar mensajes 
const mostrarMensajeRegistro = () => {

    document.getElementById('sesion-mensaje-exito').classList.add('formulario__mensaje-exito-activo');
    setTimeout(() => {
        document.getElementById('sesion-mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
    },3000);

    document.querySelectorAll('.formulario__datos-correcto').forEach((icono) => {
        icono.classList.remove('formulario__datos-correcto');
    });

}

/*Detectar cursor*/
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

/**Evento del submit */
formulario.addEventListener('submit', (e) => {
	

    /**Validar formulario */
    const terminos = document.getElementById('terminos');

    /**Codigo de registro e inicio de sesion */
    if(campos.nombre && campos.apellidos && campos.password && campos.email && terminos.checked || campos.emailSesion && campos.passwordSesion && terminos.checked){
        
        /**Envia los datos al archivo PHP administrarUsuario.php mediante ajax este procesara los datos para guardarlos*/
        $.ajax({
            type: 'POST',
            url: '../../controllers/administrarUsuario.php',
            data: $('#formulario').serialize(),
            beforeSend: function() {
                    mostrarMensajeRegistro();
            },
            success: function(msg) {
                formulario.reset();
                //console.log(msg);
                if(msg == 1){
                    alert("Gracias por registrarte revisa el mensaje que enviamos a tu correo para confirmar la cuenta");
                    window.location.href="../../index.html";
                }if(msg == 0){
                    alert("El usuario ya esta registrado, intente iniciando sesión");
                    window.location.href="iniciarSesion.html";
                }if(msg == "correcto"){
                    window.location.href="../usuario/index.php";
                }if(msg == "confirmar"){
                alert("El usuario no ha sido confirmado, revisa tu correo para confirmar tu cuenta");
                }
            }
        });
        e.preventDefault();
        
    } 
    /**Codigo para recuperar password */
    else if(campos.emailRecuperar || campos.nuevoPassword){
        
        $.ajax({
            type: 'POST',
            url: '../../controllers/administrarUsuario.php',
            data: $('#formulario').serialize(),
            beforeSend: function() {
                    mostrarMensajeRegistro();
            },
            success: function(msg){
                console.log(msg);
                formulario.reset();
                if(msg == "existe"){
                    alert("Revisa tu email");
                }if(msg == 'noEncontrado'){
                    alert("LO SENTIMOS el usuario no existe o no ha sido confirmado");
                }if(msg == 'listo'){

                }if(msg == 'error'){
                }
            }
        });
        e.preventDefault();
    }else{
        e.preventDefault();
        document.getElementById('sesion-mensaje').classList.add('formulario__mensaje-activo');
        setTimeout(() => {
            document.getElementById('sesion-mensaje').classList.remove('formulario__mensaje-activo');
        }, 5000);
    }
});

