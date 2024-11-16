//variables y selectores

const btnViewReport = document.querySelector("#btnViewReport");
const idAutor = document.querySelector("#id_autor");
const idCate = document.querySelector("#id_cate");
const frameReporte = document.querySelector("#framereporte");
const API = new Api();

eventListener();

function eventListener() {
  document.addEventListener("DOMContentLoaded", cargarDatos);
  btnViewReport = addEventListener("click", verReporte);
}

//Funciones

function cargarDatos() {
  API.get("autores/getAll")
    .then((data) => {
      if (data.success) {
        idAutor.innerHTML = "";
        const optionAutor = document.createElement("option");
        optionAutor.value = "0";
        optionAutor.textContent = "Todos";
        idAutor.append(optionAutor);
        data.records.forEach((item, index) => {
          const { id_autor, autor } = item;
          const optionAutor = document.createElement("option");
          optionAutor.value = id_autor;
          optionAutor.textContent = autor;
          idAutor.append(optionAutor);
        });
      }
      cargarCategorias();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function cargarCategorias() {
  API.get("categorias/getAll")
    .then((data) => {
      if (data.success) {
        idCate.innerHTML = "";
        const optionCate = document.createElement("option");
        optionCate.value = "0";
        optionCate.textContent = "Todos";
        idCate.append(optionCate);
        data.records.forEach((item, index) => {
          const { id_cate, categoria } = item;
          const optionCate = document.createElement("option");
          optionCate.value = id_cate;
          optionCate.textContent = categoria;
          idCate.append(optionCate);
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function verReporte() {
  frameReporte.src = `${BASE_API}reportelibros/getReporte?idcate=${idCate.value}&idautor=${idAutor.value}`;
}
