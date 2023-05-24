<?php

class InvoiceModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRecibo($recibo)
    {
        $sql = "CALL SP_SEL_RECIBO(:P_NRECIBO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NRECIBO', $recibo, PDO::PARAM_INT);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        return $resultDb[0];
    }

    public function pagar($data)
    {
        $sql = "CALL SP_INS_PAGO(:P_NID, :P_NPAGO, :P_SUSUARIO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NID', $data["id"], PDO::PARAM_INT);
        $stm->bindValue(':P_NPAGO', $data["pay"], PDO::PARAM_STR);
        $stm->bindValue(':P_SUSUARIO', $data["user"], PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        return $resultDb[0];
    }
}
