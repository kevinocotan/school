//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formCita=document.querySelector("#formCita");
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
    btnNew.addEventListener("click",agregarCita);
    btnCancelar.addEventListener("click",cancelarCita);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded",cargarDatos);
    //console.log("Despues de cargar");
    searchText.addEventListener("input", aplicarFiltro);
    formCita.addEventListener("submit",guardarCita);
}

//Funciones

function guardarCita(event) {
    event.preventDefault();
    const formData=new FormData(formCita);
    //console.log(formData);
    API.post(formData,"citasuser/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success) {
                cancelarCita();
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
        error=> {
            console.log("Error:",error);
        }
    );
}

function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function cargarDatos() {
    //console.log("Cargando datos");
    API.get("citasuser/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarClientes();
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


function cargarClientes() {
    API.get("clientesuser/getAll").then(
        data=>{
            if(data.success) {
                const txtCliente=document.querySelector("#id_cliente");
                txtCliente.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const {id_cliente,nombrescliente}=item;
                        const optionCliente=document.createElement("option");
                        optionCliente.value=id_cliente;
                        optionCliente.textContent=nombrescliente;                     
                        txtCliente.append(optionCliente);
                    }
                );
            }
            cargarEmpleado();
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}

/*function cargarClientes() {
    API.get("clientesuser/getAll").then(
        data => {
            if (data.success) {
                const txtCliente = document.querySelector("#id_cliente");
                txtCliente.innerHTML = "";
                data.records.forEach(
                    (item, index) => {
                        const { id_cliente, nombrescliente, apellidoscliente } = item; // Corregido: asignar a "apellidoscliente" en lugar de "nombres"
                        const optionCliente = document.createElement("option");
                        optionCliente.value = id_cliente;
                        optionCliente.textContent = `${nombrescliente} ${apellidos_cliente}`; // Modificado: mostrar nombres y apellidos del cliente
                        txtCliente.append(optionCliente);
                    }
                );
            }
            cargarEmpleado();
        }
    ).catch(
        error => {
            console.error("Error:", error);
        }
    );
}

CON ESTA FUNCION SE CONCATENA EL NOMBRE Y APELLIDO AL CARGARLO EN EL COMBO
*/


function cargarEmpleado() {
    API.get("empleados/getAll").then(
        data=>{
            if (data.success) {
                const txtEmpleado=document.querySelector("#id_empleado");
                txtEmpleado.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const {id_empleado,nombres}=item;
                        const optionEmpleado=document.createElement("option");
                        optionEmpleado.value=id_empleado;
                        optionEmpleado.textContent=nombres;
                        txtEmpleado.append(optionEmpleado);
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

function crearTabla() {
    if (objDatos.filter == "") {
        objDatos.recordsFilter = objDatos.records.map(item => item);
    } else {
        objDatos.recordsFilter = objDatos.records.filter(
            item => {
                const { id_cita, descripcion, fecha, hora, nombres, apellidos, nombrescliente, apellidos_cliente} = item;
                if (id_cita.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
                if (descripcion.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
                if (fecha.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
                if (hora.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
                if (nombres.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
                if (apellidos.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
                if (nombrescliente.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
                if (apellidos_cliente.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
                    return item;
                }
            }
        );
    }
    const recordIni = (objDatos.currentPage * objDatos.recordsShow) - objDatos.recordsShow;
    const recordFin = (recordIni + objDatos.recordsShow) - 1;
    let html = "";
    objDatos.recordsFilter.forEach(
        (item, index) => {
            if ((index >= recordIni) && (index <= recordFin)) {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.fecha}</td>
                        <td>${item.hora}</td>
                        <td>${item.nombres}</td>
                        <td>${item.apellidos}</td>
                        <td>${item.nombrescliente}</td>
                        <td>${item.apellidos_cliente}</td>
                        <td>${item.descripcion}</td>
                        <td>
                            <button type="button" class="btn btn-dark btncolor" onclick="editarCita(${item.id_cita})"><i class="bi bi-pencil-square"></i></button>
                            <button type="button" class="btn btn-danger btncolor" onclick="deleteCita(${item.id_cita})"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                `;
            }
        }
    );
    tableContent.innerHTML = html;
    crearPaginacion();
}

function crearPaginacion() {
    //Borrar elementos
    pagination.innerHTML="";
    //Boton Anterior
    const elAnterior=document.createElement("li");
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML=`<a class="page-link" href="#">Previous</a>`;
    elAnterior.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1 : --objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elAnterior);
    //Agregando los numeros de pagina
    const totalPage=Math.ceil(objDatos.recordsFilter.length/objDatos.recordsShow);
    for (let i=1; i<=totalPage;i++) {
        const el=document.createElement("li");
        el.classList.add("page-item");
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=> {
            objDatos.currentPage=i;
            crearTabla();
        }
        pagination.append(el);
    }
    //Boton siguiente
    const elSiguiente=document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML=`<a class="page-link" href="#">Next</a>`;
    elSiguiente.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage : ++objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elSiguiente);
}

function agregarCita() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formCita.reset();
    document.querySelector("#id_cita").value="0";
}

function cancelarCita() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarCita(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("citasuser/getOneCita?id="+id).then(
        data=>{
            if (data.success) {
                mostrarDatosForm(data.records[0]);
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
            console.error("Error:",error);
        }
    );
}

function mostrarDatosForm(record) {
    const {id_cita, id_empleado, id_cliente, descripcion, fecha, hora}=record;
    document.querySelector("#id_cita").value=id_cita;
    document.querySelector("#id_empleado").value=id_empleado;
    document.querySelector("#id_cliente").value=id_cliente;
    document.querySelector("#descripcion").value=descripcion;
    document.querySelector("#fecha").value=fecha;
    document.querySelector("#hora").value=hora;
}

function deleteCita(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar la cita?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed) {
                API.get("citasuser/deleteCita?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarCita();
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
        }       
    );
    console.log("Mensaje de texto");
}