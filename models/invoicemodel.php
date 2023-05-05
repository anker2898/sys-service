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
}
