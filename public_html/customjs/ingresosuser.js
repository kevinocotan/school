//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const formIngresos=document.querySelector("#formIngresos");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
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
    btnNew.addEventListener("click",agregarIngreso);
    btnCancelar.addEventListener("click",cancelarIngreso);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    formIngresos.addEventListener("submit",guardarIngreso);
}

//Funciones

function guardarIngreso(event) {
    event.preventDefault();
    const formData=new FormData(formIngresos);
    //console.log(formData);
    API.post(formData,"ingresosuser/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success) {
                cancelarIngreso();
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
    API.get("ingresosuser/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarServicios();
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

function cargarServicios() {
    API.get("serviciosuser/getAll").then(
        data=>{
            if (data.success) {
                const txtServicio=document.querySelector("#id_servicio");             
                txtServicio.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const {id_servicio,descripcion}=item;
                        const optionServicio=document.createElement("option");
                        optionServicio.value=id_servicio;
                        optionServicio.textContent=descripcion;
                        txtServicio.append(optionServicio);
                    }
                );
            }
            cargarProducto();
        }
    ).catch(
        error=>{
            console.error("Error:", error);
        }
    );
}

function cargarProducto() {
    API.get("productosuser/getAll").then(
        data=>{
            if (data.success) {
                const txtProducto=document.querySelector("#id_producto");
                txtProducto.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const {id_producto,nombre}=item;
                        const optionProducto=document.createElement("option");
                        optionProducto.value=id_producto;
                        optionProducto.textContent=nombre;
                        txtProducto.append(optionProducto);
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
            cargarClientes();
        }
    ).catch(
        error=>{
            console.error("Error:", error);
        }
    );
}

function cargarClientes() {
    API.get("clientes/getAll").then(
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
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}


function crearTabla() {
    if (objDatos.filter==""){
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(
            item=>{
                const {fecha, metodopago, nombres, nombrescliente, apellidos, descripcion, precios, nombre, cantidad_producto, comentario, precio}=item;
                if (fecha.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (metodopago.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (nombres.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (nombrescliente.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (apellidos.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (descripcion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (precios.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (nombre.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (cantidad_producto.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (comentario.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (precio.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }

            }
        );
    }
    const recordIni=(objDatos.currentPage*objDatos.recordsShow)-objDatos.recordsShow;
    const recordFin=(recordIni+objDatos.recordsShow)-1;
    let html="";
    console.log(recordIni,recordFin);
    objDatos.recordsFilter.forEach(
        (item,index)=>{
            if ((index>=recordIni) && (index<=recordFin)) {
                html+=`
                    <tr>
                    <td>${index+1}</td>
                    <td>${item.fecha}</td>
                    <td>${item.metodopago}</td>
                    <td>${item.nombres}</td>
                    <td>${item.nombrescliente}</td>
                    <td>${item.apellidos}</td>
                    <td>${item.descripcion}</td>
                    <td>$${item.precios}</td>
                    <td>${item.nombre}</td>
                    <td>${item.cantidad_producto}</td>
                    <td>$${item.precio}</td>
                    <td>$${item.total}</td>
                    <td>${item.comentario}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarIngreso(${item.id_ingreso})"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="EliminarIngreso(${item.id_ingreso})"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                `;
            }
        }
    );
    tableContent.innerHTML=html;
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

function agregarIngreso() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formIngresos.reset();
    document.querySelector("#id_ingreso").value="0";
}

function cancelarIngreso() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarIngreso(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("ingresosuser/getOneIngreso?id="+id).then(
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
    const {id_ingreso, fecha, id_servicio, id_producto, cantidad_producto, comentario, id_empleado, id_cliente, metodopago}=record;
    document.querySelector("#id_ingreso").value=id_ingreso;
    document.querySelector("#fecha").value=fecha;
    document.querySelector("#id_empleado").value=id_empleado;
    document.querySelector("#id_cliente").value=id_cliente;
    document.querySelector("#id_servicio").value=id_servicio;
    document.querySelector("#id_producto").value=id_producto;
    document.querySelector("#cantidad_producto").value=cantidad_producto;
    document.querySelector("#comentario").value=comentario;
    document.querySelector("#metodopago").value=metodopago;
}

function EliminarIngreso(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed) {
                API.get("ingresosuser/deleteIngreso?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarIngreso();
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