<?php

class JobsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cambioEstado($flujo)
    {
        /* FLUJOS
      	0: PASAR TODOS LOS EN PROCESO A PENDIENTE DE PAGO
        1: CAMBIAR ESTADO DE PENDIENTE DE PAGO A VENCIDO O CANCELADO
        */
        $sql = "CALL SP_CAMBIO_ESTADO_RECIBO(:P_FLOW)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_FLOW', $flujo, PDO::PARAM_INT);
        $stm->execute();
    }
}
