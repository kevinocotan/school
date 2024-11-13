<?php
include_once "app/models/categoria.php";
class MainController extends Controller {
    private $categoria;
    public function __construct($parametro) {
        $this->categoria=new Categoria();
        parent::__construct("main",$parametro);
    }

    public function getAcercade() {
        $this->view->render("acercade");
    }

    public function getPreguntasFrecuentes() {
        $this->view->render("preguntasfrecuentes");
    }

    public function getPreguntasFrecuentesUser() {
        $this->view->render("preguntasfrecuentesuser");
    }

    public function getAllCategorias() {
        $records=$this->categoria->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
}