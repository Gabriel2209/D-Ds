


let hoy = new Date()

let dd = String(hoy.getDate()).padStart(2, "0")
let mm = String(hoy.getMonth() + 1).padStart(2, "0")
let yyyy = hoy.getFullYear()

let fecha = yyyy + "-" + mm + "-" + dd
document.getElementById("fechaNac").max = fecha

let nombre = document.getElementById("nombre")

if(nombre.length < 5){
    document.getElementById("btnRegistrarse").setAttribute("disabled", true)
}else{
    document.getElementById("btnRegistrarse").setAttribute("disabled", false)
}
