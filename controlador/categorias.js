let form_categorias = document.forms["categorias"];
let selector_categoria = form_categorias.elements["categoria"];
let categorias = [];
let peticion_categorias = new XMLHttpRequest();

function actualizar_categorias(){
    let seleccion = selector_categoria.value ? selector_categoria.value : "Todas";
    categorias.sort();
    selector_categoria.replaceChildren();
    let todas = document.createElement("option");
    todas.innerText = "Todas";
    selector_categoria.appendChild(todas);
    categorias.forEach((nombre)=>{
        let option = document.createElement("option");
        option.innerText = nombre;
        selector_categoria.appendChild(option);
    });
    selector_categoria.value = seleccion;
}

function iniciar_categorias(){
    platillos.forEach((platillo)=>{
        if(!categorias.includes(platillo["categoria"])){
            categorias.push(platillo["categoria"]);
        }
    });
    actualizar_categorias();
    progresar(peticion_categorias);
}

selector_categoria.addEventListener("change",()=>{
    peticion_categorias.open("POST", "modelo/restaurante/categorias.php", true);
    peticion_categorias.send(new FormData(form_categorias));
});

peticion_categorias.addEventListener("readystatechange",(event)=>{
    if(peticion_categorias.readyState == 4){
        if(peticion_categorias.status == 200){
            if(peticion_categorias.responseText != ""){
                platillos = JSON.parse(peticion_categorias.responseText);
                iniciar_platillos();
            }else{
                alert("Ocurrio un error inesperado al consultar la categoria, intentelo de nuevo mas tarde");
            }
        }
        else{
            alert("Hay un error con el servidor, intentelo de nuevo mas tarde: " + peticion_categorias.status);
        }
    }
});