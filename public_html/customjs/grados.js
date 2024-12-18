//Variables globales y selectores
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#contentList");
const panelForm = document.querySelector("#contentForm");
const btnCancelar = document.querySelector("#btnCancelar");
const tableContent = document.querySelector("#contentTable table tbody");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
const formGrado = document.querySelector("#formGrado");
const API = new Api();
const objDatos = {
    records: [],
    recordsFilter: [],
    currentPage: 1,
    recordsShow: 10,
    filter: ""
}


//Configuracion de eventos
eventListiners();
function eventListiners() {
    btnNew.addEventListener("click", agregarGrado);
    btnCancelar.addEventListener("click", cancelarGrado);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded", cargarDatos);
    //console.log("Despues de cargar");
    searchText.addEventListener("input", aplicarFiltro);
    formGrado.addEventListener("submit", guardarGrado);

}

//Funciones

function guardarGrado(event) {
    event.preventDefault();
    const formData = new FormData(formGrado);
    //console.log(formData);
    API.post(formData, "grados/save").then(
        data => {
            //console.log(data.msg);
            if (data.success) {
                cancelarGrado();
                Swal.fire({
                    icon: "info",
                    text: data.msg
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.msg
                });
            }
        }
    ).catch(
        error => {
            console.log("Error:", error);
        }
    );
}

function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter = this.value;
    crearTabla();
}

function cargarDatos() {
    API.get("grados/getAll").then(
        data => {
            if (data.success) {
                objDatos.records = data.records;
                objDatos.currentPage = 1;
                crearTabla();
            } else {
                console.log("Error al recuperar los registros");
            }
        }
    ).catch(
        error => {
            console.error("Error en la llamada:", error);
        }
    );
}

function crearTabla() {
    if (objDatos.filter == "") {
        objDatos.recordsFilter = objDatos.records.map(item => item);
    } else {
        objDatos.recordsFilter = objDatos.records.filter(
            item => {
                const { nombre_grado } = item;
                if (nombre_grado.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
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
                    <td>${item.nombre_grado}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarGrado(${item.id_grado})"><i class="ri-edit-fill"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarGrado(${item.id_grado})"><i class="ri-delete-bin-7-line"></i></button>
                    </td>
                    </tr>
                
                `;
            }
        }
    );
    //console.log(html);
    tableContent.innerHTML = html;
    crearPaginacion();
}

function crearPaginacion() {
    //Borrar elementos
    pagination.innerHTML = "";

    //Boton Anterior
    const elAnterior = document.createElement("li")
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML = `<a class="page-link" href="#">Previous</a>`;
    elAnterior.onclick = () => {
        objDatos.currentPage = (objDatos.currentPage == 1 ? 1 : --objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elAnterior);

    //Agregando los numeors de pagina

    const totalPage = Math.ceil(objDatos.recordsFilter.length / objDatos.recordsShow);
    for (let i = 1; i <= totalPage; i++) {
        const el = document.createElement("li");
        el.classList.add("page=item");
        el.innerHTML = `<a class="page-link" href="#">${i}</a>`;
        el.onclick = () => {
            objDatos.currentPage = i;
            crearTabla();
        }
        pagination.append(el);
    }

    //Bonton siguiente
    const elSiguiente = document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML = `<a class="page-link" href="#">Next</a>`;
    elSiguiente.onclick = () => {
        objDatos.currentPage = (objDatos.currentPage == totalPage ? totalPage : ++objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elSiguiente);

}

function agregarGrado() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formGrado.reset();
    document.querySelector("#id_grado").value = "0";
}

function cancelarGrado() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarGrado(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("grados/getOneGrado?id=" + id).then(
        data => {
            if (data.success) {
                mostrarDatosForm(data.records[0]);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.msg
                })
            }
        }
    ).catch(
        error => {
            console.error("Error:", error);
        }
    );
}

function mostrarDatosForm(record) {
    const { id_grado, nombre_grado } = record;
    document.querySelector("#id_grado").value = id_grado;
    document.querySelector("#nombre_grado").value = nombre_grado;

}
	
 



function eliminarGrado(id) {
    Swal.fire({
        title: "¿Ésta seguro de eliminar el registro?",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: "No"
    }).then(
        resultado => {
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed) {
                API.get("grados/deleteGrado?id=" + id).then(
                    data => {
                        if (data.success) {
                            cancelarGrado();
                            Swal.fire({
                                icon: "info",
                                text: data.msg
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.msg
                            });
                        }
                    }
                ).catch(
                    error => {
                        console.log("Error", error);
                    }
                );
            }
        }
    );
    console.log("Mensaje de texto");
}