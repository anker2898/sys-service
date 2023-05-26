<?php

class Invoice extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->shared = new SharedModel();
        $this->view->condominio = [];
        $this->view->titleWeb = constant("SYS-SHORT") . " - Recibos";
        $this->view->title = "Visualizador de recibos";
        $this->view->subtitle = "Se visualiza recibo de acuerdo a hogar, servicio y titular.";
    }

    public function render()
    {
        $this->view->condominio = $this->shared->getCondominio($_SESSION["user"]["NIDUSER"]);
        $this->view->render('invoice/index');
    }

    public function getRecibo()
    {
        $data = $this->model->getRecibo($_POST["recibo"]);
        $monto = floatval($data["monto"]);
        $mantenimiento = floatval($data["mantenimiento"]);
        $alumbrado = floatval($data["alumbrado"]);
        $subtotal = $monto + $mantenimiento + $alumbrado;
        $data["subtotal"] = number_format($subtotal, 2);
        echo json_encode($data);
    }

    public function descargar($id)
    {
        $data = $this->model->getRecibo($id);
        $monto = floatval($data["monto"]);
        $mantenimiento = floatval($data["mantenimiento"]);
        $alumbrado = floatval($data["alumbrado"]);
        $subtotal = $monto + $mantenimiento + $alumbrado;
        $data["subtotal"] = number_format($subtotal, 2);
        $data["recibo"] = constant("RECIBO")[substr($data["emision"], 5, 2)] . " - " . $data["servicio"];
        PdfRecibo::generarRecibo($data);
    }

    public function pagar()
    {
        $data = array(
            "id" => $_POST["recibo"],
            "pay" => $_POST["pago"],
            "user" => $_SESSION["user"]["USUARIO"]
        );
        $result = array();

        try {
            $this->model->pagar($data);
            $result["success"] = true;
        } catch (Exception $e) {
            $result["success"] = false;
            $result["message"] = $e->getMessage();
        }
        echo json_encode($result);
    }
}
