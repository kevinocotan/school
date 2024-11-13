<?php
class DashboardUserController extends Controller {

    public function __construct($parametro) {
        parent::__construct("dashboarduser",$parametro,true);
    }
}