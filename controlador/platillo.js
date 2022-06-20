let form_platillo = document.forms["platillo"];
let imagen_platillo = form_platillo.children[0].children[0];
let archivo_platillo = form_platillo.elements["imagen"];
let peticion_platillo = new XMLHttpRequest();

archivo_platillo.addEventListener("change", () => {
    window.URL.revokeObjectURL(imagen_platillo.src);
    imagen_platillo.src = window.URL.createObjectURL(archivo_platillo.files[0]);
});

form_platillo.addEventListener("reset", (event) => {
    window.URL.revokeObjectURL(imagen_platillo.src);
    imagen_platillo.src = "vista/subir.png";
});

form_platillo.addEventListener("submit",(event)=>{
    event.preventDefault();
    peticion_platillo.open("POST", "modelo/restaurante/guardar_platillo.php", true);
    peticion_platillo.send(new FormData(form_platillo));
});

peticion_platillo.addEventListener("readystatechange", (event) => {
    if (peticion_platillo.readyState == 4) {
        if (peticion_platillo.status == 200) {
            if (peticion_platillo.responseText != "") {
                let platillo_datos = new FormData(form_platillo);
                platillo_datos.delete("imagen");
                platillo_datos.append("id",peticion_platillo.responseText);
                let platillo = Object.fromEntries(platillo_datos.entries());
                platillos.push(platillo);
                agregar_platillo(platillo);
                if (!categorias.includes(platillo["categoria"])) {
                    categorias.push(platillo["categoria"]);
                    actualizar_categorias();
                }
                form_platillo.reset();
            } else {
                alert("La imagen es muy pesada");
            }
        }
        else {
            alert("Hay un error con el servidor, intentelo de nuevo mas tarde: " + peticion_platillo.status);
        }
    }
});

function iniciar_platillo(){
    progresar(peticion_platillo);
}