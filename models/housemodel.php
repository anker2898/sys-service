<?php

class HouseModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($nidUser)
    {
        $sql = "CALL SP_SEL_CASAS(:P_NIDUSER)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NIDUSER', $nidUser, PDO::PARAM_INT);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["DOCUMENTO"],
                $value["NOMBRE"] . " " . $value["APPATERNO"],
                $value["SUMINISTRO"],
                $value["MANZANA"],
                $value["LOTE"],
                $value["ID"]
            );
            array_push($result, $data);
        }
        return $result;
    }

    public function getByDocument($document)
    {
        $sql = "CALL SP_SEL_CLIENT_GENERAL_DNI(:P_SDOCUMENT)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = sizeof($resultDb) >= 1 ? $resultDb[0] : [];
        return $result;
    }

    public function save($data)
    {
        $sql = "CALL SP_INS_CASAS(:P_SDOCUMENT, :P_SEMAIL, :P_SNUMERO, :P_NCONDOMINIO, :P_SMANZANA, :P_NLOTE, :P_NSUMINISTRO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $data["DOCUMENTO"], PDO::PARAM_STR);
        $stm->bindValue(':P_SEMAIL', $data["CORREO"], PDO::PARAM_STR);
        $stm->bindValue(':P_SNUMERO', $data["TELEFONO"], PDO::PARAM_STR);
        $stm->bindValue(':P_NCONDOMINIO', $data["CONDOMINIO"], PDO::PARAM_INT);
        $stm->bindValue(':P_SMANZANA', $data["MANZANA"], PDO::PARAM_STR);
        $stm->bindValue(':P_NLOTE', $data["LOTE"], PDO::PARAM_INT);
        $stm->bindValue(':P_NSUMINISTRO', $data["SUMINISTRO"], PDO::PARAM_INT);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $last_id = sizeof($resultDb) >= 1 ? $resultDb[0][0] : [];
        foreach ($data["SERVICIOS"] as $key => $value) {
            $sql = "CALL SP_INS_SERVICIOS(:P_NIDCASA, :P_NIDSERVICIO, :P_DINICIO_SERVICIO, :P_NSTATUS, :P_NMEDIDA)";
            $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $stm->bindValue(':P_NIDCASA', $last_id, PDO::PARAM_STR);
            $stm->bindValue(':P_NIDSERVICIO', $key, PDO::PARAM_STR);
            $stm->bindValue(':P_DINICIO_SERVICIO', $value["INICIO"], PDO::PARAM_STR);
            $stm->bindValue(':P_NSTATUS', $value["STATUS"], PDO::PARAM_INT);
            $stm->bindValue(':P_NMEDIDA', $value["MEDIDA"], PDO::PARAM_STR);
            $stm->execute();
        }
    }

    public function getById($id)
    {
        $sql = "CALL SP_SEL_CASA_ID(:P_NID)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NID', $id, PDO::PARAM_INT);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = sizeof($resultDb) >= 1 ? $resultDb[0] : [];

        $sql = "CALL SP_SEL_SERVICIOS_CASA(:P_NID)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NID', $id, PDO::PARAM_INT);
        $stm->execute();
        $servicioDb = $stm->fetchAll();

        foreach ($servicioDb as $value) {
            $result[$value["SERVICIO"] == 1 ? "LUZ" : "AGUA"] = array(
                "ID" => $value["ID"],
                "CASA" => $value["CASA"],
                "SERVICIO" => $value["SERVICIO"],
                "STATUS" => $value["STATUS"],
                "INICIO" => $value["INICIO"],
                "MEDIDA" => $value["MEDIDA"]
            );
        }
        return $result;
    }
}
