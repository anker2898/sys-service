<?php

class Invoice extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->shared = new SharedModel();
        $this->view->title = "Visualizador de recibos";
        $this->view->subtitle = "Se visualiza recibo de acuerdo a hogar, servicio y titular.";
    }

    public function render()
    {
        $this->view->render('invoice/index');
    }

    public function getRecibo()
    {
        $result = $this->model->getRecibo($_POST["recibo"]);
        echo json_encode($result);
    }
}
