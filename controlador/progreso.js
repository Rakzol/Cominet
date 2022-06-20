let progreso = document.getElementById("progreso");
function progresar(solicitud_xml){
    solicitud_xml.upload.addEventListener("progress",(datos)=>{
        if(datos.lengthComputable) {
            progreso.value = (datos.loaded / datos.total) * 100;
        }
    });
    solicitud_xml.upload.addEventListener("loadstart",()=>{
        progreso.value = 0;
        progreso.classList.remove("invisible");
    });
    solicitud_xml.upload.addEventListener("loadend",()=>{
        progreso.classList.add("invisible");
    });
}