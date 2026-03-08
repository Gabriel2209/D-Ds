let nombre = document.getElementById("nombre");
let cedula = document.getElementById("cedula");
let email = document.getElementById("email");
let btnRegis = document.getElementById("btnRegistrarse");
let pass = document.getElementById("password");
let vpass = document.getElementById('verified-password');
let error = document.getElementById("error");

const calendario = () =>{
    let hoy = new Date()
    let dd = String(hoy.getDate()).padStart(2, "0")
    let mm = String(hoy.getMonth() + 1).padStart(2, "0")
    let yyyy = hoy.getFullYear()
    
    let fecha = yyyy + "-" + mm + "-" + dd
    document.getElementById("fechaNac").max = fecha
}
calendario();


document.getElementById("nombre").addEventListener("input",  () => {
    
    if (nombre.value.trim().length >= 5) {
        btnRegis.disabled = false;
        nombre.style.border = "none"
    }else{
        nombre.style.border = "2px solid red"
        btnRegis.disabled = true;
    }
})

email.addEventListener("input", () => {
    if(email.value.length >= 5){
        btnRegis.disabled = false;
        email.style.border = "none"
        error.textContent = ""
    }else{
        error.textContent = "Email invalido"
        email.style.border = "2px solid red"
        btnRegis.disabled = true;
    }
})

cedula.addEventListener("input", () => {
    if(cedula.value.length >= 5){
        btnRegis.disabled = false;
        cedula.style.border = "none";
    }else{
        cedula.style.border = "2px solid red";
        btnRegis.disabled = true;
    }
})

vpass.addEventListener("input", () => {
    if(pass.value === vpass.value){
        pass.style.border = "2px solid green"
        pass.style.border = "none"
        vpass.style.border = "none"
        btnRegis.disabled = false;
        error.textContent = ""
    }else{
        error.textContent = "Las constraseñas deben coincidir"
        pass.style.border = "2px solid red"
        vpass.style.border = "2px solid red"
        btnRegis.disabled = true;
    }
})
