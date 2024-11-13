//variables y selectores

const btnViewReport=document.querySelector("#btnViewReport");
const idIngreso=document.querySelector("#id_ingreso");
const idEmpleado=document.querySelector("#id_empleado");
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
    API.get("ingresos/getFechasPorIngresos").then(
        data=>{
            if (data.success) {
                idIngreso.innerHTML="";
                const optionIngreso=document.createElement("option");
                optionIngreso.value="0";
                optionIngreso.textContent="Todos";
                idIngreso.append(optionIngreso);
                data.records.forEach(
                    (item,index)=>{
                        const {id_ingreso,fecha}=item;
                        const optionIngreso=document.createElement("option");
                        optionIngreso.value=id_ingreso;
                        optionIngreso.textContent=fecha;
                        idIngreso.append(optionIngreso);
                    }
                );
            }
            cargarEmpleado();
        }
    ).catch(
        error=>{
            console.error("Error:", error);
        }
    );
}

function cargarEmpleado() {
    API.get("empleados/getAll").then(
        data=>{
            if (data.success) {
                idEmpleado.innerHTML="";
                const optionEmpleado=document.createElement("option");
                optionEmpleado.value="0";
                optionEmpleado.textContent="Todos";
                idEmpleado.append(optionEmpleado);
                data.records.forEach(
                    (item,index)=>{
                        const {id_empleado,nombres}=item;
                        const optionEmpleado=document.createElement("option");
                        optionEmpleado.value=id_empleado;
                        optionEmpleado.textContent=nombres;
                        idEmpleado.append(optionEmpleado);
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
            frameReporte.src=`${BASE_API}reporteproductos/getReporte?idingreso=${idIngreso.value}&idempleado=${idEmpleado.value}`;
            break;
        case "2":
            frameReporte.src=`${BASE_API}reporteproductos/getReporte?mes=${mesfiltro.value}&anio=${aniofiltro.value}&idempleado=${idEmpleado.value}`;
            break;
        default:
            break;
    }
    
}