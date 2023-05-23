<?php

class House extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->rows = [];
        $this->view->condominio = [];
        $this->view->servicio = [];
        $this->view->data = null;
        $this->view->titleWeb = constant("SYS-SHORT") . " - Casas";
        $this->view->message = "";
        $this->view->messageHeader = "";
        $this->view->url = "";
        $this->shared = new SharedModel();
        $this->view->title = "Registro de casas con servicios";
        $this->view->subtitle = "Gestionas a las casas a los cuales se le prestan los servicios.";
    }

    public function render()
    {
        $this->view->rows = $this->model->get();
        $this->view->render('house/index');
    }

    public function getClient()
    {
        echo json_encode($this->model->getByDocument($_POST["documento"]));
    }

    public function new()
    {
        $this->view->condominio = $this->shared->getCondominio();
        $this->view->servicio = $this->shared->getServicio();
        $this->view->render('house/form');
    }

    public function edit()
    {
        $this->view->data = $this->model->getById($_GET["id"]);
        $this->view->condominio = $this->shared->getCondominio();
        $this->view->servicio = $this->shared->getServicio();
        $this->view->render('house/form');
    }

    public function guardar()
    {
        $data = array(
            "DOCUMENTO" => trim($_POST["documento"]),
            "CORREO" => trim($_POST["correo"]),
            "TELEFONO" => trim($_POST["telefono"]),
            "CONDOMINIO" => $_POST["condominio"],
            "MANZANA" => trim($_POST["manzana"]),
            "LOTE" => trim($_POST["lote"]),
            "SERVICIOS" => array()
        );

        $temp = array(
            "ID" => $value[0],
            "STATUS" => $_POST[$value[0]] ? 1 : 0
        );
        array_push($data["SERVICIOS"], $temp);

        try {
            $this->model->save($data);
            $this->view->messageHeader = "Operación exitósa";
            $this->view->message = "La operación se realizó con exito.";
        } catch (Exception $ex) {
            echo ($ex);
            $this->view->messageHeader = "Operación fallida";
            $this->view->message = "Ocurrió un error al ejecutar la operación.";
        } finally {
            //$this->view->render('shared/message');
        }
    }
}
