
//declaramos las variables y obtenemos los elementos del html por su ID
let varNombre = document.getElementById("nombre");
let varCedula = document.getElementById("cedula");
let varEmail = document.getElementById("email");
let varTelefono = document.getElementById("telefono");
let varBtnRegistro = document.getElementById("btnRegistrarse");
let varPassword = document.getElementById("password");
let varVerifiedPassword = document.getElementById('verified-password');
let errorEmail = document.getElementById("error-email");
let errorpass = document.getElementById("error-pass");
//variables de validacion
let vaNombreValido = false;
let varCedulaValido = false;
let varEmailValido = false;
let varTelfonoValido = false;
let varPasswordValido = false;


//Funcion que ajusta el calendarios para preever que no se coloquen dias futuros
const FNC_CALENDARIO = () =>{
    let hoy = new Date() //Instanciamos el objeto Date en la variable hoy
    let dd = String(hoy.getDate()).padStart(2, "0")//Sacamos el dia y usamos padstart para que tenga 2 digitos 
    let mm = String(hoy.getMonth() + 1).padStart(2, "0")//Sacamos el mes y le sumamos 1 porque si no 0 seria enero y 11 diciembre
    let yyyy = hoy.getFullYear()//Sacamos el año y lo colocamos en una variable
    
    let fecha = yyyy + "-" + mm + "-" + dd //Juntamos todas las variables y lo dividimos con guiones
    document.getElementById("fechaNac").max = fecha //añadimos el atibuto max al html desde aqui y le damos el valor de la variable fecha 
}
FNC_CALENDARIO();//Llamamos o ejecutamos la funcion para que haga lo declarado arriba

//Validaciones 
//addEventListener es una funcion que queda a la escucha o a la espera del input del usuario
varNombre.addEventListener("input",  () => {
    //funcion Flecha o funcion anonima para realizar la validacion 
    if (varNombre.value.trim().length >= 5) {//si la longitud del nombre es mayor o igual a 5 hace lo siguiente 
        varNombre.style.border = "none"//desactiva el borde rojo cuando pasa la validacion
        vaNombreValido = true;
    }else{
        vaNombreValido = false;
        varNombre.style.border = "2px solid red"//pone un borde rojo al campo para indicar que algo esta mal
    }
    FNC_VALIDAR_FORM()
})
//validacion para el email
varEmail.addEventListener("input", () => {
    let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; //expresion regular para validar el email
    let valido = regex.test(varEmail.value.trim())// guardamos true o false si pasa la validacion
    if(valido){//si es true habilita el boton 
        varEmailValido = true;
        varEmail.style.border = "none"
        errorEmail.textContent = ""
    }else{
        varEmailValido = false;
        errorEmail.textContent = "Email invalido"
        varEmail.style.border = "2px solid red"
    }
    FNC_VALIDAR_FORM()
})
//validacion para la cedula
varCedula.addEventListener("input", () => {
    let regex =   /^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,6})$/i;//expresion regular para validar la cedula panameña
    let valido = regex.test(varCedula.value.trim())//guardamos true o false si pasa la validacion
    if(valido){ //si pasa la validacion de activa el boton de enviar
        varCedula.style.border = "none";
        varCedulaValido = true;
    }else{
        varCedulaValido = false;
        varCedula.style.border = "2px solid red";
    }
    FNC_VALIDAR_FORM()
})
//validacion de la contrasena
varVerifiedPassword.addEventListener("input", () => {
    if(varPassword.value === varVerifiedPassword.value){
        varPassword.style.border = "none"
        varVerifiedPassword.style.border = "none"
        errorpass.textContent = ""
        varPasswordValido = true;
    }else{
        varPasswordValido = false;
        errorpass.textContent = "Las constraseñas deben coincidir"
        varPassword.style.border = "2px solid red"
        varVerifiedPassword.style.border = "2px solid red"
    }
   FNC_VALIDAR_FORM()
})
//validacion de que sea un numero telefonico
varTelefono.addEventListener("input", () => {
    //expresion regular para validar que sea un numero de telefono 
    let regex = /[\(]?[\+]?(\d{2}|\d{3})[\)]?[\s]?((\d{6}|\d{8})|(\d{3}[\*\.\-\s]){3}|(\d{2}[\*\.\-\s]){4}|(\d{4}[\*\.\-\s]){2})|\d{8}|\d{10}|\d{12}/;
    let valido = regex.test(varTelefono.value.trim())
    if(valido){
        varTelefono.style.border = "none"
        varTelfonoValido = true;
    }else{
        varTelfonoValido = false
        varTelefono.style.border = "2px solid red";
    }
    FNC_VALIDAR_FORM()
})

function FNC_VALIDAR_FORM(){
    //funcion que valida si el formulario tienes los datos para activar el boton de enviar
    let enEdicion = document.querySelector("input[name='id_persona']").value > 0;//variable para activar el boton si esta en modo editar
    if(
        vaNombreValido && //que el campo nombre tenga mas de 5 caracteres
        varCedulaValido && // que el campo cedula no este vacio
        varEmailValido &&// que el campo email no este vacio
        varTelfonoValido &&// que el campo telefono no este vacio
        (varPasswordValido || enEdicion) // que las contrasenas sean iguales
    ){
        varBtnRegistro.disabled = false;
    }else{
        varBtnRegistro.disabled = true;
    }
}

function FNC_CONFIRMAR_ELIMINAR(id){
    Swal.fire({//libreria para la alertas bonitas 
        title: "¿Eliminar?",
        text: "No se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No"
    }).then((resultado) => {
        if(resultado.isConfirmed){
            window.location = "?eliminar=" + id;
        }
    });
}
//Revalidar el formulario para activar el boton 
window.addEventListener("load", () =>{
    if(varNombre.value.trim().length >= 5 )vaNombreValido = true;
    if(varCedula.value.trim() !== "" )varCedulaValido = true;
    if(varEmail.value.trim() !== "" )varEmailValido = true;
    if(varTelefono.value.trim() !== "" )varTelfonoValido = true;

    FNC_VALIDAR_FORM();
})
