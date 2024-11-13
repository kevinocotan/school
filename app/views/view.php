<?php
class View {
    public function render($view) {
        require_once "app/views/$view.php";
    }
}