// scp -r catolica@172.19.1.121:/var/www/html/bookstore/* ./
// scp -r * catolica@192.168.56.105:/var/www/html/bookstore/
//Deficion de elementos HTML
const mensaje=document.querySelector("#mensaje");
const form=document.querySelector("#formlogin");

//Configuracion de eventos
 form.addEventListener("submit",login);

 //Definicion de funciones

async function login(event) {
    event.preventDefault();
    const API=new Api();
    const formData=new FormData(form);
    API.post(formData, "login/validar").then(
        data=>{
            if (data.success==true){
                window.location=data.url;
            } else {
                mensaje.classList.remove("d-none");
                mensaje.innerHTML=data.msg;
            }
            console.log("Datos recibidos:",data.msg);
        }
    ).catch(
        error=>{
            console.error("Mensaje de error",error);
        }
    )
 }



