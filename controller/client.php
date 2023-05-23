<?php

class Client extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->shared = new SharedModel();

        $this->view->rows = [];
        $this->view->data = null;
        $this->view->message = "";
        $this->view->messageHeader = "";
        $this->view->url = "";
        $this->view->titleWeb = constant("SYS-SHORT") . " - Clientes";
        $this->view->title = "Gestión de Clientes";
        $this->view->subtitle = "El siguiente mantenimiento se puede gestionar a los clientes a quienes se le brindaran los servicios.";

        $this->view->departamento = [];
        $this->view->provincia = [];
        $this->view->distrito = [];
    }

    public function render()
    {
        $this->view->rows = $this->model->get();
        $this->view->render('client/index');
    }

    public function new()
    {
        $this->view->departamento = $this->shared->getDepartamento();
        $this->view->render('client/form');
    }

    public function guardar()
    {
        $data = array(
            "APELLIDO_PAT" => trim($_POST["apPaterno"]),
            "APELLIDO_MAT" => trim($_POST["apMaterno"]),
            "NOMBRE" => trim($_POST["nombre"]),
            "DOCUMENTO" => trim($_POST["documento"]),
            "EMAIL" => trim($_POST["correo"]),
            "NUMERO" => trim($_POST["fono"]),
            "DIRECCION" => trim($_POST["direccion"]),
            "DEPARTAMENTO" => trim($_POST["departamento"]),
            "PROVINCIA" => trim($_POST["provincia"]),
            "DISTRITO" => trim($_POST["distrito"])
        );

        $this->view->url = "/client";

        try {
            $this->model->save($data);
            $this->view->messageHeader = "Operación exitósa";
            $this->view->message = "La operación se realizó con exito.";
        } catch (Exception $ex) {
            echo ($ex);
            $this->view->messageHeader = "Operación fallida";
            $this->view->message = "Ocurrió un error al ejecutar la operación.";
        } finally {
            $this->view->render('shared/message');
        }
    }

    public function edit()
    {
        $document = $_GET["id"];
        $this->view->data = $this->model->getById($document);
        $this->view->departamento = $this->shared->getDepartamento();
        $this->view->provincia = $this->shared->getProvincia($this->view->data["DEPARTAMENTO"]);
        $this->view->distrito = $this->shared->getDistrito($this->view->data["PROVINCIA"]);
        $this->view->render('client/form');
    }

    public function validDocument()
    {
        echo $this->model->validDocument($_POST["document"]);
    }

    public function delete()
    {
        $this->view->dni = $_GET['id'];
        $this->view->render('client/delete');
    }

    public function deleteUser()
    {
        $this->view->url = "/client";

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
