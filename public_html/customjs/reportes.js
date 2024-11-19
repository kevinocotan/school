//variables y selectores

const btnViewReport = document.querySelector("#btnViewReport");
const idSchool = document.querySelector("#id_school");
const idAlumno = document.querySelector("#id_alumno");
const idResponsable = document.querySelector("#id_responsable");
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
  // Ocultar todos los filtros
  document
    .querySelectorAll(".filtroescuelas, .filtroalumnos, .filtroresponsables")
    .forEach((item) => item.classList.add("d-none"));

  // Mostrar el filtro correspondiente
  switch (filtro.value) {
    case "1":
      document.querySelector(".filtroescuelas").classList.remove("d-none");
      break;
    case "2":
      document.querySelector(".filtroalumnos").classList.remove("d-none");
      break;
    case "3":
      cargarAlumnos(); // Load students for parentesco filter
      document.querySelector(".filtroresponsables").classList.remove("d-none");
      break;
  }
}

function cargarDatos() {
  API.get("escuelas/getAll")
    .then((data) => {
      if (data.success) {
        idSchool.innerHTML = "<option value='0'>Todos </option>";
        data.records.forEach((item) => {
          const { id_school, nombre } = item;
          idSchool.innerHTML += `<option value="${id_school}">${nombre}</option>`;
        });
      }
      cargarAlumnos();
    })
    .catch(console.error);
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
        data.records.forEach((item) => {
          const { id_alumno, nombre_completo } = item;
          const optionAlumno = document.createElement("option");
          optionAlumno.value = id_alumno;
          optionAlumno.textContent = nombre_completo;
          idAlumno.append(optionAlumno);
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function verReporte() {
  switch (filtro.value) {
    case "1":
      frameReporte.src = `${BASE_API}reportes/getReporteEscuela?id_school=${idSchool.value}`;
      break;
    case "2":
      frameReporte.src = `${BASE_API}reportes/getReporteAlumno?id_alumno=${idAlumno.value}`;
      break;
    case "3":
      frameReporte.src = `${BASE_API}reportes/getReporteParentesco?id_alumno=${idAlumno.value}`;
      break;
  }
}
