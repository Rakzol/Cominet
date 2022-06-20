let form_galeria = document.forms["galeria"];
let galeria = document.getElementById("imagenes");

let peticion_galeria = new XMLHttpRequest();

form_galeria.elements["imagen"].addEventListener("change",()=>{
    peticion_galeria.open("POST", "modelo/restaurante/subir_galeria.php", true);
    peticion_galeria.send(new FormData(form_galeria));
});

peticion_galeria.addEventListener("readystatechange", () => {
    if (peticion_galeria.readyState == 4) {
        form_galeria.reset();
        if (peticion_galeria.status == 200) {
            if (peticion_galeria.responseText != "") {
                imagenes.push(peticion_galeria.responseText);
                agregar_galeria(peticion_galeria.responseText);
            } else {
                alert("La imagen es muy pesada");
            }
        }
        else {
            alert("Hay un error con el servidor, intentelo de nuevo mas tarde: " + peticion_galeria.status);
        }
    }
});

function agregar_galeria(nombre) {
    let div = document.createElement("div");
    let img = document.createElement("img");
    let peticion_galeria_eliminar = new XMLHttpRequest();
    img.src = "modelo/restaurante/" + restaurante["id"] + "/galeria/" + nombre;
    div.appendChild(img);
    let button = document.createElement("button");
    button.innerText = "Eliminar";
    button.addEventListener("click", () => {
        let datos = new FormData();
        datos.append("imagen", nombre);
        peticion_galeria_eliminar.open("POST", "modelo/restaurante/eliminar_galeria.php", true);
        peticion_galeria_eliminar.send(datos);
    });

    peticion_galeria_eliminar.addEventListener("readystatechange", () => {
        if (peticion_galeria_eliminar.readyState == 4) {
            if (peticion_galeria_eliminar.status == 200) {
                if (peticion_galeria_eliminar.responseText == "0") {
                    div.remove();
                    imagenes.splice(imagenes.indexOf(nombre), 1);
                } else {
                    alert("Ocurrio un error inesperado al eliminar la imagen, itentelo de nuevo mas tarde");
                }
            }
            else {
                alert("Hay un error con el servidor, intentelo de nuevo mas tarde: " + peticion_galeria_eliminar.status);
            }
        }
    });

    progresar(peticion_galeria_eliminar);

    div.appendChild(button);
    galeria.appendChild(div);
}

function iniciar_galeria(){
    imagenes.forEach((nombre)=>{
        agregar_galeria(nombre);
    });
    progresar(peticion_galeria);
}