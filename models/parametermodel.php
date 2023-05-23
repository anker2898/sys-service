<?php

class ParameterModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $sql = "CALL SP_SEL_PARAMETER()";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["LABEL"],
                $value["VALOR"],
                $value["TIPO"],
                $value["ID"]
            );
            array_push($result, $data);
        }
        return $result;
    }

    public function save($data)
    {
        $sql = "CALL SP_INS_PARAMETER(:P_SLABEL, :P_SVALUE, :P_CTYPE, :P_NIDUSER)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SLABEL', $data["LABEL"], PDO::PARAM_STR);
        $stm->bindValue(':P_SVALUE', $data["VALUE"], PDO::PARAM_STR);
        $stm->bindValue(':P_CTYPE', $data["TYPE"], PDO::PARAM_STR);
        $stm->bindValue(':P_NIDUSER', $data["USER"], PDO::PARAM_STR);
        $stm->execute();
    }

    public function getById($document)
    {
        $sql = "CALL SP_SEL_PARAMETER_ID(:P_NID)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NID', $document, PDO::PARAM_INT);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = sizeof($resultDb) >= 1 ? $resultDb[0] : [];
        return $result;
    }

    public function delete($id)
    {
        $sql = "CALL SP_DEL_PARAMETER(:P_NID)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NID', $id, PDO::PARAM_INT);
        $stm->execute();
    }

    public function valid($label)
    {
        $sql = "CALL SP_VAL_PARAMETER(:P_SLABEL)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SLABEL', $label, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        return $resultDb[0]["CANTIDAD"];
    }
}
