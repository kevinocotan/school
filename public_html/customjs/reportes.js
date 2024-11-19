// Variables y selectores
const btnViewReport = document.querySelector("#btnViewReport");
const idSchool = document.querySelector("#id_school");
const idAlumno = document.querySelector("#id_alumno");
const idParentesco = document.querySelector("#parentesco");
const frameReporte = document.querySelector("#framereporte");
const filtro = document.querySelector("#filtro");
const contenedorDinamico = document.querySelector("#contenedor-dinamico");
const API = new Api();

eventListener();

function eventListener() {
  document.addEventListener("DOMContentLoaded", cargarDatos);
  btnViewReport.addEventListener("click", verReporte);
  filtro.addEventListener("change", mostrarFiltro);
  idParentesco.addEventListener("change", manejarParentesco); // Manejo dinámico del filtro de parentesco
}

// Funciones

function mostrarFiltro() {
  // Ocultar todos los filtros
  document
    .querySelectorAll(".filtroescuelas, .filtroalumnos, .filtroparentesco")
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
      document.querySelector(".filtroparentesco").classList.remove("d-none");
      break;
  }
}

function manejarParentesco() {
  // Limpia el contenedor dinámico antes de agregar nuevo contenido
  contenedorDinamico.innerHTML = "";

  if (idParentesco.value === "1") {
    // Si selecciona "Alumno"
    agregarFiltroDinamico("Alumnos", "alumnos-dinamico", cargarListadoAlumnos);
  } else if (idParentesco.value === "2") {
    // Si selecciona "Responsable"
    agregarFiltroDinamico(
      "Responsables",
      "responsables-dinamico",
      cargarResponsables
    );
  }
}

function agregarFiltroDinamico(label, idSelect, callback) {
  // Crear el nuevo filtro dinámico
  const nuevoDiv = document.createElement("div");
  nuevoDiv.classList.add("col-auto", "d-flex");
  nuevoDiv.innerHTML = `
    <label class="col-form-label mx-3" for="${idSelect}">${label}</label>
    <select name="${idSelect}" id="${idSelect}" class="form-select">
      <option value="0">Cargando...</option>
    </select>
  `;
  contenedorDinamico.appendChild(nuevoDiv);

  // Llamar al callback para cargar datos en el select
  callback(`#${idSelect}`);
}

function cargarListadoAlumnos(selector) {
  API.get("alumnos/getAll")
    .then((data) => {
      if (data.success) {
        const selectAlumnos = document.querySelector(selector);
        selectAlumnos.innerHTML = ""; // Limpia las opciones actuales
        const optionDefault = document.createElement("option");
        optionDefault.value = "0";
        optionDefault.textContent = "Todos";
        selectAlumnos.append(optionDefault);

        data.records.forEach((item) => {
          const { id_alumno, nombre_completo } = item;
          const option = document.createElement("option");
          option.value = id_alumno;
          option.textContent = nombre_completo;
          selectAlumnos.append(option);
        });
      }
    })
    .catch((error) => {
      console.error("Error cargando alumnos:", error);
    });
}

function cargarResponsables(selector) {
  API.get("padres/getAll") // Endpoint para obtener responsables
    .then((data) => {
      if (data.success) {
        const selectResponsables = document.querySelector(selector);
        selectResponsables.innerHTML = ""; // Limpia las opciones actuales
        const optionDefault = document.createElement("option");
        optionDefault.value = "0";
        optionDefault.textContent = "Todos";
        selectResponsables.append(optionDefault);

        data.records.forEach((item) => {
          const { id_padre, nombre } = item; // Ajusta los campos según tu API
          const option = document.createElement("option");
          option.value = id_padre;
          option.textContent = nombre;
          selectResponsables.append(option);
        });
      }
    })
    .catch((error) => {
      console.error("Error cargando responsables:", error);
    });
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
      if (idParentesco.value === "1") {
        const alumnosDinamico =
          document.querySelector("#alumnos-dinamico").value;
        frameReporte.src = `${BASE_API}reportes/getReporteParentesco?id_alumno=${alumnosDinamico}`;
      } else if (idParentesco.value === "2") {
        const responsablesDinamico = document.querySelector(
          "#responsables-dinamico"
        ).value;
        frameReporte.src = `${BASE_API}reportes/getReporteResponsables?id_responsable=${responsablesDinamico}`;
      }
      break;
  }
}
