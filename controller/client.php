<?php

class Client extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->view->rows = [];
        $this->view->data = null;
        $this->view->message = "";
        $this->view->messageHeader = "";
        $this->view->url = "";
        $this->view->title = "Gestión de Clientes";
        $this->view->subtitle = "El siguiente mantenimiento se puede gestionar a los clientes a quienes se le brindaran los servicios.";
    }

    public function render()
    {
        //$this->view->rows = $this->model->get();
        $this->view->render('client/index');
    }

    public function new()
    {
        $this->view->render('client/form');
    }   
}