//variables y selectores

const btnViewReport=document.querySelector("#btnViewReport");
const idEgreso=document.querySelector("#id_egreso");
const mesfiltro=document.querySelector("#mes");
const aniofiltro=document.querySelector("#anio");
const frameReporte=document.querySelector("#framereporte");
const filtro=document.querySelector("#filtro");
const API=new Api()

eventListener();

function eventListener(){
    document.addEventListener("DOMContentLoaded", cargarDatos);
    btnViewReport.addEventListener("click", verReporte);
    filtro.addEventListener("change",mostrarFiltro)
}

//Funciones

function mostrarFiltro() {
    switch (filtro.value) {
        case "1":
            document.querySelectorAll(".filtrodia").forEach(item=>item.classList.remove("d-none"));
            document.querySelectorAll(".filtromes").forEach(item=>item.classList.add("d-none"));
            break;
        case "2":
            document.querySelectorAll(".filtrodia").forEach(item=>item.classList.add("d-none"));
            document.querySelectorAll(".filtromes").forEach(item=>item.classList.remove("d-none"));
            break;
        default:
            break;
    }
}

function cargarDatos() {
    API.get("egresos/getFechasPorEgresos").then(
        data=>{
            if (data.success) {
                idEgreso.innerHTML="";
                const optionEgreso=document.createElement("option");
                optionEgreso.value="0";
                optionEgreso.textContent="Todos";
                idEgreso.append(optionEgreso);
                data.records.forEach(
                    (item,index)=>{
                        const {id_egreso,fecha}=item;
                        const optionEgreso=document.createElement("option");
                        optionEgreso.value=id_egreso;
                        optionEgreso.textContent=fecha;
                        idEgreso.append(optionEgreso);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error:", error);
        }
    );
}

function verReporte(){
    switch (filtro.value) {
        case "1":
            frameReporte.src=`${BASE_API}reporteegresos/getReporte?idegreso=${idEgreso.value}`;
            break;
        case "2":
            frameReporte.src=`${BASE_API}reporteegresos/getReporte?mes=${mesfiltro.value}&anio=${aniofiltro.value}`;
            break;
        default:
            break;
    }
    
}