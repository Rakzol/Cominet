let contenedor_platillos = document.getElementById("platillos");

function iniciar_platillos() {
    contenedor_platillos.replaceChildren();
    platillos.forEach((platillo) => {
        agregar_platillo(platillo);
    });
}

function agregar_platillo(platillo) {
    let form = document.createElement("form");
    let peticion_platillos = new XMLHttpRequest();
    let peticion_platillos_eliminar = new XMLHttpRequest();

    let imagen = document.createElement("img");
    imagen.classList.add("margen");
    imagen.src = "modelo/restaurante/" + restaurante["id"] + "/platillos/" + platillo["id"];
    let archivo = document.createElement("input");
    archivo.type = "file";
    archivo.name = "imagen";
    let etiqueta_nombre = document.createElement("lable");
    etiqueta_nombre.innerText = "Nombre";
    let nombre = document.createElement("input");
    nombre.type = "text";
    nombre.name = "nombre";
    nombre.required = true;
    nombre.value = platillo["nombre"];
    let etiqueta_categoria = document.createElement("lable");
    etiqueta_categoria.innerText = "Categoria";
    let categoria = document.createElement("input");
    categoria.type = "text";
    categoria.name = "categoria";
    categoria.required = true;
    categoria.value = platillo["categoria"];
    let etiqueta_descripcion = document.createElement("lable");
    etiqueta_descripcion.innerText = "Descripcion";
    let descripcion = document.createElement("textarea");
    descripcion.name = "descripcion";
    descripcion.required = true;
    descripcion.value = platillo["descripcion"];
    let etiqueta_precio = document.createElement("lable");
    etiqueta_precio.innerText = "Precio";
    let precio = document.createElement("input");
    precio.step = "0.1";
    precio.type = "number";
    precio.name = "precio";
    precio.required = true;
    precio.value = platillo["precio"];
    let editar = document.createElement("input");
    editar.type = "submit";
    editar.value = "Editar";
    let borrar = document.createElement("input");
    borrar.type = "button";
    borrar.value = "Borrar";
    let cancelar = document.createElement("input");
    cancelar.type = "reset";
    cancelar.value = "Cancelar";

    archivo.addEventListener("change", () => {
        window.URL.revokeObjectURL(imagen.src);
        imagen.src = window.URL.createObjectURL(archivo.files[0]);
    });

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        let datos = new FormData(form);
        datos.append("id", platillo["id"]);
        peticion_platillos.open("POST", "modelo/restaurante/editar_platillo.php", true);
        peticion_platillos.send(datos);
    });

    peticion_platillos.addEventListener("readystatechange", (event) => {
        if (peticion_platillos.readyState == 4) {
            if (peticion_platillos.status == 200) {
                if (peticion_platillos.responseText == "0") {
                    window.URL.revokeObjectURL(imagen.src);
                    imagen.src = "modelo/restaurante/" + restaurante["id"] + "/platillos/" + platillo["id"];
                    archivo.value = "";
                    for (let campo of form.elements) {
                        if (platillo[campo.name]) {
                            platillo[campo.name] = campo.value;
                        }
                    }
                    if (!categorias.includes(platillo["categoria"])) {
                        categorias.push(platillo["categoria"]);
                        actualizar_categorias();
                    }
                } else {
                    alert("La imagen es muy pesada");
                }
            }
            else {
                alert("Hay un error con el servidor, intentelo de nuevo mas tarde: " + peticion_platillos.status);
            }
        }
    });

    borrar.addEventListener("click", () => {
        let datos = new FormData();
        datos.append("id", platillo["id"]);
        peticion_platillos_eliminar.open("POST", "modelo/restaurante/eliminar_platillo.php", true);
        peticion_platillos_eliminar.send(datos);
    });

    peticion_platillos_eliminar.addEventListener("readystatechange", (event) => {
        if (peticion_platillos_eliminar.readyState == 4) {
            if (peticion_platillos_eliminar.status == 200) {
                if (peticion_platillos_eliminar.responseText == "0") {
                    form.remove();
                    platillos.splice(platillos.indexOf(platillo), 1);
                } else {
                    alert("Ocurrio un error inesperado al eliminar el platillo, intentelo de nuevo mas tarde");
                }
            }
            else {
                alert("Hay un error con el servidor, intentelo de nuevo mas tarde: " + peticion_platillos_eliminar.status);
            }
        }
    });

    form.addEventListener("reset", (event) => {
        event.preventDefault();
        window.URL.revokeObjectURL(imagen.src);
        imagen.src = "modelo/restaurante/" + restaurante["id"] + "/platillos/" + platillo["id"];
        archivo.value = "";
        for (let campo of form.elements) {
            if (platillo[campo.name]) {
                campo.value = platillo[campo.name];
            }
        }
    });

    progresar(peticion_platillos);
    progresar(peticion_platillos_eliminar);

    form.appendChild(imagen);
    form.appendChild(archivo);
    form.appendChild(etiqueta_nombre);
    form.appendChild(nombre);
    form.appendChild(etiqueta_categoria);
    form.appendChild(categoria);
    form.appendChild(etiqueta_descripcion);
    form.appendChild(descripcion);
    form.appendChild(etiqueta_precio);
    form.appendChild(precio);
    form.appendChild(editar);
    form.appendChild(borrar);
    form.appendChild(cancelar);
    contenedor_platillos.appendChild(form);

}