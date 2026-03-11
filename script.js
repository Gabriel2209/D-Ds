
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
document.getElementById("nombre").addEventListener("input",  () => {
    //funcion Flecha o funcion anonima para realizar la validacion 
    if (nombre.value.trim().length >= 5) {//si la longitud del nombre es mayor o igual a 5 hace lo siguiente
        btnRegis.disabled = false;//Activa el boton de enviar 
        nombre.style.border = "none"//desactiva el borde rojo cuando pasa la validacion
    }else{//en cualquier otro caso el boton enviar esta desactivado 
        nombre.style.border = "2px solid red"//pone un borde rojo al campo para indicar que algo esta mal
        btnRegis.disabled = true;
    }
})
//validacion para el email
email.addEventListener("input", () => {
    let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; //expresion regular para validar el email
    let valido = regex.test(email.value.trim())// guardamos true o false si pasa la validacion
    if(valido){//si es true habilita el boton 
        btnRegis.disabled = false;
        email.style.border = "none"
        errorEmail.textContent = ""
    }else{//si no pasa la validacion se mantiene inactivo
        errorEmail.textContent = "Email invalido"
        email.style.border = "2px solid red"
        btnRegis.disabled = true;
    }
})
//validacion para la cedula
cedula.addEventListener("input", () => {
    let regex =   /^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,6})$/i;//expresion regular para validar la cedula panameña
    let valido = regex.test(cedula.value.trim())//guardamos true o false si pasa la validacion
    if(valido){ //si pasa la validacion de activa el boton de enviar
        btnRegis.disabled = false;
        cedula.style.border = "none";
    }else{//si no pasa la validacion se mantiene inactivo
        cedula.style.border = "2px solid red";
        btnRegis.disabled = true;
    }
})
//validacion de la contrasena
vpass.addEventListener("input", () => {
    if(pass.value === vpass.value){
        pass.style.border = "2px solid green"
        pass.style.border = "none"
        vpass.style.border = "none"
        btnRegis.disabled = false;
        errorpass.textContent = ""
    }else{
        errorpass.textContent = "Las constraseñas deben coincidir"
        pass.style.border = "2px solid red"
        vpass.style.border = "2px solid red"
        btnRegis.disabled = true;
    }
})
telf.addEventListener("input", () => {
    let regex = /[\(]?[\+]?(\d{2}|\d{3})[\)]?[\s]?((\d{6}|\d{8})|(\d{3}[\*\.\-\s]){3}|(\d{2}[\*\.\-\s]){4}|(\d{4}[\*\.\-\s]){2})|\d{8}|\d{10}|\d{12}/;
    let valido = regex.test(telf.value.trim())
    if(valido){
        telf.style.border = "2px solid green"
        telf.style.border = "none"
        btnRegis.disabled = false;
    }else{
        telf.style.border = "2px solid red"
        btnRegis.disabled = true;
    }
})
