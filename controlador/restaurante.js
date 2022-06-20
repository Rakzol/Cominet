let form_restaurante = document.forms["restaurante"];
let peticion_restaurante = new XMLHttpRequest();

form_restaurante.addEventListener("reset",(event)=>{
    event.preventDefault();
    for(let campo of form_restaurante.elements){
        if(restaurante[campo.name]){
            campo.value = restaurante[campo.name];
        }
    }
});

form_restaurante.addEventListener("submit",(event)=>{
    event.preventDefault();
    peticion_restaurante.open("POST", "modelo/restaurante/editar.php", true);
    peticion_restaurante.send(new FormData(form_restaurante));
});

peticion_restaurante.addEventListener("readystatechange",(event)=>{
    if(peticion_restaurante.readyState == 4){
        if(peticion_restaurante.status == 200){
            if(peticion_restaurante.responseText == "0"){
                for(let campo of form_restaurante.elements){
                    if(restaurante[campo.name]){
                        restaurante[campo.name] = campo.value;
                    }
                }
            }else{
                alert("Ocurrio un error inesperado al editar el restaurante, intentelo de nuevo mas tarde");
            }
        }
        else{
            alert("Hay un error con el servidor, intentelo de nuevo mas tarde: " + peticion_restaurante.status);
        }
    }
});

function iniciar_restaurante(){
    form_restaurante.reset();
    progresar(peticion_restaurante);
}