<?php
include_once "app/models/productos.php";
class CatalogoController extends Controller {
    private $producto;
    public function __construct($parametro) {
        $this->producto=new Productos();
        parent::__construct("catalogo",$parametro);
    }

    function getProductos() {
        $records=$this->producto->getProductosByCategoria($_GET["id"]);
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    function verProducto() {
        $this->view->render("verproducto");
    }

    function getOneProducto() {
        $records=$this->producto->getProductoById($_GET["id"]);
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
}
