<?php
require_once "app/views/view.php";

class Controller {
    protected $view;

    public function __construct($view, $parametro, $validar=false) {
        // Iniciar la sesión si no está iniciada
        if ($validar && session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->view = new View();

        // Validar si la sesión está activa y si el usuario está autenticado
        if ($validar && !isset($_SESSION["id_usr"])) {
            $this->view->render("login");
            return;
        }

        // Si no hay parámetros, renderiza la vista
        if (empty($parametro)) {
            $this->view->render($view);
            return;
        }

        // Si el método existe, ejecutarlo
        if (method_exists($this, $parametro)) {
            $this->$parametro();
        } else {
            echo "<h1>Metodo no existe</h1>";
        }
    }
}
