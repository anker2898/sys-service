<?php

class Parameter extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->rows = [];
        $this->view->data = null;
        $this->view->message = "";
        $this->view->messageHeader = "";
        $this->view->url = "";
        $this->view->title = "Gestión de parámetros de negocio";
        $this->view->subtitle = "El siguiente mantenimiento se puede gestionar a los parametros o valores que utilizarán el sistema.";
    }

    public function render()
    {
        $this->view->rows = $this->model->get();
        $this->view->render('parameter/index');
    }

    public function new()
    {
        $this->view->render('parameter/form');
    }

    public function guardar() {
        $data = array(
            "LABEL" => trim($_POST["label"]),
            "VALUE" => trim($_POST["value"]),
            "TYPE" => trim($_POST["type"]),
        );
        
        $this->view->url = "/parameter";

        try {
            $this->model->save($data);
            $this->view->messageHeader = "Operación exitósa";
            $this->view->message = "La operación se realizó con exito.";
        } catch (Exception $ex) {
            echo($ex);
            $this->view->messageHeader = "Operación fallida";
            $this->view->message = "Ocurrió un error al ejecutar la operación.";
        } finally {
            $this->view->render('shared/message');
        }
    }

    public function edit()
    {
        $id = $_GET["id"];
        $this->view->data = $this->model->getById($id);
        $this->view->render('parameter/form');
    }

    public function delete()
    {
        $this->view->dni = $_GET['id'];
        $this->view->render('parameter/delete');
    }

    public function deleteParameter()
    {
        $this->view->url = "/parameter";
        try {
            $id = $_GET['id'];
            $this->model->delete($id);
            $this->view->messageHeader = "Operación exitósa";
            $this->view->message = "La operación se realizó con exito.";
        } catch (Exception $ex) {
            $this->view->messageHeader = "Operación fallida";
            $this->view->message = "Ocurrió un error al ejecutar la operación.";
        } finally {
            $this->view->render('shared/message');
        }
    }

}
