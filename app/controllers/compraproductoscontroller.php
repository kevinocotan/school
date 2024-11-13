<?php
include_once "app/models/compraproductos.php";
class CompraProductosController extends Controller {
    private $compraproducto;
    public function __construct($parametro) {
        $this->compraproducto=new CompraProductos();
        parent::__construct("compraproductos",$parametro,true);
    }

    public function getAll() {
        $records=$this->compraproducto->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        if ($_POST["id_compra"]=="0") {
            $datosCompraProducto=$this->compraproducto->getCompraProductoByName($_POST["id_compra"]);
            if (count($datosCompraProducto)>0) {
                $info=array('success'=>false,'msg'=>"La compra ya existe.");
            } else {
                $records=$this->compraproducto->save($_POST);
                $info=array('success'=>true,'msg'=>"Se ha registrado la compra de producto con éxito.");
            }
        } else {
            $records=$this->compraproducto->update($_POST);
            $info=array('success'=>true,'msg'=>"Se han actualizado los datos de la compra de producto.");
        }
        echo json_encode($info);
    }

    public function getOneCompra() {
        $records=$this->compraproducto->getOneCompra($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'La compra no existe.');
        }
        echo json_encode($info);
    }

    public function deleteCompra() {
        $records=$this->compraproducto->deleteCompra($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Compra de producto eliminada con éxito.");
        echo json_encode($info);
    }
}