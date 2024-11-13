<?php
include_once "app/models/productosuser.php";

class ProductosUserController extends Controller {
    private $producto;
    public function __construct($parametro) {
        $this->producto=new ProductosUser();
        parent::__construct("productosuser",$parametro,true);
    }

    public function getAll() {
        $records=$this->producto->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        //Proceso para guardar el archivo 
        $img="";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                if (($_FILES["foto"]["type"]=="image/png") ||
                    ($_FILES["foto"]["type"]=="image/jpeg")) {
                        copy($_FILES["foto"]["tmp_name"],
                        __DIR__."/../../public_html/fotos/".$_FILES["foto"]["name"])
                        or die("No se pudo copiar el archivo");
                        $img=URL."public_html/fotos/".$_FILES["foto"]["name"];
                    }
            }
        }

        if ($_POST["id_producto"]==0) {
            $datosProducto=$this->producto->getProductoByName($_POST["nombre"]);
            if (count($datosProducto)>0){
                $info=array('success'=>false, 'msg'=>"El producto ya existe.");
            } else {
                $records=$this->producto->save($_POST,$img);
                $info=array('success'=>true, 'msg'=>"El producto se ha guardado con éxito.");
            }
        } else {
            $records=$this->producto->update($_POST,$img);
            $info=array('success'=>true, 'msg'=>"El producto se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneProducto() {
        $records=$this->producto->getOneProducto($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El producto no existe.');
        }
        echo json_encode($info);
    }

    public function deleteProducto() {
        $records=$this->producto->deleteProducto($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el producto con éxito.");
        echo json_encode($info);
    }
}