//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const formProducto=document.querySelector("#formProducto");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const divFoto=document.querySelector("#divfoto");
const inputFoto=document.querySelector("#foto");
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
    btnNew.addEventListener("click",agregarProducto);
    btnCancelar.addEventListener("click",cancelarProducto);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded",cargarDatos);
    //console.log("Despues de cargar");
    searchText.addEventListener("input",aplicarFiltro);
    formProducto.addEventListener("submit",guardarProducto);
    divFoto.addEventListener("click",agregarFoto);
    inputFoto.addEventListener("change",actualizarFoto);

}

//Funciones

function actualizarFoto(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divFoto.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function agregarFoto() {
    inputFoto.click();
}

function guardarProducto(event) {
    event.preventDefault();
    const formData=new FormData(formProducto);
    //console.log(formData);
    API.post(formData,"productosuser/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success) {
                cancelarProducto();
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

function cargarDatos() {
    API.get("productosuser/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarCategoria();
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

function cargarCategoria() {
    API.get("categoriauser/getAll").then(
        data=>{
            if(data.success) {
                const txtCategoria=document.querySelector("#id_categoria");
                txtCategoria.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const {id_categoria,categoria}=item;
                        const optionCategoria=document.createElement("option");
                        optionCategoria.value=id_categoria;
                        optionCategoria.textContent=categoria;
                        txtCategoria.append(optionCategoria);
                    }
                );
            }
            cargarSubcategoria();
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}

function cargarSubcategoria() {
    API.get("subcategoriauser/getAll").then(
        data=>{
            if (data.success) {
                const txtSubcategoria=document.querySelector("#id_subcategoria");
                txtSubcategoria.innerHTML="";
                data.records.forEach(
                    (item, index)=>{
                        const {id_subcategoria,subcategoria}=item;
                        const optionSubcategoria=document.createElement("option");
                        optionSubcategoria.value=id_subcategoria;
                        optionSubcategoria.textContent=subcategoria;
                        txtSubcategoria.append(optionSubcategoria);
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

function crearTabla() {
    if (objDatos.filter==""){
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(
            item=>{
                const {nombre, marca, precio, stock, categoria, subcategoria}=item;
                if (nombre.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (marca.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (precio.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (stock.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (categoria.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (subcategoria.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
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
                    <td>${item.marca}</td>
                    <td>$${item.precio}</td>
                    <td>${item.stock}</td>
                    <td>${item.categoria}</td>
                    <td>${item.subcategoria}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarProducto(${item.id_producto})"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarProducto(${item.id_producto})"><i class="bi bi-trash"></i></button>
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

function editarProducto(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("productosuser/getOneProducto?id="+id).then(
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

function eliminarProducto(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed) {
                API.get("productosuser/deleteProducto?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarProducto();
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

function agregarProducto() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formProducto.reset();
    document.querySelector("#id_producto").value="0";
    divFoto.innerHTML="";
}

function cancelarProducto() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function mostrarDatosForm(record) {
    const {id_producto, nombre, marca, precio, stock, descripcionpro, id_categoria, foto}=record;
    document.querySelector("#id_producto").value=id_producto;
    document.querySelector("#nombre").value=nombre;
    document.querySelector("#marca").value=marca;
    document.querySelector("#precio").value=precio;
    document.querySelector("#stock").value=stock;
    document.querySelector("#descripcionpro").value=descripcionpro;
    document.querySelector("#id_categoria").value=id_categoria;
    divFoto.innerHTML=`<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
}