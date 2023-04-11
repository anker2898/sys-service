<?php

class SharedModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDepartamento()
    {
        $sql = "CALL SP_SEL_DEPARTAMENTO()";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["ID"],
                $value["LABEL"],
            );
            array_push($result, $data);
        }
        return $result;
    }

    public function getProvincia($departamento)
    {
        $sql = "CALL SP_SEL_PROVINCIA(:P_NDEPARTAMENTO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NDEPARTAMENTO', $departamento, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["ID"],
                $value["LABEL"]
            );
            array_push($result, $data);
        }
        return $result;
    }

    public function getDistrito($provincia)
    {
        $sql = "CALL SP_SEL_DISTRITO(:P_NPROVINCIA)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NPROVINCIA', $provincia, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["ID"],
                $value["LABEL"],
            );
            array_push($result, $data);
        }
        return $result;
    }

    public function getCondominio()
    {
        $sql = "CALL SP_SEL_URBANIZACION()";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["ID"],
                $value["CONDOMINIO"],
            );
            array_push($result, $data);
        }
        return $result;
    }

    public function getServicio()
    {
        $sql = "CALL SP_SEL_SERVICIOS()";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["ID"],
                $value["SERVICIO"],
            );
            array_push($result, $data);
        }
        return $result;
    }
}
