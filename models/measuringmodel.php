<?php

class MeasuringModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHouse($condominio, $servicio)
    {
        $sql = "CALL SP_SEL_URBANIZACION_SERVICIOS(:P_NCONDOMINIO, :P_NSERVICIO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NCONDOMINIO', $condominio, PDO::PARAM_INT);
        $stm->bindValue(':P_NSERVICIO', $servicio, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result;
    }

    public function guardar($data)
    {
        $sql = "CALL SP_INS_MEDICION(:P_NID, :P_NMEDICION, :P_SUSER, :P_DREGISTRO, :P_SIMAGEN)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_NID', $data["id"], PDO::PARAM_INT);
        $stm->bindValue(':P_NMEDICION', $data["medicion"], PDO::PARAM_STR);
        $stm->bindValue(':P_SUSER', $data["usuario"], PDO::PARAM_STR);
        $stm->bindValue(':P_DREGISTRO', $data["registro"], PDO::PARAM_STR);
        $stm->bindValue(':P_SIMAGEN', $data["imagen"], PDO::PARAM_STR);
        $stm->execute();
    }
}
