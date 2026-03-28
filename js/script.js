
//declaramos las variables y obtenemos los elementos del html por su ID
let nombre = document.getElementById("nombre");
let cedula = document.getElementById("cedula");
let email = document.getElementById("email");
let telf = document.getElementById("telefono");
let btnRegis = document.getElementById("btnRegistrarse");
let pass = document.getElementById("password");
let vpass = document.getElementById('verified-password');
let errorEmail = document.getElementById("error-email");
let errorpass = document.getElementById("error-pass");
//variables de validacion
let nombreValido = false;
let cedulaValido = false;
let emailValido = false;
let telfValido = false;
let passValido = false;


//Funcion que ajusta el calendarios para preever que no se coloquen dias futuros
const calendario = () =>{
    let hoy = new Date() //Instanciamos el objeto Date en la variable hoy
    let dd = String(hoy.getDate()).padStart(2, "0")//Sacamos el dia y usamos padstart para que tenga 2 digitos 
    let mm = String(hoy.getMonth() + 1).padStart(2, "0")//Sacamos el mes y le sumamos 1 porque si no 0 seria enero y 11 diciembre
    let yyyy = hoy.getFullYear()//Sacamos el año y lo colocamos en una variable
    
    let fecha = yyyy + "-" + mm + "-" + dd //Juntamos todas las variables y lo dividimos con guiones
    document.getElementById("fechaNac").max = fecha //añadimos el atibuto max al html desde aqui y le damos el valor de la variable fecha 
}
calendario();//Llamamos o ejecutamos la funcion para que haga lo declarado arriba

//Validaciones 
//addEventListener es una funcion que queda a la escucha o a la espera del input del usuario
nombre.addEventListener("input",  () => {
    //funcion Flecha o funcion anonima para realizar la validacion 
    if (nombre.value.trim().length >= 5) {//si la longitud del nombre es mayor o igual a 5 hace lo siguiente 
        nombre.style.border = "none"//desactiva el borde rojo cuando pasa la validacion
        nombreValido = true;
    }else{
        nombreValido = false;
        nombre.style.border = "2px solid red"//pone un borde rojo al campo para indicar que algo esta mal
    }
    validarForm()
})
//validacion para el email
email.addEventListener("input", () => {
    let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; //expresion regular para validar el email
    let valido = regex.test(email.value.trim())// guardamos true o false si pasa la validacion
    if(valido){//si es true habilita el boton 
        emailValido = true;
        email.style.border = "none"
        errorEmail.textContent = ""
    }else{
        emailValido = false;
        errorEmail.textContent = "Email invalido"
        email.style.border = "2px solid red"
    }
    validarForm()
})
//validacion para la cedula
cedula.addEventListener("input", () => {
    let regex =   /^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,6})$/i;//expresion regular para validar la cedula panameña
    let valido = regex.test(cedula.value.trim())//guardamos true o false si pasa la validacion
    if(valido){ //si pasa la validacion de activa el boton de enviar
        cedula.style.border = "none";
        cedulaValido = true;
    }else{
        cedulaValido = false;
        cedula.style.border = "2px solid red";
    }
    validarForm()
})
//validacion de la contrasena
vpass.addEventListener("input", () => {
    if(pass.value === vpass.value){
        pass.style.border = "none"
        vpass.style.border = "none"
        errorpass.textContent = ""
        passValido = true;
    }else{
        passValido = false;
        errorpass.textContent = "Las constraseñas deben coincidir"
        pass.style.border = "2px solid red"
        vpass.style.border = "2px solid red"
    }
   validarForm()
})
//validacion de que sea un numero telefonico
telf.addEventListener("input", () => {
    //expresion regular para validar que sea un numero de telefono 
    let regex = /[\(]?[\+]?(\d{2}|\d{3})[\)]?[\s]?((\d{6}|\d{8})|(\d{3}[\*\.\-\s]){3}|(\d{2}[\*\.\-\s]){4}|(\d{4}[\*\.\-\s]){2})|\d{8}|\d{10}|\d{12}/;
    let valido = regex.test(telf.value.trim())
    if(valido){
        telf.style.border = "none"
        telfValido = true;
    }else{
        telfValido = false
        telf.style.border = "2px solid red";
    }
    validarForm()
})

function validarForm(){
    //funcion que valida si el formulario tienes los datos para activar el boton de enviar
    let enEdicion = document.querySelector("input[name='id_persona']").value > 0;//variable para activar el boton si esta en modo editar
    if(
        nombreValido && //que el campo nombre tenga mas de 5 caracteres
        cedulaValido && // que el campo cedula no este vacio
        emailValido &&// que el campo email no este vacio
        telfValido &&// que el campo telefono no este vacio
        (passValido || enEdicion) // que las contrasenas sean iguales
    ){
        btnRegis.disabled = false;
    }else{
        btnRegis.disabled = true;
    }
}

function confirmarEliminar(id){
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
    if(nombre.value.trim().length >= 5 )nombreValido = true;
    if(cedula.value.trim() !== "" )cedulaValido = true;
    if(email.value.trim() !== "" )emailValido = true;
    if(telf.value.trim() !== "" )telfValido = true;

    validarForm();
})
