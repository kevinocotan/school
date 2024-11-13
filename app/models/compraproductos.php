<?php
include_once "app/models/db.class.php";
class CompraProductos extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select a.id_compra, date_format(a.fecha_compra,'%d-%M-%Y') as fecha_compra, 
        b.nombre, c.empresa, a.descripcion_compra, a.cantidad, a.precio, a.cantidad*a.precio as total_compra
        from productos b inner join (proveedores c inner join compraproductos a using(id_proveedor)) 
        using(id_producto) order by id_compra DESC");
    }

    public function getCompraProductoByName($id_compra) {
        return $this->executeQuery("Select id_compra, id_producto, id_proveedor, descripcion_compra, cantidad, precio, total_compra, fecha_compra from compraproductos where id_compra='{$id_compra}'");
    }

    public function save($data) {
        return $this->executeInsert("insert into compraproductos set cantidad='{$data["cantidad"]}', precio='{$data["precio"]}',
        total_compra=0, fecha_compra='{$data["fecha_compra"]}', descripcion_compra='{$data["descripcion_compra"]}',
        id_producto='{$data["id_producto"]}', id_proveedor='{$data["id_proveedor"]}'");
    }

    public function getOneCompra($id) {
        return $this->executeQuery("Select id_compra, id_producto, id_proveedor, cantidad, precio, total_compra, fecha_compra, descripcion_compra
        from compraproductos where id_compra='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update compraproductos set cantidad='{$data["cantidad"]}', precio='{$data["precio"]}',
        total_compra=0, fecha_compra='{$data["fecha_compra"]}', descripcion_compra='{$data["descripcion_compra"]}',
        id_producto='{$data["id_producto"]}', id_proveedor='{$data["id_proveedor"]}'
        where id_compra='{$data["id_compra"]}'");
    }

    public function deleteCompra($id) {
        return $this->executeInsert("delete from compraproductos where id_compra='$id'");
    }

    public function getIngresosReporte($data){
        $condicion="";
        if ($data["idingreso"]!="0") {
            $condicion.="and id_ingreso='{$data["idingreso"]}'";
        }
        return $this->executeQuery("Select a.*, date_format(fecha,'%d-%M-%Y') as fecha, b.descripcion, b.precios, c.nombre, c.precio, d.empresa
        from servicios b inner join (productos c inner join ingresos a using(id_producto)
        inner join empleados d using(id_empleado)) using(id_servicio)
        where 1=1 $condicion
        order by fecha");
    }
}
