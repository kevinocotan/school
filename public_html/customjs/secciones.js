//Variables globales y selectores
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#contentList");
const panelForm = document.querySelector("#contentForm");
const btnCancelar = document.querySelector("#btnCancelar");
const tableContent = document.querySelector("#contentTable table tbody");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
const formSeccion = document.querySelector("#formSeccion");
const API = new Api();
const objDatos = {
  records: [],
  recordsFilter: [],
  currentPage: 1,
  recordsShow: 10,
  filter: "",
};

//Configuracion de eventos
eventListiners();
function eventListiners() {
  btnNew.addEventListener("click", agregarSeccion);
  btnCancelar.addEventListener("click", cancelarSeccion);
  //console.log("Antes de cargar");
  document.addEventListener("DOMContentLoaded", cargarDatos);
  //console.log("Despues de cargar");
  searchText.addEventListener("input", aplicarFiltro);
  formSeccion.addEventListener("submit", guardarSeccion);
}

//Funciones

function guardarSeccion(event) {
  event.preventDefault();
  const formData = new FormData(formSeccion);
  //console.log(formData);
  API.post(formData, "secciones/save")
    .then((data) => {
      //console.log(data.msg);
      if (data.success) {
        cancelarSeccion();
        Swal.fire({
          icon: "info",
          text: data.msg,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.msg,
        });
      }
    })
    .catch((error) => {
      console.log("Error:", error);
    });
}

function aplicarFiltro(element) {
  element.preventDefault();
  objDatos.filter = this.value;
  crearTabla();
}

function cargarDatos() {
  API.get("secciones/getAll")
    .then((data) => {
      if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
      } else {
        console.log("Error al recuperar los registros");
      }
    })
    .catch((error) => {
      console.error("Error en la llamada:", error);
    });
}

function crearTabla() {
  if (objDatos.filter == "") {
    objDatos.recordsFilter = objDatos.records.map((item) => item);
  } else {
    objDatos.recordsFilter = objDatos.records.filter((item) => {
      const { nombre_seccion } = item;
      if (
        nombre_seccion
          .toUpperCase()
          .search(objDatos.filter.toLocaleUpperCase()) != -1
      ) {
        return item;
      }
    });
  }

  const recordIni =
    objDatos.currentPage * objDatos.recordsShow - objDatos.recordsShow;

  const recordFin = recordIni + objDatos.recordsShow - 1;

  let html = "";
  objDatos.recordsFilter.forEach((item, index) => {
    if (index >= recordIni && index <= recordFin) {
      html += `
                    <tr>
                    <td>${index + 1}</td>
                    <td>${item.nombre_seccion}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarSeccion(${
                          item.id_seccion
                        })"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarSeccion(${
                          item.id_seccion
                        })"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                
                `;
    }
  });
  //console.log(html);
  tableContent.innerHTML = html;
  crearPaginacion();
}

function crearPaginacion() {
  //Borrar elementos
  pagination.innerHTML = "";

  //Boton Anterior
  const elAnterior = document.createElement("li");
  elAnterior.classList.add("page-item");
  elAnterior.innerHTML = `<a class="page-link" href="#">Previous</a>`;
  elAnterior.onclick = () => {
    objDatos.currentPage =
      objDatos.currentPage == 1 ? 1 : --objDatos.currentPage;
    crearTabla();
  };
  pagination.append(elAnterior);

  //Agregando los numeors de pagina

  const totalPage = Math.ceil(
    objDatos.recordsFilter.length / objDatos.recordsShow
  );
  for (let i = 1; i <= totalPage; i++) {
    const el = document.createElement("li");
    el.classList.add("page=item");
    el.innerHTML = `<a class="page-link" href="#">${i}</a>`;
    el.onclick = () => {
      objDatos.currentPage = i;
      crearTabla();
    };
    pagination.append(el);
  }

  //Bonton siguiente
  const elSiguiente = document.createElement("li");
  elSiguiente.classList.add("page-item");
  elSiguiente.innerHTML = `<a class="page-link" href="#">Next</a>`;
  elSiguiente.onclick = () => {
    objDatos.currentPage =
      objDatos.currentPage == totalPage ? totalPage : ++objDatos.currentPage;
    crearTabla();
  };
  pagination.append(elSiguiente);
}

function agregarSeccion() {
  panelDatos.classList.add("d-none");
  panelForm.classList.remove("d-none");
  limpiarForm();
}

function limpiarForm(op) {
  formSeccion.reset();
  document.querySelector("#id_seccion").value = "0";
}

function cancelarSeccion() {
  panelDatos.classList.remove("d-none");
  panelForm.classList.add("d-none");
  cargarDatos();
}

function editarSeccion(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelForm.classList.remove("d-none");
  API.get("secciones/getOneSeccion?id=" + id)
    .then((data) => {
      if (data.success) {
        mostrarDatosForm(data.records[0]);
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.msg,
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function mostrarDatosForm(record) {
  const { id_seccion, nombre_seccion } = record;
  document.querySelector("#id_seccion").value = id_seccion;
  document.querySelector("#nombre_seccion").value = nombre_seccion;
}

function eliminarSeccion(id) {
  Swal.fire({
    title: "¿Ésta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: "No",
  }).then((resultado) => {
    console.log(resultado.isConfirmed);
    if (resultado.isConfirmed) {
      API.get("secciones/deleteSeccion?id=" + id)
        .then((data) => {
          if (data.success) {
            cancelarSeccion();
            Swal.fire({
              icon: "info",
              text: data.msg,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.msg,
            });
          }
        })
        .catch((error) => {
          console.log("Error", error);
        });
    }
  });
  console.log("Mensaje de texto");
}
