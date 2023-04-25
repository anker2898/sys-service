<?php

class Jobs extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function servicioLuz()
    {
        date_default_timezone_set('America/Lima');
        $fecha_actual = new DateTime('now');
        $nowDate = $fecha_actual->format('Y-m-d');
        $lastDate = date('Y-m-t');
        $startDate = date('Y-m-01');
        $expirationDate = date('Y-m-07');

        if (strtotime($nowDate) != strtotime($lastDate)) { //Ejecucion ultimo dia

            //Cambio de estado de los comprobantes de pago
            //De "En proceso" a "Pendiente de pago"
            $this->model->cambioEstado(0);

            //Generar los nuevos comprobantes de pago de liuz
            echo "Generar comprobante de pagos";
        } else if (strtotime($nowDate) == strtotime($expirationDate)) { //Ejecucion dia de vencimiento

            //Cambio de estado de los comprobantes de pago
            //De "Pendiente de pago" a "Vencido" o "Cancelado"
            $this->model->cambioEstado(1);
        }
    }

    public function servicioAgua()
    {
        echo "agua";
    }
}
