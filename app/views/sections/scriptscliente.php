<script src="<?php echo URL;?>public_html/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo URL;?>public_html/customjs/api.js"></script>
<script type="text/javascript">
    const catalogo=document.querySelector("#catalogo");
    const API=new Api();
    
    //Eventos

    eventListenners();

    function eventListenners() {
        document.addEventListener("DOMContentLoaded", cargarCatalogo);
    }

    //Funciones

    function cargarCatalogo() {
        API.get("main/getAllCategorias").then(
            data=>{
                data.records.forEach(
                    (item,index)=>{
                        const el=document.createElement("li");
                        el.innerHTML=`<a class="dropdown-item" href="<?php echo URL;?>catalogo?id=${item.id_categoria}">${item.categoria}</a>`;
                        catalogo.append(el);
                    }
                );
            }
        ).catch(
            data=> {
                console.error("Error:",error);
            }
        );
    }
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>