//variables y selectores

const btnViewReport = document.querySelector("#btnViewReport");
const idSchool = document.querySelector("#id_school");
const idAlumno = document.querySelector("#id_alumno");
const idPadreAlumno = document.querySelector("#id_padre_alumno");
const frameReporte = document.querySelector("#framereporte");
const filtro = document.querySelector("#filtro");
const API = new Api();

eventListener();

function eventListener() {
  document.addEventListener("DOMContentLoaded", cargarDatos);
  btnViewReport.addEventListener("click", verReporte);
  filtro.addEventListener("change", mostrarFiltro);
}

//Funciones

function mostrarFiltro() {
  // Ocultar todos los filtros primero
  document
    .querySelectorAll(".filtroescuelas")
    .forEach((item) => item.classList.add("d-none"));
  document
    .querySelectorAll(".filtroalumnos")
    .forEach((item) => item.classList.add("d-none"));
  document
    .querySelectorAll(".filtroparentescos")
    .forEach((item) => item.classList.add("d-none"));

  // Mostrar el filtro correspondiente
  switch (filtro.value) {
    case "1": // Filtro por Escuela
      document
        .querySelectorAll(".filtroescuelas")
        .forEach((item) => item.classList.remove("d-none"));
      break;
    case "2": // Filtro por Alumno
      document
        .querySelectorAll(".filtroalumnos")
        .forEach((item) => item.classList.remove("d-none"));
      break;
    case "3": // Filtro por Responsable
      document
        .querySelectorAll(".filtroparentescos")
        .forEach((item) => item.classList.remove("d-none"));
      break;
    default:
      break;
  }
}

function cargarDatos() {
  API.get("escuelas/getAll")
    .then((data) => {
      if (data.success) {
        idSchool.innerHTML = "";
        const optionEscuela = document.createElement("option");
        optionEscuela.value = "0";
        optionEscuela.textContent = "Todos";
        idSchool.append(optionEscuela);
        data.records.forEach((item, index) => {
          const { id_school, nombre } = item;
          const optionEscuela = document.createElement("option");
          optionEscuela.value = id_school;
          optionEscuela.textContent = nombre;
          idSchool.append(optionEscuela);
        });
      }
      cargarAlumnos();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function cargarAlumnos() {
  API.get("alumnos/getAll")
    .then((data) => {
      if (data.success) {
        idAlumno.innerHTML = "";
        const optionAlumno = document.createElement("option");
        optionAlumno.value = "0";
        optionAlumno.textContent = "Todos";
        idAlumno.append(optionAlumno);
        data.records.forEach((item, index) => {
          const { id_alumno, nombre_completo } = item;
          const optionAlumno = document.createElement("option");
          optionAlumno.value = id_alumno;
          optionAlumno.textContent = nombre_completo;
          idAlumno.append(optionAlumno);
        });
      }
      cargarParentescos();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function cargarParentescos() {
  API.get("parentescos/getAll")
    .then((data) => {
      if (data.success) {
        idPadreAlumno.innerHTML = "";
        const optionPadreAlumno = document.createElement("option");
        optionPadreAlumno.value = "0";
        optionPadreAlumno.textContent = "Todos";
        idPadreAlumno.append(optionPadreAlumno);
        data.records.forEach((item, index) => {
          const { id_padre_alumno, nombre_completo } = item;
          const optionPadreAlumno = document.createElement("option");
          optionPadreAlumno.value = id_padre_alumno;
          optionPadreAlumno.textContent = nombre_completo;
          idPadreAlumno.append(optionPadreAlumno);
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function verReporte() {
  switch (filtro.value) {
    case "1": // Reporte por escuela
      frameReporte.src = `${BASE_API}reportes/getReporteEscuela?id_school=${idSchool.value}`;
      break;
    case "2": // Reporte por alumno
      frameReporte.src = `${BASE_API}reportes/getReporteAlumno?id_alumno=${idAlumno.value}`;
      break;
    default:
      break;
  }
}
