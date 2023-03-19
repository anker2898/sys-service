<?php

class ClientModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $sql = "CALL SP_SEL_CLIENT()";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["NOMBRE"],
                $value["PATERNO"],
                $value["MATERNO"],
                $value["DOCUMENTO"],
                $value["TELEFONO"],
                $value["CORREO"],
                $value["ID"]
            );
            array_push($result, $data);
        }
        return $result;
    }

    

}