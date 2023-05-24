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

    public function generarrecibos($data)
    {
        /* FLUJOS
      	0: GENERAR RECIBOS A CLIENTES NUEVOS
        1: 
        */
        print_r($data);
        $sql = "CALL SP_INS_RECIBOS(:P_NFLOW, :P_DEMISION, :P_DVENCIMIENTO, :P_DVENC_ULTIMO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NFLOW', $data["flow"], PDO::PARAM_INT);
        $stm->bindValue(':P_DEMISION', $data["emision"], PDO::PARAM_STR);
        $stm->bindValue(':P_DVENCIMIENTO', $data["vencimiento"], PDO::PARAM_STR);
        $stm->bindValue(':P_DVENC_ULTIMO', $data["ultimo"], PDO::PARAM_STR);
        $stm->execute();
    }
}
