<?php

class Jobs extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function servicio()
    {
        echo "job";
        /*date_default_timezone_set("America/Lima");
        $fecha_actual = new DateTime('now');
        $nowDate = $fecha_actual->format('Y-m-d H:i:s');     // FECHA ACTUAL
        $lastDate = date('Y-m-t 11:50:00');                  // ULTIMO DIA
        $expirationDate = date('Y-m-07 11:50:00');           // FECHA DE VENCIMIENTO


        // Flujo corre el ultimo dia a las 11:00
        if (strtotime($nowDate) == strtotime($lastDate)) {              // Ejecucion ultimo dia
            $this->generacionRecibos();
        } else if (strtotime($nowDate) == strtotime($expirationDate)) { // Ejecucion dia de vencimiento
            $this->deudasVencidas();
        } else {                                                        // Ejecucion diario
            $this->recibosClientesnuevos();
        }*/
    }

    private function generacionRecibos()
    {
        //Cambio de estado de los comprobantes de pago
        //De "En proceso" a "Pendiente de pago"
        $this->model->cambioEstado(0);

        //Generar los nuevos comprobantes de pago de luz
        $nextMonth = strtotime('+1 month', strtotime((new DateTime('now'))->format('Y-m-d'))); // Sumar un mes a la fecha actual
        $emision = date('Y-m-01', $nextMonth);
        $fecha_actual = new DateTime('now');
        $vencimiento = date('Y-m-07', $nextMonth);

        $data = array(
            "flow" => 1,
            "emision" => $emision,
            "vencimiento" => $vencimiento,
            "ultimo" => $fecha_actual->format('Y-m-d')
        );

        // generar los recibos de los clientes nuevo
        $this->model->generarrecibos($data);
    }

    private function deudasVencidas()
    {
        //Cambio de estado de los comprobantes de pago
        //De "Pendiente de pago" a "Vencido" o "Cancelado"
        $this->model->cambioEstado(1);
    }

    private function recibosClientesnuevos()
    {
        $nextMonth = strtotime('+1 month', strtotime((new DateTime('now'))->format('Y-m-d'))); // Sumar un mes a la fecha actual
        $emision = date('Y-m-01', $nextMonth);
        $vencimiento = date('Y-m-07', $nextMonth);

        $data = array(
            "flow" => 0,
            "emision" => $emision,
            "vencimiento" => $vencimiento
        );

        // generar los recibos de los clientes nuevo
        $this->model->generarrecibos($data);
    }
}
