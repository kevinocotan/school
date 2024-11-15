//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const formAlumno=document.querySelector("#formAlumno");
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

eventListiners();

function eventListiners() {
    btnNew.addEventListener("click",agregarAlumno);
    btnCancelar.addEventListener("click",cancelarAlumno);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input",aplicarFiltro);
    formAlumno.addEventListener("submit",guardarAlumno);
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

function guardarAlumno(event) {
    event.preventDefault();
    const formData=new FormData(formAlumno);
    //console.log(formData);
    API.post(formData,"alumnos/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success) {
                cancelarAlumno();
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
    API.get("alumnos/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarGrado();
                cargarSeccion();
                cargarSchool();
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

function cargarGrado() {
    API.get("grados/getAll").then(
        data=>{
            if(data.success) {
                const txtGrado=document.querySelector("#id_grado");
                txtGrado.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const {id_grado,nombre_grado}=item;
                        const optionGrado=document.createElement("option");
                        optionGrado.value=id_grado;
                        optionGrado.textContent=nombre_grado;
                        txtGrado.append(optionGrado);
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

function cargarSeccion() {
    API.get("secciones/getAll").then(
        data=>{
            if (data.success) {
                const txtSeccion=document.querySelector("#id_seccion");
                txtSeccion.innerHTML="";
                data.records.forEach(
                    (item, index)=>{
                        const {id_seccion,nombre_seccion}=item;
                        const optionSeccion=document.createElement("option");
                        optionSeccion.value=id_seccion;
                        optionSeccion.textContent=nombre_seccion;
                        txtSeccion.append(optionSeccion);
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

function cargarSchool() {
    API.get("escuelas/getAll").then(
        data=>{
            if (data.success) {
                const txtEscuela=document.querySelector("#id_school");
                txtEscuela.innerHTML="";
                data.records.forEach(
                    (item, index)=>{
                        const {id_school,nombre}=item;
                        const optionEscuela=document.createElement("option");
                        optionEscuela.value=id_school;
                        optionEscuela.textContent=nombre;
                        txtEscuela.append(optionEscuela);
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
                const {nombre_completo, direccion, telefono, email, genero, latitud, longitud, nombre_grado, nombre_seccion, nombre_escuela}=item;
                if (nombre_completo.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (direccion.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (telefono.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (email.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;   
                }
                if (genero.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (latitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (longitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (nombre_grado.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (nombre_seccion.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (nombre_escuela.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
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
                    <td>${item.nombre_completo}</td>
                    <td>${item.direccion}</td>
                    <td>${item.telefono}</td>
                    <td style="word-wrap: break-word; max-width: 100px;">${item.email}</td>
                    <td>${item.genero}</td>
                    <td>${item.latitud}</td>
                    <td>${item.longitud}</td>
                    <td>${item.nombre_grado}</td>
                    <td style="text-align: center;">${item.nombre_seccion}</td>
                    <td>${item.nombre_escuela}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarAlumno(${item.id_alumno})"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarAlumno(${item.id_alumno})"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>                
                `;
            }
        }
    );
    tableContent.innerHTML=html;
    crearPaginacion(); 
}

function editarAlumno(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("alumnos/getOneAlumno?id="+id).then(
        data=>{
            if (data.success) {
                mostrarDatosForm(data.records[0]);
                // Obtener las coordenadas del registro y actualizar el marcador en el mapa
                const { latitud, longitud } = data.records[0];
                actualizarMarcadorMapa(parseFloat(latitud), parseFloat(longitud));
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


function eliminarAlumno(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed) {
                API.get("alumno/deleteAlumno?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarAlumno();
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

function agregarAlumno() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formAlumno.reset();
    document.querySelector("#id_alumno").value="0";
    divFoto.innerHTML="";
}

function cancelarAlumno() {
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
    const {id_alumno, nombre_completo, telefono, direccion, email, genero, latitud, longitud, id_grado, id_seccion,id_school, foto}=record;
    document.querySelector("#id_alumno").value=id_alumno;
    document.querySelector("#nombre_completo").value=nombre_completo;
    document.querySelector("#direccion").value=direccion;
    document.querySelector("#telefono").value=telefono;
    document.querySelector("#email").value=email;
    document.querySelector("#genero").value=genero;
    document.querySelector("#latitud").value=latitud;
    document.querySelector("#longitud").value=longitud;
    document.querySelector("#id_grado").value=id_grado;
    document.querySelector("#id_seccion").value=id_seccion;
    document.querySelector("#id_school").value=id_school;
    divFoto.innerHTML=`<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
    actualizarMarcadorMapa(parseFloat(latitud), parseFloat(longitud));
}


function actualizarMarcadorMapa(latitud, longitud) {
    if (mapa && marcador) {
        var nuevaPosicion = new google.maps.LatLng(latitud, longitud);
        marcador.setPosition(nuevaPosicion);
        mapa.setCenter(nuevaPosicion);
    }
}

var mapa;
var marcador;

function initMap() {
    mapa = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 0, lng: 0 },
        zoom: 8
    });
    marcador = new google.maps.Marker({
        position: { lat: 0, lng: 0 },
        map: mapa,
        draggable: true
    });
    marcador.addListener('dragend', function (event) {
        actualizarPosicion(event.latLng.lat(), event.latLng.lng());
    });
}

function actualizarPosicion(latitud, longitud) {
    document.getElementById('latitud').value = latitud;
    document.getElementById('longitud').value = longitud;
}

function guardarCoordenadas() {
    var latitud = marcador.getPosition().lat();
    var longitud = marcador.getPosition().lng();
}