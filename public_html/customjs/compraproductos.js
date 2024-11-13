//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const formCompraProducto=document.querySelector("#formCompraProducto");
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
    btnNew.addEventListener("click",agregarCompraProducto);
    btnCancelar.addEventListener("click",cancelarCompraProducto);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    formCompraProducto.addEventListener("submit",guardarCompraProducto);
}

//Funciones

function guardarCompraProducto(event) {
    event.preventDefault();
    const formData=new FormData(formCompraProducto);
    //console.log(formData);
    API.post(formData,"compraproductos/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success) {
                cancelarCompraProducto();
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
    API.get("compraproductos/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarProducto();
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

function cargarProducto() {
    API.get("productos/getAll").then(
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
            cargarProveedor();
        }
    ).catch(
        error=>{
            console.error("Error:", error);
        }
    );
}

function cargarProveedor() {
    API.get("proveedores/getAll").then(
        data=>{
            if (data.success) {
                const txtProveedor=document.querySelector("#id_proveedor");
                txtProveedor.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const {id_proveedor,empresa}=item;
                        const optionProveedor=document.createElement("option");
                        optionProveedor.value=id_proveedor;
                        optionProveedor.textContent=empresa;
                        txtProveedor.append(optionProveedor);
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
    if (objDatos.filter==""){
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(
            item=>{
                const {fecha_compra, nombre, empresa, descripcion_compra, cantidad, precio, total_compra}=item;
                if (fecha_compra.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (nombre.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (empresa.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (descripcion_compra.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (cantidad.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (precio.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                    return item;
                }
                if (total_compra.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.fecha_compra}</td>
                    <td>${item.nombre}</td>
                    <td>${item.empresa}</td>
                    <td>${item.descripcion_compra}</td>
                    <td>${item.cantidad}</td>
                    <td>$${item.precio}</td>
                    <td>$${item.total_compra}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarCompraProducto(${item.id_compra})"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarCompraProducto(${item.id_compra})"><i class="bi bi-trash"></i></button>
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

function agregarCompraProducto() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formCompraProducto.reset();
    document.querySelector("#id_compra").value="0";
}

function cancelarCompraProducto() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarCompraProducto(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("compraproductos/getOneCompra?id="+id).then(
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
    const {id_compra, fecha_compra, id_producto,id_proveedor, descripcion_compra, cantidad, precio, total_compra}=record;
    document.querySelector("#id_compra").value=id_compra;
    document.querySelector("#fecha_compra").value=fecha_compra;
    document.querySelector("#id_producto").value=id_producto;
    document.querySelector("#id_proveedor").value=id_proveedor;
    document.querySelector("#descripcion_compra").value=descripcion_compra;
    document.querySelector("#cantidad").value=cantidad;
    document.querySelector("#precio").value=precio;
    document.querySelector("#total_compra").value=total_compra;
}

function eliminarCompraProducto(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed) {
                API.get("compraproductos/deleteCompra?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarCompraProducto();
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