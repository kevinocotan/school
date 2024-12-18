//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formPadre=document.querySelector("#formPadre");
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:10,
    filter:""
}


//Configuracion de eventos
eventListiners();
function eventListiners() {
    btnNew.addEventListener("click",agregarPadre);
    btnCancelar.addEventListener("click",cancelarPadre);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded",cargarDatos);
    //console.log("Despues de cargar");
    searchText.addEventListener("input",aplicarFiltro);
    formPadre.addEventListener("submit",guardarPadre);

}

//Funciones

function guardarPadre(event){
    event.preventDefault();
    const formData = new FormData(formPadre);
    //console.log(formData);
    API.post(formData,"padres/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success){
                cancelarPadre();
                Swal.fire({
                    icon:"info",
                    text:data.msg
                });
            } else {
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                });
            }
        }
    ).catch(
        error=>{
            console.log("Error:",error);
        }
    );
}

function aplicarFiltro (element) {
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function cargarDatos() {
    API.get("padres/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
            } else {
                console.log("Error al recuperar los registros");
            }
        }
    ).catch(
        error=>{
            console.error("Error en la llamada:",error);
        }
    );
}

function crearTabla() {
    if (objDatos.filter==""){
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(
            item=>{
                const {nombre, direccion, telefono }=item;
                if (nombre.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (direccion.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (telefono.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                
            }
        );
    }

    const recordIni=(objDatos.currentPage*objDatos.recordsShow)-objDatos.recordsShow;

    const recordFin=(recordIni+objDatos.recordsShow)-1;

    let html="";
    objDatos.recordsFilter.forEach(
        (item,index)=>{
            if ((index>=recordIni) && (index<=recordFin)){
                        
                html+=`
                    <tr>
                    <td>${index+1}</td>
                    <td>${item.nombre}</td>
                    <td>${item.direccion}</td>
                    <td>${item.telefono}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarPadre(${item.id_padre})"><i class="ri-edit-fill"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarPadre(${item.id_padre})"><i class="ri-delete-bin-7-line"></i></button>
                    </td>
                    </tr>
                
                `;
            }
        }
    );
    //console.log(html);
    tableContent.innerHTML=html;
    crearPaginacion(); 
}

function crearPaginacion(){
    //Borrar elementos
    pagination.innerHTML="";

    //Boton Anterior
    const elAnterior=document.createElement("li")
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML=`<a class="page-link" href="#">Previous</a>`;
    elAnterior.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1 : --objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elAnterior);

    //Agregando los numeors de pagina

    const totalPage=Math.ceil(objDatos.recordsFilter.length/objDatos.recordsShow);
    for (let i=1; i<=totalPage; i++) {
        const el=document.createElement("li");
        el.classList.add("page=item");
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=> {
            objDatos.currentPage=i;
            crearTabla();
        }
        pagination.append(el);
    }

    //Bonton siguiente
    const elSiguiente=document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML=`<a class="page-link" href="#">Next</a>`;
    elSiguiente.onclick=()=> {
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage : ++objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elSiguiente);
    
}

function agregarPadre() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formPadre.reset();
    document.querySelector("#id_padre").value="0";
}

function cancelarPadre() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarPadre(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("padres/getOnePadre?id="+id).then(
        data=>{
            if (data.success) {
                mostrarDatosForm(data.records[0]);
            } else {
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                })
            }
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}

function mostrarDatosForm(record) {
    const {id_padre, nombre, direccion, telefono} = record;
    document.querySelector("#id_padre").value = id_padre;
    document.querySelector("#nombre").value = nombre;
    document.querySelector("#direccion").value = direccion;
    document.querySelector("#telefono").value = telefono;
}



function eliminarPadre(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed){
                API.get("padres/deletePadre?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarPadre();
                            Swal.fire({
                                icon:"info",
                                text:data.msg
                            });
                        } else {
                            Swal.fire({
                                icon:"error",
                                title:"Error",
                                text:data.msg
                            });
                        }
                    }
                ).catch(
                    error=>{
                        console.log("Error",error);
                    }
                );                
            }
        }
    ); 
    console.log("Mensaje de texto");
}