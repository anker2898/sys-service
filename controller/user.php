<?php

class User extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->rows = [];
        $this->view->data = null;
        $this->view->dataRoles = [];
        $this->view->roles = [];
        $this->view->message = "";
        $this->view->messageHeader = "";
        $this->view->url = "";
        $this->view->title = "Gestión de usuario";
        $this->view->subtitle = "El siguiente mantenimiento se puede gestionar a los usuarios que utilizarán el sistema.";
    }

    public function render()
    {
        $this->view->rows = $this->model->get();
        $this->view->render('user/index');
    }

    public function new()
    {
        $this->view->roles = $this->model->getRoles();
        $this->view->render('user/form');
    }

    public function edit()
    {
        $document = $_GET["id"];
        $this->view->data = $this->model->getById($document);
        $this->view->dataRoles = $this->model->getRolesById($document);
        $this->view->roles = $this->model->getRoles();
        $this->view->render('user/form');
    }

    public function guardar()
    {
        $data = array(
            "APELLIDO_PAT" => trim($_POST["apPaterno"]),
            "APELLIDO_MAT" => trim($_POST["apMaterno"]),
            "NOMBRE" => trim($_POST["nombre"]),
            "DOCUMENTO" => trim($_POST["documento"]),
            "EMAIL" => trim($_POST["correo"]),
            "NUMERO" => trim($_POST["numero"]),
            "USER" => trim($_POST["usuario"]),
            "STATUS" => isset($_POST["activo"]) ? $_POST["activo"] : 0,
            "RESET" => isset($_POST["reset"]) ? $_POST["reset"] : 0,
            "DIRECCION" => trim($_POST["direccion"]),
            "PASSWORD" => md5(trim($_POST["documento"]))
        );
        $this->view->url = "/user";

        //ASIGNACIÓN DE ROLES
        $rolesDB = $this->model->getRoles();
        $dataRoles = array();

        foreach ($rolesDB as $rol) {
            $rolSelected = array($rol["LABEL"] => $_POST[$rol["LABEL"]] ? "1" : "0");
            $dataRoles = array_merge($dataRoles, $rolSelected);
        }

        try {
            $this->model->save($data);
            $this->model->saveRole($_POST["documento"], $dataRoles);
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

    public function delete()
    {
        $this->view->dni = $_GET['id'];
        $this->view->render('user/delete');
    }

    public function deleteUser()
    {
        $this->view->url = "/user";
        try {
            $document = $_GET['id'];
            $this->model->delete($document);
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
