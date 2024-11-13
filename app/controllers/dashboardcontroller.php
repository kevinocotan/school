<?php
class DashboardController extends Controller {

    public function __construct($parametro) {
        parent::__construct("dashboard",$parametro,true);
    }
}