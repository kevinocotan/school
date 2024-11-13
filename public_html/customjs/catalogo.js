//Variables y selectores
const contenedor=document.querySelector("#contenedor");

//Eventos

eventListenners();

function eventListenners() {
    document.addEventListener("DOMContentLoaded",cargarDatos);
}

function cargarDatos() {
    API.get(`catalogo/getProductos?id=${ID}`).then(
        data=>{
            let html="<div class='row'>";
            data.records.forEach(
                (item,index)=> {
                    html+=`
                    <div class="col-md-3 my-2">
                    <div class="card">
                    <h5 class="card-title text-center">${item.nombre}</h5>
                      <img src="${item.foto}" class="card-img-top" alt="${item.nombre}" style="height: 250px;">
                      <div class="card-body">
                        <h5 class="card-text text-center font-weight-bold">Categoría: ${item.categoria}</h5>
                        <h5 class="text-center font-weight-bold">Precio: $${item.precio}</h5>
                        </div>
                        <div class="card-footer d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-dark btncolor" id="btnAgregar" onclick="window.location.href='${BASE_API}catalogo/verProducto?id=${item.id_producto}'">
                          Producto Detallado
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  
                    `;
                }
            );
            html+="</div>";
            contenedor.innerHTML=html;
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}