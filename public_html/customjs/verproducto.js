//Variables y selectores
const contenedor=document.querySelector("#contenedor");

//Eventos

eventListenners();

function eventListenners() {
    document.addEventListener("DOMContentLoaded",cargarDatos);
}

//Funciones 

function cargarDatos() {
    API.get(`catalogo/getOneProducto?id=${ID}`).then(
        data=>{
            const {foto,nombre,marca,precio,descripcionpro}=data.records[0];
            let html="<div class='row'>";
            html+=`
            <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img src="${foto}" class="card-img-top" style="object-fit: contain;" alt="Imagen">
                </div>
            </div>
            <div class="col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-center flex-column align-items-left">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

                    <h4 class="card-title text-center">${nombre}</h4>
                    <br>
                    <h5 class="text-left" style="font-weight: normal;">Marca: ${marca}</h5>
                    <br>
                    <h5 class="text-left" style="font-weight: normal;">Precio: $${precio}</h5>
                    <br>
                    <h5 class="text-left" style="text-align: justify; font-weight: normal;">Descripción: ${descripcionpro}</h5>
                    <br>
                    <a href="https://api.whatsapp.com/send?phone=+503 7870 9429&text=Hola,%20me%20interesa%20este%20producto:%20${nombre}" target="_blank" class="btn btn-success btn-sm text-center mx-auto">
                    <i class="fab fa-whatsapp"></i>
                    Solicitar Producto a WhatsApp
                </a>
                
                </div>
            </div>
        </div>
    </div>

            `;
            html+="</div>";
            contenedor.innerHTML=html;
        }
    ).catch(
        error=>{
            console.log("Error:",error)
        }
    );
}