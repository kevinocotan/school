//Variables globales y selectores
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#contentList");
const panelForm = document.querySelector("#contentForm");
const btnCancelar = document.querySelector("#btnCancelar");
const formPadrealumno = document.querySelector("#formPadrealumno");
const tableContent = document.querySelector("#contentTable table tbody");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
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
  btnNew.addEventListener("click", agregarPadrealumno);
  btnCancelar.addEventListener("click", cancelarPadrealumno);
  //console.log("Antes de cargar");
  document.addEventListener("DOMContentLoaded", cargarDatos);
  //console.log("Despues de cargar");
  searchText.addEventListener("input", aplicarFiltro);
  formPadrealumno.addEventListener("submit", guardarPadrealumno);
}

//Funciones

function guardarPadrealumno(event) {
  event.preventDefault();
  const formData = new FormData(formPadrealumno);
  //console.log(formData);
  API.post(formData, "parentescos/save")
    .then((data) => {
      //console.log(data.msg);
      if (data.success) {
        cancelarPadrealumno();
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

function cargarDatos() {
  API.get("parentescos/getAll")
    .then((data) => {
      //console.log(data.records);
      if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
        cargarAlumno();
        cargarPadre();
      } else {
        console.log("Error al recuperar los registros");
      }
    })
    .catch((error) => {
      console.error("Error en la llamada:", error);
    });
}

function cargarAlumno() {
  API.get("alumno/getAll")
    .then((data) => {
      if (data.success) {
        const txtAlumno = document.querySelector("#id_alumno");
        txtAlumno.innerHTML = "";
        data.records.forEach((item, index) => {
          const { id_alumno, nombre_completo } = item;
          const optionAlumno = document.createElement("option");
          optionAlumno.value = id_alumno;
          optionAlumno.textContent = nombre_completo;
          txtAlumno.append(optionAlumno);
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function cargarPadre() {
  API.get("padre/getAll")
    .then((data) => {
      if (data.success) {
        const txtPadre = document.querySelector("#id_padre");
        txtPadre.innerHTML = "";
        data.records.forEach((item, index) => {
          const { id_padre, nombre } = item;
          const optionPadre = document.createElement("option");
          optionPadre.value = id_padre;
          optionPadre.textContent = nombre;
          txtPadre.append(optionPadre);
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
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
  //Agregando los numeros de pagina
  const totalPage = Math.ceil(
    objDatos.recordsFilter.length / objDatos.recordsShow
  );
  for (let i = 1; i <= totalPage; i++) {
    const el = document.createElement("li");
    el.classList.add("page-item");
    el.innerHTML = `<a class="page-link" href="#">${i}</a>`;
    el.onclick = () => {
      objDatos.currentPage = i;
      crearTabla();
    };
    pagination.append(el);
  }
  //Boton siguiente
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

function crearTabla() {
  if (objDatos.filter == "") {
    objDatos.recordsFilter = objDatos.records.map((item) => item);
  } else {
    objDatos.recordsFilter = objDatos.records.filter((item) => {
      const { nombre_completo, nombre_padre, parentesco, fecha } = item;
      if (
        nombre_completo
          .toUpperCase()
          .search(objDatos.filter.toLocaleUpperCase()) != -1
      ) {
        return item;
      }
      if (
        nombre_padre
          .toUpperCase()
          .search(objDatos.filter.toLocaleUpperCase()) != -1
      ) {
        return item;
      }
      if (
        parentesco.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) !=
        -1
      ) {
        return item;
      }
      if (
        fecha.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1
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
                    <td>${item.nombre_completo}</td>
                    <td>${item.nombre_padre}</td>
                    <td>${item.parentesco}</td>
                    <td>${item.fecha}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarPadrealumno(${
                          item.id_padre_alumno
                        })"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarPadrealumno(${
                          item.id_padre_alumno
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

function editarPadrealumno(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelForm.classList.remove("d-none");
  API.get("parentescos/getOneParentesco?id=" + id)
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

function eliminarPadrealumno(id) {
  Swal.fire({
    title: "¿Ésta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: "No",
  }).then((resultado) => {
    console.log(resultado.isConfirmed);
    if (resultado.isConfirmed) {
      API.get("parentescos/deleteParentesco?id=" + id)
        .then((data) => {
          if (data.success) {
            cancelarPadrealumno();
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
  });
  console.log("Mensaje de texto");
}

function agregarPadrealumno() {
  panelDatos.classList.add("d-none");
  panelForm.classList.remove("d-none");
  limpiarForm();
}

function limpiarForm(op) {
  formPadrealumno.reset();
  document.querySelector("#id_padre_alumno").value = "0";
}

function cancelarPadrealumno() {
  panelDatos.classList.remove("d-none");
  panelForm.classList.add("d-none");
  cargarDatos();
}

function aplicarFiltro(element) {
  element.preventDefault();
  objDatos.filter = this.value;
  crearTabla();
}

function mostrarDatosForm(record) {
  const { id_padre_alumno, parentesco, fecha, id_alumno, id_padre } = record;
  document.querySelector("#id_padre_alumno").value = id_padre_alumno;
  document.querySelector("#parentesco").value = parentesco;
  document.querySelector("#fecha").value = fecha;
  document.querySelector("#id_alumno").value = id_alumno;
  document.querySelector("#id_padre").value = id_padre;
}
