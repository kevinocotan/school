// Variables y selectores
const btnViewReport = document.querySelector("#btnViewReport");
const idEscuela = document.querySelector("#id_escuela");
const frameReporte = document.querySelector("#framereporte");
const API = new Api(); // Clase para manejar peticiones a la API

// Inicialización de eventos
eventListener();

function eventListener() {
  // Cargar datos al cargar la página
  document.addEventListener("DOMContentLoaded", cargarDatos);
  // Asignar evento al botón para ver el reporte
  btnViewReport.addEventListener("click", verReporte);
}

// Funciones

// Función para cargar los datos iniciales
function cargarDatos() {
  // Cargar escuelas
  API.get("escuelas/getAll")
    .then((data) => {
      if (data.success) {
        idEscuela.innerHTML = ""; // Limpiar opciones previas
        const optionEscuela = document.createElement("option");
        optionEscuela.value = "0"; // Valor predeterminado para 'Todas'
        optionEscuela.textContent = "Todas";
        idEscuela.append(optionEscuela);

        // Agregar opciones desde la API
        data.records.forEach((item) => {
          const { id_escuela, escuela } = item;
          const optionEscuela = document.createElement("option");
          optionEscuela.value = id_escuela;
          optionEscuela.textContent = escuela;
          idEscuela.append(optionEscuela);
        });
      }
    })
    .catch((error) => {
      console.error("Error al cargar escuelas:", error);
    });
}

// Función para mostrar el reporte en el iframe
function verReporte() {
  const idEscuelaValue = idEscuela.value || "0"; // Validar selección de escuela

  // Establecer el src del iframe para generar el reporte
  frameReporte.src = `${BASE_API}reportes/getReporte?idescuela=${idEscuelaValue}`;
}
