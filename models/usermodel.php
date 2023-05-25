<?php

class UserModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $sql = "CALL SP_SEL_USER(:P_SUSER)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SUSER', $_SESSION['user']['USUARIO'], PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        foreach ($resultDb as $value) {
            $data = array(
                $value["USUARIO"],
                $value["ESTADO"],
                $value["NOMBRE"],
                $value["APELLIDO_PAT"],
                $value["APELLIDO_MAT"],
                $value["DOCUMENTO"]
            );
            array_push($result, $data);
        }
        return $result;
    }

    public function delete($document) {
        $sql = "CALL SP_DEL_USER(:P_SDOCUMENT)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
        $stm->execute();
    }

    public function save($data) {
        $sql = "CALL SP_INS_USER(:P_SDOCUMENT, :P_SNOMBRE, :P_SAPELLIDO_PAT, :P_SAPELLIDO_MAT, :P_SEMAIL, :P_SNUMBER, :P_NSTATUS, :P_SUSER, :P_NPASSWORD_RESET, :P_SDIRECCION, :P_SPASSWORD, :P_NURBANIZACION, :P_NDEPARTAMENTO, :P_NPROVINCIA, :P_NDISTRITO)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $data["DOCUMENTO"], PDO::PARAM_STR);
        $stm->bindValue(':P_SNOMBRE', $data["NOMBRE"], PDO::PARAM_STR);
        $stm->bindValue(':P_SAPELLIDO_PAT', $data["APELLIDO_PAT"], PDO::PARAM_STR);
        $stm->bindValue(':P_SAPELLIDO_MAT', $data["APELLIDO_MAT"], PDO::PARAM_STR);
        $stm->bindValue(':P_SEMAIL', $data["EMAIL"], PDO::PARAM_STR);
        $stm->bindValue(':P_SNUMBER', $data["NUMERO"], PDO::PARAM_STR);
        $stm->bindValue(':P_NSTATUS', $data["STATUS"], PDO::PARAM_INT);
        $stm->bindValue(':P_SUSER', $data["USER"], PDO::PARAM_STR);
        $stm->bindValue(':P_NPASSWORD_RESET', $data["RESET"], PDO::PARAM_INT);
        $stm->bindValue(':P_SDIRECCION', $data["DIRECCION"], PDO::PARAM_STR);
        $stm->bindValue(':P_SPASSWORD', $data["PASSWORD"], PDO::PARAM_STR);
        $stm->bindValue(':P_NURBANIZACION', $data["CONDOMINIO"], PDO::PARAM_STR);
        $stm->bindValue(':P_NDEPARTAMENTO', $data["DEPARTAMENTO"], PDO::PARAM_STR);
        $stm->bindValue(':P_NPROVINCIA', $data["PROVINCIA"], PDO::PARAM_STR);
        $stm->bindValue(':P_NDISTRITO', $data["DISTRITO"], PDO::PARAM_STR);
        $stm->execute();
    }

    public function getById($document) {
        $sql = "CALL SP_SEL_USER_DNI(:P_SDOCUMENT)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = sizeof($resultDb) >= 1 ? $resultDb[0] : [];
        return $result;
    }

    public function getRoles() {
        $sql = "CALL SP_SEL_ROLES()";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->execute();
        return $stm->fetchAll();
    }

    public function getRolesById($document) {
        $sql = "CALL SP_SEL_ROLES_DNI(:P_SDOCUMENT)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = [];
        foreach ($resultDb as $row) {
            $rol = array(
                $row["LABEL"] => $row["STATUS"],
            );
            $result = array_merge($result, $rol);
        }
        return $result;
    }

    public function saveRole(string $document, $roles) {
        foreach ($roles as $clave => $data) {
            $sql = "CALL SP_INS_USER_PRIVILEGIOS(:P_SDOCUMENT, :P_SPRIVILEGIOS, :P_BSTATUS)";
            $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
            $stm->bindValue(':P_SPRIVILEGIOS', $clave, PDO::PARAM_STR);
            $stm->bindValue(':P_BSTATUS', $data, PDO::PARAM_BOOL);
            $stm->execute();
        }
    }

    public function valiUser($user)
    {
        $sql = "CALL SP_VAL_USER(:P_SUSER)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SUSER', $user, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        return $resultDb[0]["CANTIDAD"];
    }

    public function validDocument($document)
    {
        $sql = "CALL SP_VAL_USER_DOCUMENT(:P_SDOCUMENT)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SDOCUMENT', $document, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        return $resultDb[0]["CANTIDAD"];
    }
}
