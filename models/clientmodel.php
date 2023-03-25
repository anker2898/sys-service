<?php

class ClientModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
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

    public function save($data)
    {
        $sql = "CALL SP_INS_CLIENT(:P_SDOCUMENT, :P_SNOMBRE, :P_SAPELLIDO_PAT, :P_SAPELLIDO_MAT, :P_SEMAIL, :P_SNUMBER, :P_SDIRECCION, :P_NDEPARTAMENTO, :P_NPROVINCIA, :P_NDISTRITO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $data["DOCUMENTO"], PDO::PARAM_STR);
        $stm->bindValue(':P_SNOMBRE', $data["NOMBRE"], PDO::PARAM_STR);
        $stm->bindValue(':P_SAPELLIDO_PAT', $data["APELLIDO_PAT"], PDO::PARAM_STR);
        $stm->bindValue(':P_SAPELLIDO_MAT', $data["APELLIDO_MAT"], PDO::PARAM_STR);
        $stm->bindValue(':P_SEMAIL', $data["EMAIL"], PDO::PARAM_STR);
        $stm->bindValue(':P_SNUMBER', $data["NUMERO"], PDO::PARAM_STR);
        $stm->bindValue(':P_SDIRECCION', $data["DIRECCION"], PDO::PARAM_STR);
        $stm->bindValue(':P_NDEPARTAMENTO', $data["DEPARTAMENTO"], PDO::PARAM_STR);
        $stm->bindValue(':P_NPROVINCIA', $data["PROVINCIA"], PDO::PARAM_STR);
        $stm->bindValue(':P_NDISTRITO', $data["DISTRITO"], PDO::PARAM_STR);
        $stm->execute();
    }

    public function getById($document)
    {
        $sql = "CALL SP_SEL_CLIENT_DNI(:P_SDOCUMENT)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = sizeof($resultDb) >= 1 ? $resultDb[0] : [];
        return $result;
    }


    public function validDocument($document)
    {
        $sql = "CALL SP_VAL_CLIENT_DNI(:P_SDOCUMENT)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        return $resultDb[0]["CANTIDAD"];
    }

    public function delete($id)
    {
        $sql = "CALL SP_DEL_CLIENT(:P_NID)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NID', $id, PDO::PARAM_INT);
        $stm->execute();
    }
}
