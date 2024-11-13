<?php
include_once "app/models/db.class.php";
class Productos extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("select a.id_producto, a.nombre, a.marca, a.precio, a.stock, a.descripcionpro, b.categoria, c.subcategoria from productos a inner join categoria b on a.id_categoria = b.id_categoria inner join subcategoria c on b.id_subcategoria = c.id_subcategoria order by a.id_producto;");
    }

    public function getProductoByName($nombre) {
        return $this->executeQuery("Select id_producto, nombre, marca, precio, stock, descripcionpro from productos where nombre='{$nombre}'");
    }

    public function save($data, $img) {
        return $this->executeInsert("insert into productos set nombre='{$data["nombre"]}', marca='{$data["marca"]}', precio='{$data["precio"]}', stock='{$data["stock"]}', id_categoria='{$data["id_categoria"]}', 	descripcionpro='{$data["descripcionpro"]}', foto='{$img}'");
    }

    public function getOneProducto($id) {
        return $this->executeQuery("Select id_producto, nombre, marca, precio, stock, descripcionpro, id_categoria, foto from productos where id_producto='{$id}'");
    }

    public function update($data, $img) {
        return $this->executeInsert("update productos set nombre='{$data["nombre"]}', marca='{$data["marca"]}', precio='{$data["precio"]}', stock='{$data["stock"]}', descripcionpro='{$data["descripcionpro"]}', id_categoria='{$data["id_categoria"]}', foto= if('{$img}'='',foto,'{$img}') where id_producto={$data["id_producto"]}");
    }

    public function deleteProducto($id) {
        return $this->executeInsert("delete from productos where id_producto='$id'");
    }

    function getProductosByCategoria($id) {
        return  $this->executeQuery("select a.id_producto, a.nombre, a.marca, a.precio, a.stock, a.descripcionpro,b.categoria, c.subcategoria, a.foto from productos a inner join categoria b on a.id_categoria = b.id_categoria inner join subcategoria c on b.id_subcategoria = c.id_subcategoria where b.id_categoria='{$id}' order by nombre");
    }

    function getProductoById($id) {
        return  $this->executeQuery("select a.id_producto, a.nombre, a.marca, a.precio, a.stock, a.descripcionpro,   b.categoria, c.subcategoria, a.foto from productos a inner join categoria b on a.id_categoria = b.id_categoria inner join subcategoria c on b.id_subcategoria = c.id_subcategoria where a.id_producto='{$id}' order by nombre");
    }
}